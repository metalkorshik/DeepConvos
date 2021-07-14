<?php

namespace App\Orchid\Screens\Apply;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\DropDown;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

use Orchid\Screen\TD;
use App\Models\ArtistApply;
use Illuminate\Http\Request;

class ListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'ListScreen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'ListScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'applies' => ArtistApply::filters()->paginate()
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            // Link::make('Create')->route('platform.apply')
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::table('applies', [
                TD::set('name')->filter(TD::FILTER_TEXT)->sort()
                ->render(function (ArtistApply $data) {
                    return Link::make($data->user_info->name)
                        ->route('platform.apply', $data->id);
                }),
                TD::set('surname')->filter(TD::FILTER_TEXT)->sort()
                ->render(function (ArtistApply $data) {
                    return Link::make($data->user_info->surname)
                        ->route('platform.apply', $data->id);
                }),
                TD::set('email')->filter(TD::FILTER_TEXT)->sort()
                ->render(function (ArtistApply $data) {
                    return Link::make($data->user_info->email)
                        ->route('platform.apply', $data->id);
                }),
                TD::set('birthdate')->filter(TD::FILTER_TEXT)->sort()
                ->render(function (ArtistApply $data) {
                    return Link::make($data->artist_details->birthdate)
                        ->route('platform.apply', $data->id);
                }),
                TD::set(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(function (ArtistApply $data) {
                        return DropDown::make()
                            ->icon('options-vertical')
                            ->list([
                                Link::make(__('Edit'))
                                    ->route('platform.apply', $data->id)
                                    ->icon('pencil'),
                            ]);
                    }),
            ])
        ];
    }
}
