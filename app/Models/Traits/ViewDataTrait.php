<?php

namespace App\Models\Traits;
use App;
use Illuminate\Support\Facades\Session;
use App\Models\Features\TranslateFeatures;

trait ViewDataTrait
{
    function handleView($viewName, $data = []) { 
        
        $page_name = $this->getViewPage($viewName);
        $locale = Session::get('locale') ?? 'en';
        App::setLocale($locale);
        $next_locale = $locale == 'en' ? 'ru' : 'en';
        $translates = TranslateFeatures::getTranslates($page_name);

        $data['current_page'] = $viewName;
        $data['translates'] = $translates;
        $data['locale'] = $locale;
        $data['next_locale'] = $next_locale;
        $data['locale_text'] = ucfirst($locale);
        $data['next_locale_text'] = ucfirst($next_locale);

        return view($viewName, $data);

    }

    private function getViewPage($viewName)
    {
        $page_name = 'General';

        switch ($viewName) {
            case 'account':
                $page_name = 'Account';
                break;
            case 'login':
                $page_name = 'Login';
                break;
            case 'favorite_artists':
                $page_name = 'Favorite artists';
                break;
            case 'favorite_works':
                $page_name = 'Favorite works';
                break;
            case 'registration_success':
                $page_name = 'Login';
                break;
            case 'index':
                $page_name = 'Main';
                break;
            case 'main':
                $page_name = 'Main';
                break;
            case 'policy':
                $page_name = 'Policy';
                break;
            case 'terms':
                $page_name = 'Terms';
                break;
            case 'collections':
                $page_name = 'Collections';
                break;
            case 'artists':
                $page_name = 'Artists';
                break;
            case 'artist':
                $page_name = 'Artist';
                break;
            case 'artist_work':
                $page_name = 'Artist work';
                break;
            case 'order_payment_success':
                $page_name = 'Order payment success';
                break;
            case 'checkout':
                $page_name = 'Checkout';
                break;
            case 'review_success':
                $page_name = 'Review success';
                break;
            case 'meetings':
                $page_name = 'Meetings';
                break;
            case 'meeting_order':
                $page_name = 'Order';
                break;
            case 'payment':
                $page_name = 'Payment';
                break;
            case 'meeting_success':
                $page_name = 'Meeting success';
                break;
            case 'sketches':
                $page_name = 'Sketches';
                break;
            case 'sketch':
                $page_name = 'Sketch';
                break;
            case 'sketch_forms':
                $page_name = 'Sketch forms';
                break;
        }

        return $page_name;
    }

}
