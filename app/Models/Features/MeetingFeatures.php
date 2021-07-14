<?php

namespace App\Models\Features;
use Illuminate\Support\Facades\Storage;
use App\Models\ArtistApply;
use App\Models\ArtistDetails;
use App\Models\BankDetails;
use App\Models\UserInfo;
use App\Models\User;
use App\Models\Orders\Order;
use App\Models\Orders\OrderStatus;
use App\Models\Orders\Sketch;
use App\Models\Orders\SketchStatus;
use App\Models\Orders\Meeting;
use App\Models\Orders\MeetingInfo;
use App\Models\Orders\MeetingAttachment;
use App\Models\Orders\MeetingPayment;
use App\Models\MailManager;
use Illuminate\Support\Facades\Hash;
use App\Helper\FeaturesHelper;
use DB;

class MeetingFeatures
{
    public static function getMeetings()
    {
        $meetings = [];
        $results = Meeting::where('is_complete', '0')->get('id');

        foreach ($results as $result) 
            $meetings[] = self::getMeetingInfo($result->id);

        return $meetings;
    }

    public static function getMeetingInfo($meeting_id)
    {
        $result = self::getMeeting($meeting_id);
        $full_date = FeaturesHelper::getDate($result->deadline_date, 'full');
        $date_arr = FeaturesHelper::getSeparateDate($result->deadline_date, 'full');
        $remains_arr = FeaturesHelper::getTimeRemains($result->deadline_date, 'full');
        $artist_arr = $result->artist;
        $customer_arr = $result->customer;

        $artist = [];
        $artist['name'] = $artist_arr->user_info()->name;
        $artist['surname'] = $artist_arr->user_info()->surname;
        $artist['full_name'] = $artist_arr->user_info()->name . ' ' . $artist_arr->user_info()->surname;
        $artist['image'] = $artist_arr->user_info()->image;

        $customer = [];
        $customer['name'] = $customer_arr->user_info()->name;
        $customer['surname'] = $customer_arr->user_info()->surname;
        $customer['full_name'] = $customer_arr->user_info()->name . ' ' . $customer_arr->user_info()->surname;
        $customer['image'] = $customer_arr->user_info()->image;

        $meeting = [];
        $meeting['id'] = $result->id;
        $meeting['title'] = $result->meeting_info()->title;
        $meeting['description'] = $result->meeting_info()->description;
        $meeting['is_male_clothes'] = $result->meeting_info()->is_male_clothes;
        $meeting['send_sketches_before'] = $result->meeting_info()->send_sketches_before;
        $meeting['date'] = $date_arr['date'];
        $meeting['time'] = $date_arr['time'];
        $meeting['deadline_date'] = $full_date;
        $meeting['days_remains'] = $remains_arr['days'];
        $meeting['hours_remains'] = $remains_arr['hours'];
        $meeting['minutes_remains'] = $remains_arr['minutes'];
        $meeting['artist'] = $artist;
        $meeting['customer'] = $customer;
        $attachments = [];

        foreach ($result->meeting_attachments as $item) {
            $attachment = [];
            $attachment['id'] = $item->id;
            $attachment['file'] = $item->file;
            $attachment['name'] = basename($item->file);
            $attachments[] = $attachment;
        }

        $meeting['attachments'] = $attachments;

        return $meeting;
    }

    public static function getMeeting($meeting_id)
    {
        return Meeting::findOrFail($meeting_id);
    }

    public static function addMeeting($meeting_details)
    {
        $amount = $meeting_details['amount'];
        $meeting_link = 'www.zoom.com';
        $deadline_date = FeaturesHelper::getDate($meeting_details['date'], 'sql');

        $prev_meeting = Meeting::where([
            ['customer_id', '=', $meeting_details['customer_id']],
            ['artist_id', '=', $meeting_details['artist_id']],
            ['deadline_date', '=', $deadline_date]
        ])->get()->first();

        if($prev_meeting != null)
            return false;            

        $meeting = Meeting::create([
            'customer_id' => $meeting_details['customer_id'],
            'artist_id' => $meeting_details['artist_id'],
            'deadline_date' => $deadline_date,
            'link' => $meeting_link
        ]);

        MeetingInfo::create([
            'meeting_id' => $meeting->id,
            'title' => $meeting_details['order_title'],
            'description' => $meeting_details['order_description'],
            'is_male_clothes' => $meeting_details['is_male'],
            'send_sketches_before' => $meeting_details['send_sketches']
        ]);

        foreach ($meeting_details['attachments'] as $file) {

            MeetingAttachment::create([
                'meeting_id' => $meeting->id,
                'file' => $file
            ]);

        }

        MeetingPayment::create([
            'meeting_id' => $meeting->id,
            'amount' => $amount
        ]);

        $order = Order::create([
            'meeting_id' => $meeting->id,
            'title' => $meeting_details['order_title'],
            'description' => $meeting_details['order_description'],
            'amount' => '0',
            'technique' => '',
            'is_male_clothes' => $meeting_details['is_male'],
            'status_id' => OrderStatus::where('status', 'active')->first()->id,
        ]);

        if($meeting_details['send_sketches'])
        {
            Sketch::create([
                'order_id' => $order->id,
                'title' => $meeting_details['order_title'],
                'comment' => $meeting_details['order_description'],
                'is_primary' => 1,
                'deadline_date' => $deadline_date,
                'status_id' => SketchStatus::where('status', 'active')->first()->id,
            ]);
        }
 
        self::sendMeetingLetters($meeting_details, $meeting, $deadline_date, $meeting_link, $amount);

        return true;
    }

