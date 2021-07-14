<?php

namespace App\Models\Schedule;
use App;
use App\Models\ArtistApply;
use App\Models\Features\UserFeatures;

class ArtistApplySchedule
{
    public function __invoke()
    {
        $artist_applies = ArtistApply::onlyTrashed()->get();

        foreach ($artist_applies as $apply) 
        {
            $is_old = (time() - strtotime($apply->deleted_at))/60/60/24/30 >= 3;

            if($is_old)
                UserFeatures::removeApply($apply->id);
        }

    }
}
