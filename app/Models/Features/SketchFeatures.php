<?php

namespace App\Models\Features;
use Illuminate\Support\Facades\Storage;
use App\Models\ArtistApply;
use App\Models\ArtistDetails;
use App\Models\BankDetails;
use App\Models\UserInfo;
use App\Models\User;
use App\Models\Orders\ArtistReward;
use App\Models\Orders\ArtistRewardStatus;
use App\Models\Orders\Order;
use App\Models\Orders\OrderStatus;
use App\Models\Orders\Sketch;
use App\Models\Orders\SketchAttachment;
use App\Models\Orders\SketchStatus;
use App\Models\Orders\Meeting;
use App\Models\Orders\MeetingInfo;
use App\Models\Orders\MeetingAttachment;
use App\Models\Orders\MeetingPayment;
use App\Models\Orders\OrderPayment;
use App\Models\Orders\OrderReview;
use App\Models\Orders\DeniedOrder;
use App\Models\Orders\DeniedOrderReason;
use App\Models\Orders\SketchRevision;
use App\Models\Orders\SketchRevisionAttachment;
use App\Models\MailManager;
use Illuminate\Support\Facades\Hash;
use App\Helper\FeaturesHelper;
use DB;

class SketchFeatures
{
    public static function getActiveSketches($is_artist = false)
    {
        $sketches = [];
        $results = [];

        if($is_artist)
            $results = Sketch::where('status_id', SketchStatus::where('status', 'active')->first()->id)->whereNull('sended_date')->get();
        else
            $results = Sketch::where('status_id', SketchStatus::where('status', 'active')->first()->id)->whereNotNull('sended_date')->get();

        foreach ($results as $result) 
        {
            if($result->order->status_id == OrderStatus::where('status', 'active')->first()->id)
                $sketches[] = self::getSketchInfo($result->id);
        }

        return $sketches;
    }

    public static function getSketchInfo($sketch_id)
    {
        $result = self::getSketch($sketch_id);
        $full_date = FeaturesHelper::getDate($result->deadline_date, 'full');
        $date_arr = FeaturesHelper::getSeparateDate($result->deadline_date, 'full');
        $remains_arr = FeaturesHelper::getTimeRemains($result->deadline_date, 'full');
        $customer_arr = $result->order->meeting->customer;
        $artist_arr = $result->order->meeting->artist;

        $customer = [];
        $customer['name'] = $customer_arr->user_info()->name;
        $customer['surname'] = $customer_arr->user_info()->surname;
        $customer['full_name'] = $customer_arr->user_info()->name . ' ' . $customer_arr->user_info()->surname;
        $customer['image'] = $customer_arr->user_info()->image;

        $artist = [];
        $artist['name'] = $artist_arr->user_info()->name;
        $artist['surname'] = $artist_arr->user_info()->surname;
        $artist['full_name'] = $artist_arr->user_info()->name . ' ' . $artist_arr->user_info()->surname;
        $artist['image'] = $artist_arr->user_info()->image;

        $sketch = [];
        $sketch['id'] = $result->id;
        $sketch['title'] = $result->title;
        $sketch['comment'] = $result->comment;
        $sketch['date'] = $date_arr['date'];
        $sketch['time'] = $date_arr['time'];
        $sketch['deadline_date'] = $full_date;
        $sketch['days_remains'] = $remains_arr['days'];
        $sketch['hours_remains'] = $remains_arr['hours'];
        $sketch['minutes_remains'] = $remains_arr['minutes'];
        $sketch['customer'] = $customer;
        $sketch['artist'] = $artist;

        $order = $result->order;

        $sketch['technique'] = $order->technique;
        $sketch['order_id'] = $order->id;
        $sketch['order_amount'] = $order->amount;

        $order_sketches_count = $order->sketches()->count();

        $sketch['is_first_sketch'] = $order_sketches_count ? $order->sketches()->first()->id == $result->id : false;
        $sketch['is_revisionable'] = $order_sketches_count <= 3;
        $sketch['is_primary'] = $result->is_primary;
        $attachments = [];

        foreach ($result->sketch_attachments as $item) {
            $attachment = [];
            $attachment['id'] = $item->id;
            $attachment['file'] = $item->file;
            $attachment['name'] = basename($item->file);
            $attachments[] = $attachment;
        }

        $sketch['attachments'] = $attachments;

        $revision = $result->revision();

        if($revision)
        {
            $revision_attachments = [];

            foreach ($revision->attachments as $item) {
                $revision_attachment = [];
                $revision_attachment['id'] = $item->id;
                $revision_attachment['file'] = $item->file;
                $revision_attachment['name'] = basename($item->file);
                $revision_attachments[] = $revision_attachment;
            }

            $sketch['revision'] = [
                'comment' => $revision->comment,
                'attachments' => $revision_attachments
            ];
        }

        return $sketch;
    }

    public static function getSketch($sketch_id)
    {
        return Sketch::findOrFail($sketch_id);
    }

    public static function getOrder($order_id)
    {
        return Order::findOrFail($order_id);
    }

    public static function remindAboutSketches()
    {
        $sketches = Sketch::whereRaw('status_id = 1 AND sended_date IS NOT NULL AND is_alerded = 0 AND TIMESTAMPDIFF( MINUTE, NOW(), deadline_date ) <= 180')->get();

        foreach ($sketches as $sketch) 
        {
            $sketch->is_alerted = 1;
            $sketch->save();

            $artist = $sketch->order->meeting->artist;
    
            $artist_letter = TranslateFeatures::getTranslate('sketch_remind_text', 'Mail');
            $artist_letter = str_replace('{customer}', $artist->user_info()->name . ' ' . $artist->user_info()->surname, $artist_letter);
    
            $letter_title = TranslateFeatures::getTranslate('sketch_remind_title', 'Mail');
    
            MailManager::sendEmail($artist->user_info()->email, $letter_title, $artist_letter);
        }
    }

