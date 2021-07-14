<?php

namespace App\Models\Features;
use Illuminate\Support\Facades\Storage;
use App\Models\ArtistApply;
use App\Models\ArtistAttachment;
use App\Models\ArtistDetails;
use App\Models\BankDetails;
use App\Models\UserInfo;
use App\Models\User;
use App\Models\FavoriteArtist;
use App\Models\MailManager;
use App\Models\Mailing;
use App\Models\Features\TranslateFeatures;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserFeatures
{
    public static function getUserInfo($id)
    {
        $user = User::findOrFail($id);
        $user_info = $user->user_info();

        $result = [
            'id' => $id,
            'name' => $user_info->name,
            'surname' => $user_info->surname,
            'email' => $user_info->email,
            'phone' => $user_info->phone,
            'country' => $user_info->country,
            'city' => $user_info->city,
            'image' => $user_info->image,
            'is_artist' => $user_info->is_artist,
            'is_male' => $user_info->is_male,
            'is_subscriber' => $user_info->is_subscriber,
        ];

        if($user_info->is_artist)
        {
            $bank_details = $user->bank_details();
            $artist_details = $user->artist_details();

            $result['card_number'] = $bank_details->card_number;
            $result['card_owner'] = $bank_details->card_owner;
            $result['card_validity'] = $bank_details->card_validity;

            $result['birthdate'] = $artist_details->birthdate;
            $result['slogan'] = $artist_details->slogan;
            $result['education'] = $artist_details->education;
            $result['additional_education'] = $artist_details->additional_education;
            $result['participation'] = $artist_details->participation;
            $result['style_info'] = $artist_details->style_info;
            $result['technique'] = $artist_details->technique;
            $result['about'] = $artist_details->about;

            $birthdate = strtotime($artist_details->birthdate);
            $datediff = time() - $birthdate;
            $age = floor($datediff / (60 * 60 * 24 * 30 * 12));

            $result['age'] = $age;

            $participations = [];
            $files = $artist_details->participations;

            foreach ($files as $file) 
                $participations[$file->id] = ['name' => basename($file->file), 'file' => $file->file];

            $result['participations'] = $participations;

            $portfolios = [];
            $files = $artist_details->portfolios;

            foreach ($files as $file) 
                $portfolios[$file->id] = ['name' => basename($file->file), 'file' => $file->file];

            $result['portfolios'] = $portfolios;
        }

        return $result;
    }

    public static function getArtists($filters = null)
    {
        $artists = [];
        $results = UserInfo::get()->where('is_artist', true)->where('user_id', '!=', null);

        foreach ($results as $item) 
        {
            $artist = self::getArtist($item->user_id);

            if($filters)
            {
                if(isset($filters['style']))
                {
                    $styles = array_keys($artist['styles']);

                    if(!in_array($filters['style'], $styles))
                        continue;
                }

                if((isset($filters['without_current']) && $filters['without_current']) && Auth::id() == $item->user_id)
                    continue;
            }

            $artists[] = $artist;
        }

        return $artists;
    }

    public static function paginateArtists($filters)
    {
        $offset = $filters['offset'] ?? 0;
        $artists = self::getArtists($filters);
        $general_count = count($artists);
        $artists = array_slice($artists, $offset, $filters['pagination_count']);
        $current_count = count($artists);
        $pages_count = $current_count > 0 ? ceil($general_count / $current_count) : 0;
        $current_page_number = $general_count > 0 ? ceil($offset * $pages_count / $general_count) + 1 : 0;

        return [ 'artists' => $artists, 'pages_count' => $pages_count, 'current_page_number' => $current_page_number ];
    }

    public static function getArtist($id)
    {
        $artist = [];
        $user_info = self::getUserInfo($id);
        $artist = array_merge($artist, $user_info);

        $user = User::findOrFail($id);
        $keyword_date = 'days';
        $duration = 1;

        $created_date = strtotime($user->created_at);
        $datediff = time() - $created_date;
        $days = floor($datediff / (60 * 60 * 24));

        if($days >= 365)
        {
            $keyword_date = 'years';
            $duration = floor($days / 365);
        }
        else if($days >= 30)
        {
            $keyword_date = 'months';
            $duration = floor($days / 30);
        }
        else 
            $duration = $days;

        $artist['styles'] = StyleFeatures::getArtistStyles($user->artist_details()->id);

        $styles_text = '';

        foreach ($artist['styles'] as $style) {
            $styles_text .= $style . ', ';
        }

        if(strlen($styles_text))
            $styles_text = substr($styles_text, 0, -2);

        $artist['styles_text'] = $styles_text;

        $artist['duration'] = $duration . ' ' . TranslateFeatures::getTranslate($keyword_date);
        $artist['rating'] = 4;
        $artist['comments_count'] = 10;

        if(Auth::check())
            $artist['is_favorite'] = FavoriteArtist::where('customer_id', Auth::id())->where('artist_id', $id)->count() > 0;

        return $artist;
    }

    public static function updateArtistAttachments($attachments, $type)
    {
        foreach ($attachments as $id) 
            ArtistAttachment::where('type', $type)->whereNotIn('id', $attachments)->delete();
    }

    public static function updateUserInfo($data)
    {
        $id = $data['id'];
        $user = User::findOrFail($id);

        if(isset($data['participations']))
        {
            foreach ($data['participations'] as $file) {
                ArtistAttachment::create([
                    'artist_details_id' => Auth::user()->artist_details()->id,
                    'file' => $file,
                    'type' => 'participation'
                ]);
            }
        }
        else if(isset($data['portfolios']))
        {
            foreach ($data['portfolios'] as $file) {
                ArtistAttachment::create([
                    'artist_details_id' => Auth::user()->artist_details()->id,
                    'file' => $file,
                    'type' => 'portfolio'
                ]);
            }
        }
        else if(isset($data['user_info']))
        {
            $user_info = $user->user_info();
            $user_info->name = $data['user_info']['name'];
            $user_info->surname = $data['user_info']['surname'];
            $user_info->email = $data['user_info']['email'];
            $user_info->phone = $data['user_info']['phone'];
            $user_info->country = $data['user_info']['country'];
            $user_info->city = $data['user_info']['city'];
            $user_info->is_subscriber = $data['user_info']['is_subscriber'];

            if(isset($data['user_info']['image']))
                $user_info->image = $data['user_info']['image'];

            $user_info->save();

            if($user_info->is_subscriber)
                self::subscribeToNews($user_info->email);
            else 
            {
                $mailing = Mailing::where('email', $user_info->email)->first();

                if($mailing != null)
                    self::unsubscribeFromNews($mailing->id);
            }

            if($user_info->is_artist)
            {
                if(isset($data['bank_details']))
                {
                    $bank_details = $user->bank_details();
                    $bank_details->card_number = $data['bank_details']['card_number'];
                    $bank_details->card_owner = $data['bank_details']['card_owner'];
                    $bank_details->card_validity = $data['bank_details']['card_validity'];
                    $bank_details->save();
                }
                
                if(isset($data['artist_details']))
                {
                    $artist_details = $user->artist_details();
                    $artist_details->birthdate = $data['artist_details']['birthdate'];
                    $artist_details->slogan = $data['artist_details']['slogan'];
                    $artist_details->education = $data['artist_details']['education'];
                    $artist_details->additional_education = $data['artist_details']['additional_education'];
                    $artist_details->participation = $data['artist_details']['participation'];
                    $artist_details->style_info = $data['artist_details']['style_info'];
                    $artist_details->technique = $data['artist_details']['technique'];
                    $artist_details->about = $data['artist_details']['about'];
                    $artist_details->save();
                }
            }
        }

        return true;
    }

    public static function removeUser($id)
    {
        $user = User::findOrFail($id);
        $user->user_info()->delete();
        $user->bank_details()->delete();
        $user->artist_details()->delete();
        $user->delete();
    }

    public static function applyArtist($user_info, $bank_details, $artist_details, $portfolio)
    {
        $user_info_obj = UserInfo::create($user_info);
        $bank_details_obj = BankDetails::create($bank_details);
        $artist_details_obj = ArtistDetails::create($artist_details);

        ArtistApply::create([
            'user_info_id' => $user_info_obj->id,
            'user_bank_details_id' => $bank_details_obj->id,
            'artist_details_id' => $artist_details_obj->id,
            'portfolio' => $portfolio
        ]);

        MailManager::sendEmail($user_info_obj->email, TranslateFeatures::getTranslate('review_apply_title', 'Mail'), 
            TranslateFeatures::getTranslate('review_apply_text', 'Mail'));
    }

    public static function acceptApply($id)
    {
        $apply = ArtistApply::findOrFail($id);

        $user_info = $apply->user_info;
        $bank_details = $apply->bank_details;
        $artist_details = $apply->artist_details;

        $password = bin2hex(openssl_random_pseudo_bytes(6));

        $new_user = User::create([
            'name' => $user_info->name,
            'email' => $user_info->email,
            'email_verified_at' => time(),
            'password' => Hash::make($password),
        ]);

        $user_info->user_id = $new_user->id;
        $bank_details->user_id = $new_user->id;
        $artist_details->user_id = $new_user->id;
        $user_info->save();
        $bank_details->save();
        $artist_details->save();

        if($user_info->is_subscriber)
            self::subscribeToNews($user_info->email);

        $path = $apply->portfolio;
        $path = str_replace('/storage', 'public', $path);

        Storage::delete($path);

        $apply->forceDelete();

        MailManager::sendEmail($user_info->email, TranslateFeatures::getTranslate('accepted_apply_title', 'Mail'), 
            TranslateFeatures::getTranslate('you_accepted_as_artist', 'Mail') . 
            TranslateFeatures::getTranslate('your_login', 'Mail') . ": {$user_info->email}" . 
            TranslateFeatures::getTranslate('your_password', 'Mail') . ": {$password}" . 
            TranslateFeatures::getTranslate('fill_account_details', 'Mail') . ": " . url('/account'));

        return true;
    }

    public static function denyApply($id)
    {
        $apply = ArtistApply::findOrFail($id);
        $user_email = $apply->user_info->email;

        $apply->delete();

        MailManager::sendEmail($user_email, TranslateFeatures::getTranslate('apply_denied_title', 'Mail'), 
            TranslateFeatures::getTranslate('appy_denied_text', 'Mail'));

        return true;
    }

    public static function removeApply($id)
    {
        $apply = ArtistApply::onlyTrashed()->findOrFail($id);
        
        $user_info = $apply->user_info;
        $bank_details = $apply->bank_details;
        $artist_details = $apply->artist_details;
        $user_email = $user_info->email;

        $path = $apply->portfolio;
        $path = str_replace('/storage', 'public', $path);
        Storage::delete($path);

        $apply->forceDelete();

        $user_info->delete();
        $bank_details->delete();
        $artist_details->delete();

        return true;
    }

    public static function getFavoriteArtists($custmer_id)
    {
        $artists = [];
        $results = FavoriteArtist::where('customer_id', $custmer_id)->get('artist_id');

        foreach ($results as $result) 
            $artists[] = self::getArtist($result->artist_id);

        return $artists;
    }

    public static function subscribeToNews($email)
    {
        if(Mailing::where('email', $email)->count() == 0)
        {
            Mailing::create(['email' => $email]);
            $user = UserInfo::where('email', $email)->first();

            if($user != null)
            {
                $user->is_subscriber = true;
                $user->save();
            }
        }
    }

    public static function unsubscribeFromNews($id)
    {
        $mailing = Mailing::findOrFail($id);
        $email = $mailing->email;
        $mailing->delete();

        $user = UserInfo::where('email', $email)->first();

        if($user != null)
        {
            $user->is_subscriber = false;
            $user->save();
        }
    }

    public static function isAppliedArtist($email)
    {
        $applies_count = \DB::table('artist_apply')
            ->join('users_info', 'users_info.id', '=', 'artist_apply.user_info_id')
            ->where('users_info.email', $email)->count();

        return $applies_count > 0;
    }
}
