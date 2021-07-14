<?php

namespace App\Http\Controllers;
use App\Models\Traits\ViewDataTrait;
use App\Models\Features\UserFeatures;
use App\Models\Features\SketchFeatures;
use App\Models\Features\TranslateFeatures;
use Illuminate\Support\Facades\Auth;
use App\Helper\FeaturesHelper;
use App\Models\MailManager;

use Illuminate\Http\Request;

class SketchesController extends Controller
{
    use ViewDataTrait;

    public function index()
    {
        $data = [];
        $user_info = UserFeatures::getUserInfo(Auth::id());
        $data['user_info'] = $user_info;
        $data['sketches'] = SketchFeatures::getActiveSketches($user_info['is_artist']);
        $data['is_artist'] = $user_info['is_artist'];

        $data['actions'] = [
            'download' => '/download-sketch',
            'accept' => '/accept-sketch',
            'review' => '/review-sketch',
            'cancel' => '/cancel-sketch'
        ];

        return $this->handleView('sketches', 'Sketches', $data);
    }

    public function sketch($sketch_id)
    {
        $user_id = Auth::id();
        $sketch = SketchFeatures::getSketch($sketch_id);

        if($sketch->order->meeting->customer_id != $user_id && $sketch->order->meeting->artist_id != $user_id)
            return redirect('/404');

        $sketch_info = SketchFeatures::getSketchInfo($sketch_id);
        $user_info = UserFeatures::getUserInfo($user_id);
        return $this->handleView('sketch', 'Sketch', [ 'user_info' => $user_info, 'sketch' => $sketch_info, 'is_artist' => $user_info['is_artist'] ]);
    }

    public function forms()
    {
        $user_info = UserFeatures::getUserInfo(Auth::id());
        return $this->handleView('sketch_forms', 'Sketch Forms', [ 'user_info' => $user_info ]);
    }

    public function sendSketch(Request $request)
    {
        $attachments = FeaturesHelper::uploadFiles($request->file('attachments'));

        $sketch_info = [
            'id' => $request->sketch_id,
            'title' => $request->sketch_title,
            'comment' => $request->sketch_comment,
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
        $sketch = SketchFeatures::getSketch(1);
        $zip_file = storage_path() . '/attachments/' . 'sketches.zip';
        $downloaded_file = FeaturesHelper::getFilePathFromUrl($sketch->sketch_attachments->first()->file);

        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        $zip->addFile($downloaded_file, $zip_file);
        $zip->close();

        return response()->download($zip_file);
    }
}
