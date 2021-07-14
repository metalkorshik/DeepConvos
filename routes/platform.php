<?php

declare(strict_types=1);

use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;


use App\Orchid\Screens;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Profile'), route('platform.profile'));
    });

// Platform > System > Users
Route::screen('users/{users}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(function (Trail $trail, $user) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('Edit'), route('platform.systems.users.edit', $user));
    });

// Platform > System > Users > User
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.index')
            ->push(__('Users'), route('platform.systems.users'));
    });

// Platform > System > Roles > Role
Route::screen('roles/{roles}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(function (Trail $trail, $role) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Role'), route('platform.systems.roles.edit', $role));
    });

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Create'), route('platform.systems.roles.create'));
    });

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.index')
            ->push(__('Roles'), route('platform.systems.roles'));
    });

// Example...
Route::screen('example', ExampleScreen::class)
    ->name('platform.example')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Example screen'));
    });

Route::screen('example-fields', ExampleFieldsScreen::class)->name('platform.example.fields');
Route::screen('example-layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
Route::screen('example-charts', ExampleChartsScreen::class)->name('platform.example.charts');
Route::screen('example-editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
Route::screen('example-cards', ExampleCardsScreen::class)->name('platform.example.cards');
Route::screen('example-advanced', ExampleFieldsAdvancedScreen::class)->name('platform.example.advanced');

//Route::screen('idea', 'Idea::class','platform.screens.idea');

/* TRANSLATES */

/* Model::SitePage */
Route::screen('site-page/{sitePage?}', Screens\SitePage\AddEditScreen::class)->name('platform.site-page');
Route::screen('site-pages/{sitePage?}', Screens\SitePage\ListScreen::class)->name('platform.site-pages');

/* Model::SiteLanguage */
Route::screen('site-language/{siteLanguage?}', Screens\SiteLanguage\AddEditScreen::class)->name('platform.site-language');
Route::screen('site-languages/{siteLanguage?}', Screens\SiteLanguage\ListScreen::class)->name('platform.site-languages');

/* Model::SiteTranslate */
Route::screen('site-translate/{siteTranslate?}', Screens\SiteTranslate\AddEditScreen::class)->name('platform.site-translate');
Route::screen('site-translates/{siteTranslate?}', Screens\SiteTranslate\ListScreen::class)->name('platform.site-translates');

/* COLLECTIONS */

/* Model::SiteCollection */
Route::screen('site-collection/{siteCollection?}', Screens\SiteCollection\AddEditScreen::class)->name('platform.site-collection');
Route::screen('site-collections/{siteCollection?}', Screens\SiteCollection\ListScreen::class)->name('platform.site-collections');

/* Model::SiteCollectionProduct */
Route::screen('site-collection-product/{siteCollectionProduct?}', Screens\SiteCollectionProduct\AddEditScreen::class)->name('platform.site-collection-product');
Route::screen('site-collection-products/{siteCollectionProduct?}', Screens\SiteCollectionProduct\ListScreen::class)->name('platform.site-collection-products');

/* Model::SiteSize */
Route::screen('site-size/{size?}', Screens\SiteSize\AddEditScreen::class)->name('platform.site-size');
Route::screen('site-sizes/{size?}', Screens\SiteSize\ListScreen::class)->name('platform.site-sizes');

/* Model::SiteCollectionVideo */
Route::screen('site-collection-video/{siteCollectionVideo?}', Screens\SiteCollectionVideo\AddEditScreen::class)->name('platform.site-collection-video');
Route::screen('site-collection-videos/{siteCollectionVideo?}', Screens\SiteCollectionVideo\ListScreen::class)->name('platform.site-collection-videos');

/* Model::SiteCollectionFeature */
Route::screen('site-collection-feature/{siteCollectionFeature?}', Screens\SiteCollectionFeature\AddEditScreen::class)->name('platform.site-collection-feature');
Route::screen('site-collection-features/{siteCollectionFeature?}', Screens\SiteCollectionFeature\ListScreen::class)->name('platform.site-collection-features');

/* ARTISTS */

/* Model::ArtistApply */
Route::screen('apply/{apply?}', Screens\Apply\AddEditScreen::class)->name('platform.apply');
Route::screen('applies/{apply?}', Screens\Apply\ListScreen::class)->name('platform.applies');

/* Model::SiteStyle */
Route::screen('style/{style?}', Screens\SiteStyle\AddEditScreen::class)->name('platform.site-style');
Route::screen('styles/{style?}', Screens\SiteStyle\ListScreen::class)->name('platform.site-styles');

/* Model::SiteStyleTranslate */
Route::screen('style-translate/{style?}/{translate?}', Screens\SiteStyle\TranslateAddEditScreen::class)->name('platform.site-style-translate');
Route::screen('style-translates/{translate?}', Screens\SiteStyle\TranslatesListScreen::class)->name('platform.site-style-translates');

/* Model::SiteMeeting */
Route::screen('meeting/{meeting?}', Screens\SiteMeeting\AddEditScreen::class)->name('platform.site-meeting');
Route::screen('meetings/{meeting?}', Screens\SiteMeeting\ListScreen::class)->name('platform.site-meetings');

/* Model::SiteOrder */
Route::screen('order/{order?}', Screens\SiteOrder\AddEditScreen::class)->name('platform.site-order');
Route::screen('orders/{order?}', Screens\SiteOrder\ListScreen::class)->name('platform.site-orders');

/* Model::ArtistReward */
Route::screen('artist-reward/{reward?}', Screens\ArtistReward\AddEditScreen::class)->name('platform.artist-reward');
Route::screen('artist-rewards/{reward?}', Screens\ArtistReward\ListScreen::class)->name('platform.artist-rewards');

/* Model::ReturnedFunds */
Route::screen('returned-funds/{funds?}', Screens\ReturnedFunds\ListScreen::class)->name('platform.returned-funds');

/* USERS */

/* Model::Mailing */
Route::screen('mailing', Screens\Mailing\ListScreen::class)->name('platform.mailing');

/* Model::CollectionOrder */
Route::screen('collection-order/{order?}', Screens\SiteCollectionOrder\AddEditScreen::class)->name('platform.collection-order');
Route::screen('collection-orders/{order?}', Screens\SiteCollectionOrder\ListScreen::class)->name('platform.collection-orders');

/* Model::User */
Route::screen('site-customer/{customer?}', Screens\Customer\AddEditScreen::class)->name('platform.customer');
Route::screen('site-customers/{customer?}', Screens\Customer\ListScreen::class)->name('platform.customers');

/* Model::User */
Route::screen('site-artist/{artist?}', Screens\Artist\AddEditScreen::class)->name('platform.artist');
Route::screen('site-artists/{artist?}', Screens\Artist\ListScreen::class)->name('platform.artists');

/* FEATURES */

/* Model::SiteFeature */
Route::screen('site-feature/{feature?}', Screens\SiteFeature\AddEditScreen::class)->name('platform.site-feature');
Route::screen('site-features/{feature?}', Screens\SiteFeature\ListScreen::class)->name('platform.site-features');