    public static function scheduleMeetings()
    {
        $meetings = Meeting::where('deadline_date', '<=', \DB::raw('NOW()'))->get('id');

        foreach ($meetings as $meeting) 
            MeetingFeatures::startMeeting($meeting->id);
    }

    public static function updateSketch($sketch_info)
    {
        $sketch = self::getSketch($sketch_info['id']);
        $sended_date = FeaturesHelper::getDate(date('d.m.Y H:i:s'), 'sql');

        $sketch->update([
            'title' => $sketch_info['title'],
            'comment' => $sketch_info['comment'],
            'sended_date' => $sended_date
        ]);

        if($sketch_info['order_amount'])
        {
            $sketch->order->update([ 
                'amount' => $sketch_info['order_amount'],
                'technique' => $sketch_info['technique']
            ]);
        }

        if(count($sketch_info['attachments']))
        {
            foreach ($sketch_info['attachments'] as $attachment) {

                SketchAttachment::create([
                    'sketch_id' => $sketch_info['id'],
                    'file' => $attachment
                ]);

            }
        }
    }

    public static function getDenyReasons()
    {
        $reasons = [];

        foreach (DeniedOrderReason::all() as $item) {

            $reason_text = '';

            if($item->reason == 'style')
                $reason_text = TranslateFeatures::getTranslate('artist_style_did_not_fit');

            if($item->reason == 'approach')
                $reason_text = TranslateFeatures::getTranslate('bad_work_approach');
                
            if($item->reason == 'not_revelant')
                $reason_text = TranslateFeatures::getTranslate('not_revelant');

            $reasons[] = [
                'id' => $item->id,
                'reason' => $reason_text
            ];

        }

        return $reasons;
    }

    public static function cancelSketch($sketch_id)
    {
        $sketch = self::getSketch($sketch_id);

        $sketch->update([ 
            'status_id' => SketchStatus::where('status', 'denied')->first()->id 
        ]);

        $order = $sketch->order;

        $order->update([ 
            'status_id' => OrderStatus::where('status', 'denied')->first()->id 
        ]);

        DeniedOrder::create([
            'order_id' => $order->id
        ]);
        
        return $order->id;
    }

    public static function sendCancelReview($order_id, $reason_id, $comment)
    {
        DeniedOrder::where('order_id', $order_id)->first()->update([
            'reason_id' => $reason_id, 
            'comment' => $comment
        ]);
    }

    public static function revisionSketch($sketch_id, $comment, $attachments)
    {
        $prev_sketch = self::getSketch($sketch_id);

        $prev_sketch->update([ 
            'status_id' => SketchStatus::where('status', 'denied')->first()->id 
        ]);

        $deadline_date = FeaturesHelper::getSketchDeadlineDate();

        $new_sketch = Sketch::create([
            'order_id' => $prev_sketch->order->id,
            'title' => $prev_sketch->title,
            'comment' => '',
            'deadline_date' => $deadline_date,
            'status_id' => SketchStatus::where('status', 'active')->first()->id,
        ]);

        $new_sketch_revision = SketchRevision::create([
            'sketch_id' => $new_sketch->id,
            'comment' => $comment
        ]);

        if(count($attachments))
        {
            foreach ($attachments as $attachment) {

                SketchRevisionAttachment::create([
                    'revision_id' => $new_sketch_revision->id,
                    'file' => $attachment
                ]);

            }
        }
    }

    public static function completeOrder($order_id, $amount)
    {
        $order = self::getOrder($order_id);
        $customer = $order->meeting->customer;
        $artist = $order->meeting->artist;

        if($order->status_id != OrderStatus::where('status', 'completed')->first()->id)
        {
            OrderPayment::create([
                'order_id' => $order_id,
                'amount' => $amount
            ]);

            $corrective_tarif = 1 - FeaturesHelper::getSiteFeature('order_comission_coeficient');
            $reward_amount = $amount * $corrective_tarif;

            ArtistReward::create([
                'order_id' => $order_id,
                'status_id' => ArtistRewardStatus::where('status', 'active')->first()->id,
                'amount' => $reward_amount
            ]);

            $order->update(['status_id' => OrderStatus::where('status', 'completed')->first()->id]);
            $order->sketches->last()->update(['status_id' => SketchStatus::where('status', 'completed')->first()->id]);

            $letter_title = 'Order completed';
            $letter_text = 'Order completed';
            MailManager::sendEmail($customer->user_info()->email, $letter_title, $letter_text);
            MailManager::sendEmail($artist->user_info()->email, $letter_title, $letter_text);
        }


        $artist_data = [];
        $artist_data['name'] = $artist->user_info()->name;
        $artist_data['surname'] = $artist->user_info()->surname;
        $artist_data['full_name'] = $artist->user_info()->name . ' ' . $artist->user_info()->surname;
        $artist_data['image'] = $artist->user_info()->image;

        $order_data = [];
        $order_data['id'] = $order->id;
        $order_data['title'] = $order->title;
        $order_data['amount'] = $amount;
        $order_data['artist'] = $artist_data;

        return $order_data;
    }

    public static function reviewArtist($order_id, $comment, $rating)
    {
        OrderReview::create([
            'order_id' => $order_id,
            'text' => $comment,
            'rating' => $rating
        ]);
    }
}
