<?php

namespace App\Http\Controllers;
use App\Models\Features\TranslateFeatures;
use App\Models\User;
use App\Models\FavoriteArtist;
use App\Models\ArtistApply;
use App\Models\MailManager;
use App\Models\Features\UserFeatures;
use App\Models\Features\StyleFeatures;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class UsersController extends Controller
{
    public function account()
    {
        if(!Auth::check() || Auth::id() == 1)
            return redirect('/login');

        $user_info = UserFeatures::getUserInfo(Auth::id());
        $data = [];
        $data['user_info'] = $user_info;

        if($user_info['is_artist'])
        {
            $all_styles = StyleFeatures::getStyles();
            $artist_styles = StyleFeatures::getArtistStyles(Auth::user()->artist_details()->id);
            $artist_styles_keys = array_keys($artist_styles);
            $styles = [];
    
            foreach ($all_styles as $id => $style) 
                $styles[$id] = [ 'value' => $style, 'is_used' => in_array($id, $artist_styles_keys) ];

            $data['styles'] = $styles;
        }
        
        return $this->handleView('account', $data);
    }

    public function login($tab = 1)
    {
        return $this->handleView('login',
        [ 'active_tab' => $tab, 'register_customer_action' => '/register', 'register_artist_action' => '/artist_apply' ]);
    }

    public function signUp()
    {
        return $this->login(2);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function favoriteArtists()
    {
        $artists = UserFeatures::getFavoriteArtists(Auth::id());
        $user_info = UserFeatures::getUserInfo(Auth::id());

        return $this->handleView('favorite_artists', [ 'user_info' => $user_info, 'artists' => $artists ]);
    }

    public function favoriteWorks()
    {
        $user_info = UserFeatures::getUserInfo(Auth::id());
        return $this->handleView('favorite_works', [ 'user_info' => $user_info ]);
    }

    public function artistApply(Request $request)
    {
        if($request->email && !UserFeatures::isAppliedArtist($request->email))
        {
            $path = $request->file('portfolio')->store('public/artists_applies');
            $path = str_replace('public', '/storage', $path);

            $user_info = [
                'name' => $request->name,
                'surname' => $request->surname,
                'email' => $request->email,
                'phone' => $request->phone,
                'country' => $request->country,
                'city' => $request->city,
                'is_male' => $request->is_male,
                'is_artist' => true,
                'is_subscriber' => $request->is_subscriber,
                'image' => 'img/lk-images/customer.svg'
            ];

            $bank_details = [
                'card_number' => $request->card_number,
                'card_owner' => $request->card_owner,
                'card_validity' => $request->card_validity,
            ];

            $artist_details = [
                'birthdate' => $request->birthdate,
                'education' => '',
                'additional_education' => '',
                'participation' => '',
                'style_info' => '',
                'technique' => '',
                'about' => ''
            ];

            UserFeatures::applyArtist($user_info, $bank_details, $artist_details, $path);
            return $this->handleView('registration_success', [ 'user_email' => $request->email ]);
        }
        else
            return back();
    }

    public function updateArtistStyles(Request $request)
    {
        StyleFeatures::updateArtistStyles(Auth::user()->artist_details()->id, json_decode($request->styles, true));
        return response()->json(true);
    }

    public function updateUserDetails(Request $request)
    {
        $data = [];
        $data['id'] = Auth::id();

        if(isset($request->currentParticipations))
            UserFeatures::updateArtistAttachments($request->currentParticipations, 'participation');

        if(isset($request->currentPortfolios))
            UserFeatures::updateArtistAttachments($request->currentPortfolios, 'portfolio');

        if(isset($request->participations))
        {
            $participations = [];

            foreach ($request->participations as $file) {
                $image = $file->storeAs('public/artist_portfolio', $file->getClientOriginalName());
                $image = str_replace('public/', '/storage/', $image);
                $participations[] = $image;
            }

            $data['participations'] = $participations;
        }
        else if(isset($request->portfolios))
        {
            $portfolios = [];

            foreach ($request->portfolios as $file) {
                $image = $file->storeAs('public/artist_portfolio', $file->getClientOriginalName());
                $image = str_replace('public/', '/storage/', $image);
                $portfolios[] = $image;
            }

            $data['portfolios'] = $portfolios;
        }
        else
        {
            $data['user_info'] = [
                'name' => $request->name ?? '',
                'surname' => $request->surname ?? '',
                'email' => $request->email ?? '',
                'phone' => $request->phone ?? '',
                'country' => $request->country ?? '',
                'city' => $request->city ?? '',
                'is_subscriber' => $request->is_subscriber ?? false
            ];
    
            if($request->is_artist)
            {
                $data['bank_details'] = [
                    'card_number' => $request->card_number ?? '',
                    'card_owner' => $request->card_owner ?? '',
                    'card_validity' => $request->card_validity ?? '',
                ];
    
                $data['artist_details'] = [
                    'birthdate' => $request->birthdate ?? '',
                    'education' => $request->education ?? '',
                    'additional_education' => $request->additional_education ?? '',
                    'participation' => $request->participation ?? '',
                    'style_info' => $request->style_info ?? '',
                    'technique' => $request->technique ?? '',
                    'about' => $request->about ?? '',
                    'slogan' => $request->slogan ?? '',
                ];
            }
    
            if($request->file('avatar') != null)
            {
                $image = $request->file('avatar')->store('public/users_avatars');
                $image = str_replace('public/', '/storage/', $image);
                $data['user_info']['image'] = $image;
            }
        }

        UserFeatures::updateUserInfo($data);
        return redirect('/account');
    }

    public function removeUser(Request $request)
    {
        $id = Auth::id();
        Auth::logout();
        UserFeatures::removeUser($id);

        return redirect('/');
    }

    public function wishlistAddArtist(Request $request)
    {
        $exists = FavoriteArtist::where('customer_id', Auth::id())->where('artist_id', $request->id)->count();
        $result = false;
        
        if(!$exists)
        {
            $artist = FavoriteArtist::create([
                'customer_id' => Auth::id(),
                'artist_id' => $request->id
            ]);

            $result = $artist != null;
        }

        return response()->json($result);
    }

    public function wishlistRemoveArtist(Request $request)
    {
        FavoriteArtist::where('customer_id', Auth::id())->where('artist_id', $request->id)->delete();
        return response()->json(true);
    }

    public function subscribeToNews(Request $request)
    {
        UserFeatures::subscribeToNews($request->email);
        return back();
    }

    public function unsubscribeFromNews($id)
    {
        UserFeatures::unsubscribeFromNews($id);
        return redirect('/');
    }
}