    public static function editMeeting($meeting_details)
    {
        $deadline_date = FeaturesHelper::getDate($meeting_details['date'], 'sql');
        $meeting_link = 'www.zoom.com';
        $amount = isset($meeting_details['amount']) ?? 0;

        $meeting = self::getMeeting($meeting_details['meeting_id']);

        $meeting->update([
            'deadline_date' => $deadline_date,
            'link' => $meeting_link
        ]);

        $meeting_info = $meeting->meeting_info();

        $meeting_info->update([
            'title' => $meeting_details['order_title'],
            'description' => $meeting_details['order_description'],
            'is_male_clothes' => $meeting_details['is_male'],
            'send_sketches_before' => $meeting_details['send_sketches']
        ]);

        MeetingAttachment::where('meeting_id', $meeting->id)->delete();

        foreach ($meeting_details['attachments'] as $file) {

            MeetingAttachment::create([
                'meeting_id' => $meeting->id,
                'file' => $file
            ]);

        }

        if(!$meeting_details['is_free_edit'])
        {
            MeetingPayment::create([
                'meeting_id' => $meeting->id,
                'amount' => $amount
            ]);
        }

        $order = $meeting->order();

        $order->update([
            'title' => $meeting_details['order_title'],
            'description' => $meeting_details['order_description'],
            'amount' => '0',
            'technique' => '',
            'is_male_clothes' => $meeting_details['is_male'],
            'status_id' => OrderStatus::where('status', 'active')->first()->id,
        ]);

        if($meeting_details['send_sketches'])
        {
            $primarySketch = $order->primarySketch();

            if($primarySketch == null)
            {
                Sketch::create([
                    'order_id' => $order->id,
                    'title' => $meeting_details['order_title'],
                    'comment' => $meeting_details['order_description'],
                    'is_primary' => 1,
                    'deadline_date' => $deadline_date,
                    'status_id' => SketchStatus::where('status', 'active')->first()->id,
                ]);
            }
            else
            {
                $primarySketch->update([
                    'order_id' => $order->id,
                    'title' => $meeting_details['order_title'],
                    'comment' => $meeting_details['order_description'],
                    'is_primary' => 1,
                    'deadline_date' => $deadline_date,
                    'status_id' => SketchStatus::where('status', 'active')->first()->id,
                ]);
            }
        }

        self::sendMeetingLetters($meeting_details, $meeting, $deadline_date, $meeting_link, $amount);
        
        return true;
    }

    public static function sendMeetingLetters($meeting_details, $meeting, $deadline_date, $meeting_link, $amount)
    {
        $customer = $meeting->customer;
        $artist = $meeting->artist;
        $deadline_date = FeaturesHelper::getDate($deadline_date, 'full');

        $customer_letter = TranslateFeatures::getTranslate('meeting_customer_letter', 'Mail');
        $customer_letter = str_replace('{meeting_date}', $deadline_date, $customer_letter);
        $customer_letter = str_replace('{artist}', $customer->user_info()->name . ' ' . $customer->user_info()->surname, $customer_letter);
        $customer_letter = str_replace('{link}', $meeting_link, $customer_letter);
        $customer_letter = str_replace('{amount}', $amount, $customer_letter);

        $artist_letter = TranslateFeatures::getTranslate('meeting_artist_letter', 'Mail');
        $artist_letter = str_replace('{meeting_date}', $deadline_date, $artist_letter);
        $artist_letter = str_replace('{customer}', $artist->user_info()->name . ' ' . $artist->user_info()->surname, $artist_letter);
        $artist_letter = str_replace('{link}', $meeting_link, $artist_letter);
        $artist_letter = str_replace('{amount}', $amount, $artist_letter);

        if($meeting_details['send_sketches'])
            $artist_letter .= ' ' . TranslateFeatures::getTranslate('meeting_artist_pre_sketch', 'Mail');

        MailManager::sendEmail($customer->user_info()->email, TranslateFeatures::getTranslate('meeting_letter_title', 'Mail'), 
            $customer_letter);

        MailManager::sendEmail($artist->user_info()->email, TranslateFeatures::getTranslate('meeting_letter_title', 'Mail'), 
            $artist_letter);

        return true;
    }

