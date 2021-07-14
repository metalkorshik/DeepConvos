<?php

namespace App\Orchid\Screens\ArtistReward;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\DropDown;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

use Orchid\Screen\TD;
use App\Models\Orders\ArtistReward;
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
            'rewards' => ArtistReward::filters()->paginate()
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
            Layout::table('rewards', [
                TD::set('order')->filter(TD::FILTER_TEXT)
                ->render(function (ArtistReward $data) {
                    return Link::make($data->order->title)
                        ->route('platform.artist-reward', $data->id);
                }),
                TD::set('amount')->filter(TD::FILTER_TEXT)->sort(),
                TD::set('status')->filter(TD::FILTER_TEXT)->sort()
                ->render(function (ArtistReward $data) {
                    return Link::make($data->status->status)
                        ->route('platform.artist-reward', $data->id);
                }),
                TD::set(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(function (ArtistReward $data) {
                        return DropDown::make()
                            ->icon('options-vertical')
                            ->list([
                                Link::make(__('Edit'))
                                    ->route('platform.artist-reward', $data->id)
                                    ->icon('pencil'),
                            ]);
                    }),
            ])
        ];
    }

    public function remove(Request $request)
    {
        SiteCollectionProduct::findOrFail($request->get('id'))->delete();
        Toast::info(__('Product was removed'));
    }
}
