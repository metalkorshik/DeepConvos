<?php

namespace App\Http\Controllers;
use App\Models\Features\UserFeatures;
use App\Models\Features\MeetingFeatures;
use Illuminate\Support\Facades\Auth;
use App\Helper\FeaturesHelper;

use Illuminate\Http\Request;

class MeetingsController extends Controller
{
    public function index()
    {
        $user_info = UserFeatures::getUserInfo(Auth::id());
        $meetings = MeetingFeatures::getMeetings();

        return $this->handleView('meetings', [ 'user_info' => $user_info, 'meetings' => $meetings ]);
    }

    public function order(Request $request)
    {
        $artist_id = null;
        $data = [];
        $action = '/meeting-payment';

        if(isset($request->meeting_id))
        {
            $meeting = MeetingFeatures::getMeeting($request->meeting_id);
            $artist_id = $meeting->artist->id;
            $meeting_info = MeetingFeatures::getMeetingInfo($request->meeting_id);
            $data['is_male_clothes'] = $meeting_info['is_male_clothes'];

            $hours_remains = FeaturesHelper::getHoursRemains($meeting_info['deadline_date']);
            $is_free_edit = 1;

            if($hours_remains < 24)
                $is_free_edit = 0;

            $meeting_info['is_free_edit'] = $is_free_edit;
            $data['meeting_info'] = $meeting_info;

            if($is_free_edit)
                $action = '/meeting-success';
        }
        else if(isset($request->artist_id))
            $artist_id = $request->artist_id;

        if($artist_id == Auth::id())
            return back();

        $artist = UserFeatures::getArtist($artist_id);
        $user_info = UserFeatures::getUserInfo(Auth::id());
        $data['user_info'] = $user_info;
        $data['artist'] = $artist;
        $data['action'] = $action;

        if(!isset($data['is_male_clothes']))
            $data['is_male_clothes'] = $user_info['is_male'];

        return $this->handleView('meeting_order', $data);
    }

    private function processOrder(Request $request)
    {
        $attachments = [];

        $files = $request->file('attachments');

        if($files)
        {
            foreach ($request->file('attachments') as $file) {
                $attachment = $file->storeAs('public/attachments', $file->getClientOriginalName());
                $attachment = str_replace('public/', '/storage/', $attachment);
                $attachments[] = $attachment;
            }
        }

        $meeting_details = [
            'customer_id' => Auth::id(),
            'artist_id' => $request->artist_id,
            'is_male' => $request->is_male,
            'send_sketches' => +$request->send_sketches,
            'date' => $request->date,
            'order_title' => $request->order_title,
            'order_description' => $request->order_description,
            'attachments' => $attachments,
            'is_free_edit' => $request->is_free_edit,
        ];

        if($request->meeting_id != 0)
            $meeting_details['meeting_id'] = $request->meeting_id;

        return $meeting_details;
    }

    public function payment(Request $request, $remove_action = false, $meeting_details = null)
    {
        if(!$remove_action)
            $meeting_details = $this->processOrder($request);

        $amount = FeaturesHelper::getSiteFeature('meeting_amount');
        $user_info = UserFeatures::getUserInfo(Auth::id());

        return $this->handleView('payment', [ 'user_info' => $user_info, 
            'meeting_details' => json_encode($meeting_details), 'remove_meeting' => $remove_action, 'action' => '/meeting-success', 
            'amount' => $amount, 'purpose' => 'meeting' ]);
    }

    public function success(Request $request)
    {
        if(isset($request->remove_meeting) && $request->remove_meeting)
        {
            $meeting_details = json_decode($request->meeting_details, true);
            MeetingFeatures::removeMeeting($meeting_details['id']);
            return redirect('/meetings');
        }
        else
        {
            if(isset($request->meeting_id) && isset($request->is_free_edit) && $request->is_free_edit)
                $meeting_details = $this->processOrder($request);
            else
            {
                $meeting_details = json_decode($request->meeting_details, true);
                $meeting_details['amount'] = $request->amount;
            }

            if(isset($meeting_details['meeting_id']))
                MeetingFeatures::editMeeting($meeting_details);
            else
                MeetingFeatures::addMeeting($meeting_details);

            $user_info = UserFeatures::getUserInfo(Auth::id());
            return $this->handleView('meeting_success', [ 'user_info' => $user_info ]);
        }
    }

    public function removeMeeting(Request $request)
    {
        $meeting = MeetingFeatures::getMeeting($request->meeting_id);
        $hours_remains = FeaturesHelper::getHoursRemains($meeting->deadline_date);
        $meeting_details = MeetingFeatures::getMeetingInfo($request->meeting_id);

        if($hours_remains < 24)
            return $this->payment($request, true, $meeting_details);
        else
        {
            MeetingFeatures::removeMeeting($request->meeting_id);
            return redirect('/meetings');
        }
    }
}