    public static function removeMeeting($meeting_id)
    {
        $meeting = self::getMeeting($meeting_id);

        foreach ($meeting->meeting_attachments() as $attachment) {
            $path = str_replace('/storage', 'public', $attachment->file);
            Storage::delete($path);
            $attachment->delete();
        }

        $meeting->delete();
    }

    public static function startMeeting($meeting_id)
    {
        $meeting = self::getMeeting($meeting_id);
        $order = $meeting->order();

        $sketch_deadline_date = FeaturesHelper::getSketchDeadlineDate();

        Sketch::create([
            'order_id' => $order->id,
            'title' => $order->title,
            'comment' => $order->description,
            'deadline_date' => $sketch_deadline_date,
            'status_id' => SketchStatus::where('status', 'active')->first()->id,
        ]);

        $customer = $meeting->customer;
        $artist = $meeting->artist;

        $primarySketch = $order->primarySketch();

        if($primarySketch)
        {
            if($primarySketch->sended_date == null)
            {
                $not_sent_sketches_letter = TranslateFeatures::getTranslate('not_sent_sketches_text', 'Mail');
                $not_sent_sketches_letter = str_replace('{customer}', $artist->user_info()->name . ' ' . $artist->user_info()->surname, $not_sent_sketches_letter);
                MailManager::sendEmail($artist->user_info()->email, TranslateFeatures::getTranslate('not_sent_sketches_title', 'Mail'), $not_sent_sketches_letter);
            }

            $primarySketch->delete();
        }

        $customer_letter = TranslateFeatures::getTranslate('meet_start_customer_text', 'Mail');
        $customer_letter = str_replace('{artist}', $customer->user_info()->name . ' ' . $customer->user_info()->surname, $customer_letter);
        $customer_letter = str_replace('{link}', $meeting->link, $customer_letter);

        $artist_letter = TranslateFeatures::getTranslate('meet_start_artist_text', 'Mail');
        $artist_letter = str_replace('{customer}', $artist->user_info()->name . ' ' . $artist->user_info()->surname, $artist_letter);
        $artist_letter = str_replace('{link}', $meeting->link, $artist_letter);

        $letter_title = TranslateFeatures::getTranslate('meeting_start_title', 'Mail');

        MailManager::sendEmail($customer->user_info()->email, $letter_title, $customer_letter);
        MailManager::sendEmail($artist->user_info()->email, $letter_title, $artist_letter);

        $meeting->update(['is_complete' => 1]);
    }

    public static function remindAboutMeetings()
    {
        $meetings = Meeting::whereRaw('is_complete = 0 AND is_alerted = 0 AND TIMESTAMPDIFF( MINUTE, NOW(), deadline_date ) <= 60')->get();

        foreach ($meetings as $meeting) 
        {
            $meeting->is_alerted = 1;
            $meeting->save();

            $customer = $meeting->customer;
            $artist = $meeting->artist;
    
            $customer_letter = TranslateFeatures::getTranslate('meet_remind_client_text', 'Mail');
            $customer_letter = str_replace('{artist}', $customer->user_info()->name . ' ' . $customer->user_info()->surname, $customer_letter);
    
            $artist_letter = TranslateFeatures::getTranslate('meet_remind_artist_text', 'Mail');
            $artist_letter = str_replace('{customer}', $artist->user_info()->name . ' ' . $artist->user_info()->surname, $artist_letter);
    
            $letter_title = TranslateFeatures::getTranslate('meeting_remind_title', 'Mail');
    
            MailManager::sendEmail($customer->user_info()->email, $letter_title, $customer_letter);
            MailManager::sendEmail($artist->user_info()->email, $letter_title, $artist_letter);

        }
    }

    public static function scheduleMeetings()
    {
        $meetings = Meeting::where('is_complete', '0')->where('deadline_date', '<=', \DB::raw('NOW()'))->get('id');

        foreach ($meetings as $meeting) 
            MeetingFeatures::startMeeting($meeting->id);
    }
}
