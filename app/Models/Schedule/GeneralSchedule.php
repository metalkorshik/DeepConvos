<?php

namespace App\Models\Schedule;
use App;
use App\Models\Features\MeetingFeatures;
use App\Models\Features\SketchFeatures;

class GeneralSchedule
{
    public function __invoke()
    {
        MeetingFeatures::scheduleMeetings();
        MeetingFeatures::remindAboutMeetings();
        SketchFeatures::remindAboutSketches();
    }
}