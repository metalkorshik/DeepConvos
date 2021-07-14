<?php

namespace App\Http\Controllers;
use App\Models\Features\UserFeatures;
use App\Models\Features\SketchFeatures;
use App\Models\Features\TranslateFeatures;
use Illuminate\Support\Facades\Auth;
use App\Helper\FeaturesHelper;
use App\Models\MailManager;
use ZipArchive;

use Illuminate\Http\Request;

class SketchesController extends Controller
{
    public function index($canceled_order_id = null)
    {
        $data = [];
        $user_info = UserFeatures::getUserInfo(Auth::id());
        $data['user_info'] = $user_info;
        $data['sketches'] = SketchFeatures::getActiveSketches($user_info['is_artist']);
        $data['is_artist'] = $user_info['is_artist'];
        $data['canceled'] = $canceled_order_id > 0;

        if($canceled_order_id)
            $data['canceled_order_id'] = $canceled_order_id;

        $data['deny_reasons'] = SketchFeatures::getDenyReasons();

        $data['actions'] = [
            'download' => '/download-sketch',
            'accept' => '/accept-sketch',
            'revision' => '/revision-sketch',
            'cancel' => '/cancel-sketch'
        ];

        return $this->handleView('sketches', $data);
    }

    public function sketch($sketch_id)
    {
        $user_id = Auth::id();
        $sketch = SketchFeatures::getSketch($sketch_id);

        if($sketch->order->meeting->customer_id != $user_id && $sketch->order->meeting->artist_id != $user_id)
            return redirect('/sketches');

        $actions = [
            'download' => '/download-sketch',
            'accept' => '/accept-sketch',
            'revision' => '/revision-sketch',
            'cancel' => '/cancel-sketch'
        ];

        $sketch_info = SketchFeatures::getSketchInfo($sketch_id);
        $user_info = UserFeatures::getUserInfo($user_id);
        $deny_reasons = SketchFeatures::getDenyReasons();

        return $this->handleView('sketch', [ 'user_info' => $user_info, 'sketch' => $sketch_info, 
            'is_artist' => $user_info['is_artist'], 'actions' => $actions, 'deny_reasons' => $deny_reasons ]);
    }

    public function sendSketch(Request $request)
    {
        $attachments = FeaturesHelper::uploadFiles($request->file('attachments'));

        $sketch_info = [
            'id' => $request->sketch_id,
            'title' => $request->sketch_title,
            'comment' => $request->comment,
            'technique' => $request->technique,
            'order_amount' => $request->order_amount ?? null,
            'attachments' => $attachments
        ];

        SketchFeatures::updateSketch($sketch_info);

        $sketch = SketchFeatures::getSketch($request->sketch_id);
        $customer = $sketch->order->meeting->customer;
        $artist = $sketch->order->meeting->artist;

        $customer_letter = TranslateFeatures::getTranslate('sketches_letter_text', 'Mail');
        $customer_letter = str_replace('{artist}', $artist->user_info()->name . ' ' . $artist->user_info()->surname, $customer_letter);
        $customer_letter = str_replace('{link}', url('/sketches'), $customer_letter);

        MailManager::sendEmail($customer->user_info()->email, TranslateFeatures::getTranslate('sketches_letter_title', 'Mail'), 
            $customer_letter);

        return redirect('/sketches');
    }

    public function downloadSketch(Request $request)
    {
        $zip_path = public_path() . '/storage/attachments';
        $zip_file = $zip_path . '/' . FeaturesHelper::getUniqueFileName($zip_path, 'sketches', '.zip');

        $sketch = SketchFeatures::getSketch($request->sketch_id);

        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        foreach ($sketch->sketch_attachments as $attachment) {
            $downloaded_file = FeaturesHelper::getPathFromUrl($attachment->file);
            $zip->addFile($downloaded_file, basename($downloaded_file));
        }
        
        $zip->close();

        return response()->download($zip_file);
    }

    public function sketchPayment(Request $request)
    {
        $sketch_details = SketchFeatures::getSketchInfo($request->sketch_id);
        $amount = $sketch_details['order_amount'];
        $action = '/sketch-success';

        $user_info = UserFeatures::getUserInfo(Auth::id());
        return $this->handleView('checkout', [ 'user_info' => $user_info, 'sketch_details' => $sketch_details, 
            'action' => $action, 'amount' => $amount ]);
    }

    public function success(Request $request)
    {
        $order = SketchFeatures::completeOrder($request->order_id, $request->amount, $request->delivery_address);
        $user_info = UserFeatures::getUserInfo(Auth::id());
        return $this->handleView('review_artist', [ 'user_info' => $user_info, 'action' => '/review-artist', 'order' => $order ]);
    }

    public function reviewArtist(Request $request)
    {
        $order = SketchFeatures::reviewArtist($request->order_id, $request->comment, $request->rating);
        $user_info = UserFeatures::getUserInfo(Auth::id());
        return $this->handleView('review_success', [ 'user_info' => $user_info ]);
    }

    public function revisionSketch(Request $request)
    {
        $attachments = FeaturesHelper::uploadFiles($request->file('attachments'));
        SketchFeatures::revisionSketch($request->sketch_id, $request->comment, $attachments);
        return redirect('/sketches');
    }

    public function cancelSketch(Request $request)
    {
        $order_id = SketchFeatures::cancelSketch($request->sketch_id);
        return redirect('/sketches/' . $order_id);
    }

    public function sendCancelReview(Request $request)
    {
        SketchFeatures::sendCancelReview($request->order_id, $request->reason_id, $request->comment);
        return response()->json(true);
    }
}