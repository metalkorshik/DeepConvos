<?php

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemMenu;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return ItemMenu[]
     */
    public function registerMainMenu(): array
    {
        return [

            /* TRANSLATES */

            ItemMenu::label('Translates')
                ->slug('translates')
                ->withChildren(),

            ItemMenu::label('Pages')
                ->place('translates')
                ->route('platform.site-pages'),

            ItemMenu::label('Languages')
                ->place('translates')
                ->route('platform.site-languages'),

            ItemMenu::label('Tranlsate')
                ->place('translates')
                ->route('platform.site-translates'),


            /* COLLECTIONS */

            ItemMenu::label('Collections')
                ->slug('collections')
                ->withChildren(),

            ItemMenu::label('Collections list')
                ->place('collections')
                ->route('platform.site-collections'),

            ItemMenu::label('Collection Orders')
                ->place('collections')
                ->route('platform.collection-orders'),

            ItemMenu::label('Products')
                ->place('collections')
                ->route('platform.site-collection-products'),

            ItemMenu::label('Sizes')
                ->place('collections')
                ->route('platform.site-sizes'),

            ItemMenu::label('Videos')
                ->place('collections')
                ->route('platform.site-collection-videos'),

            ItemMenu::label('Features')
                ->place('collections')
                ->route('platform.site-collection-features'),

            /* ARTISTS */

            ItemMenu::label('Artists')
                ->slug('artists')
                ->withChildren(),

            ItemMenu::label('Applies')
                ->place('artists')
                ->route('platform.applies'),

            ItemMenu::label('Styles')
                ->place('artists')
                ->route('platform.site-styles'),

            ItemMenu::label('Meetings')
                ->place('artists')
                ->route('platform.site-meetings'),

            ItemMenu::label('Orders')
                ->place('artists')
                ->route('platform.site-orders'),

            ItemMenu::label('Artists rewards')
                ->place('artists')
                ->route('platform.artist-rewards'),

            ItemMenu::label('Returned funds')
                ->place('artists')
                ->route('platform.returned-funds'),

            /* USERS */

            ItemMenu::label('Users')
                ->slug('users')
                ->withChildren(),

            ItemMenu::label('Mailing')
                ->place('users')
                ->route('platform.mailing'),

            /* FEATURES */

            ItemMenu::label('Features')
                ->route('platform.site-features'),

            // ItemMenu::label('Customers')
            //     ->place('users')
            //     ->route('platform.customers'),

            // ItemMenu::label('Artists')
            //     ->place('users')
            //     ->route('platform.artists'),
            

            /* DEFAULT PAGES */

            // ItemMenu::label('Example screen')
            //     ->icon('monitor')
            //     ->route('platform.example')
            //     ->title('Navigation')
            //     ->badge(function () {
            //         return 6;
            //     }),

            // ItemMenu::label('Dropdown menu')
            //     ->slug('example-menu')
            //     ->icon('code')
            //     ->withChildren(),

            // ItemMenu::label('Sub element item 1')
            //     ->place('example-menu')
            //     ->icon('bag'),

            // ItemMenu::label('Sub element item 2')
            //     ->place('example-menu')
            //     ->icon('heart'),

            // ItemMenu::label('Basic Elements')
            //     ->title('Form controls')
            //     ->icon('note')
            //     ->route('platform.example.fields'),

            // ItemMenu::label('Advanced Elements')
            //     ->icon('briefcase')
            //     ->route('platform.example.advanced'),

            // ItemMenu::label('Text Editors')
            //     ->icon('list')
            //     ->route('platform.example.editors'),

            // ItemMenu::label('Overview layouts')
            //     ->title('Layouts')
            //     ->icon('layers')
            //     ->route('platform.example.layouts'),

            // ItemMenu::label('Chart tools')
            //     ->icon('bar-chart')
            //     ->route('platform.example.charts'),

            // ItemMenu::label('Cards')
            //     ->icon('grid')
            //     ->route('platform.example.cards'),

            // ItemMenu::label('Documentation')
            //     ->title('Docs')
            //     ->icon('docs')
            //     ->url('https://orchid.software/en/docs'),
        ];
    }

    /**
     * @return ItemMenu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            ItemMenu::label('Profile')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemMenu[]
     */
    public function registerSystemMenu(): array
    {
        return [
            ItemMenu::label(__('Access rights'))
                ->icon('lock')
                ->slug('Auth')
                ->active('platform.systems.*')
                ->permission('platform.systems.index')
                ->sort(1000),

            ItemMenu::label(__('Users'))
                ->place('Auth')
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->sort(1000)
                ->title(__('All registered users')),

            ItemMenu::label(__('Roles'))
                ->place('Auth')
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles')
                ->sort(1000)
                ->title(__('A Role defines a set of tasks a user assigned the role is allowed to perform.')),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('Systems'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }

    /**
     * @return string[]
     */
    public function registerSearchModels(): array
    {
        return [
            // ...Models
            // \App\Models\User::class
        ];
    }
}
