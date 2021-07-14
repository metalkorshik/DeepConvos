<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistsController;
use App\Http\Controllers\CollectionsController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MeetingsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\SketchesController;
use App\Http\Controllers\UsersController;
use App\Models\SiteLanguage;
use App\Models\SitePage;
use App\Models\SiteTranslate;
use App\Http\Middleware\GeneralSiteData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['site-visitor'])->group(function () {

    Route::get('/', [MainController::class, 'index']);

    Route::get('/main', [MainController::class, 'main']);

    Route::post('change-locale', [MainController::class, 'changeLocale']);

    Route::get('/collections', [CollectionsController::class, 'index']);

    Route::get('/artists', [ArtistsController::class, 'index']);

    Route::post('/filter-artists', [ArtistsController::class, 'filterArtists']);

    Route::get('/artist/{id}', [ArtistsController::class, 'artist']);

    Route::get('/artist-work', [ArtistsController::class, 'artistWork']);

    Route::get('/policy', [MainController::class, 'policy']);

    Route::get('/terms', [MainController::class, 'terms']);

    Route::get('/sign-up', [UsersController::class, 'signUp']);

    Route::post('/artist_apply', [UsersController::class, 'artistApply']);

    Route::post('/get-collection-products', [CollectionsController::class, 'getProducts']);

    Route::post('/subscribe-to-news', [UsersController::class, 'subscribeToNews']);

    Route::get('/unsubscribe-from-news/{id}', [UsersController::class, 'unsubscribeFromNews']);

    Route::view('/registration_success', 'registration_success');

    Route::middleware(['auth:web'])->group(function () {

        Route::post('/meeting-order', [MeetingsController::class, 'order']);

        Route::post('/meeting-payment', [MeetingsController::class, 'payment']);

        Route::post('/meeting-success', [MeetingsController::class, 'success']);

        Route::post('/cancel-meeting', [MeetingsController::class, 'removeMeeting']);

        Route::get('/favorite-artists', [UsersController::class, 'favoriteArtists']);

        Route::get('/favorite-works', [UsersController::class, 'favoriteWorks']);

        Route::get('/checkout/{productId}', [OrdersController::class, 'checkout']);

        Route::get('/order-payment-success', [OrdersController::class, 'success']);

        Route::get('/account', [UsersController::class, 'account'])->middleware('auth');

        Route::get('/review-success', [OrdersController::class, 'reviewSuccess']);

        Route::get('/meetings', [MeetingsController::class, 'index']);

        Route::get('/sketches/{canceled_id?}', [SketchesController::class, 'index']);

        Route::get('/sketch/{id}', [SketchesController::class, 'sketch']);

        Route::post('/send-sketch', [SketchesController::class, 'sendSketch']);

        Route::post('/download-sketch', [SketchesController::class, 'downloadSketch']);

        Route::post('/accept-sketch', [SketchesController::class, 'sketchPayment']);

        Route::post('/sketch-success', [SketchesController::class, 'success']);

        Route::post('/review-artist', [SketchesController::class, 'reviewArtist']);

        Route::post('/revision-sketch', [SketchesController::class, 'revisionSketch']);

        Route::post('/cancel-sketch', [SketchesController::class, 'cancelSketch']);

        Route::post('/send-cancel-sketch-review', [SketchesController::class, 'sendCancelReview']);

        Route::post('/updateUserDetails', [UsersController::class, 'updateUserDetails']);

        Route::post('/remove-user', [UsersController::class, 'removeUser']);

        Route::post('/checkout-success', [OrdersController::class, 'checkoutSuccess']);

        Route::get('/logout', [UsersController::class, 'logout']);

        Route::post('/update-artist-styles', [UsersController::class, 'updateArtistStyles']);

        Route::post('/wishlist-artist-add', [UsersController::class, 'wishlistAddArtist']);

        Route::post('/wishlist-artist-remove', [UsersController::class, 'wishlistRemoveArtist']);

    });
});

Route::middleware(['dashboard'])->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});