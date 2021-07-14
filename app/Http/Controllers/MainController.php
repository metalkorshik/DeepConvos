<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteTranslate;
use App\Models\Features\CollectionFeatures;
use Illuminate\Support\Facades\Session;
use App;

class MainController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('log')->only('index');
        // $this->middleware('subscribed')->except('store');
    }

    public function index()
    {
        $collection = null;
        $results = CollectionFeatures::getCollections(0, true);

        if(count($results))
            $collection = $results[0];

        return $this->handleView('index', [ 'collection' => $collection ]);
    }

    public function main()
    {
        $collection = null;
        $results = CollectionFeatures::getCollections(0, true);

        if(count($results))
            $collection = $results[0];

        return $this->handleView('main', [ 'for_artists_page' => true, 'collection' => $collection ]);
    }

    public function policy()
    {
        return $this->handleView('policy', ['policy' => '']);
    }

    public function terms()
    {
        return $this->handleView('terms', ['terms' => '']);
    }

    public function changeLocale (Request $request) {

        $locale = $request->locale;
        $validLocale = in_array($locale, ['ru', 'en']);

        if ($validLocale) {
            Session::put('locale', $locale);
            App::setLocale($locale);
        }

        return response()->json(true);
    }
}
