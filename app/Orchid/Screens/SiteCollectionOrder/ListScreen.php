<?php

namespace App\Orchid\Screens\SiteCollectionOrder;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\DropDown;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

use Orchid\Screen\TD;
use App\Models\SiteCollectionOrder;
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
            'orders' => SiteCollectionOrder::filters()->paginate()
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
            // Link::make('Create')->route('platform.collection-order')
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
            Layout::table('orders', [
                TD::set('product')->filter(TD::FILTER_TEXT)
                ->render(function (SiteCollectionOrder $data) {
                    return Link::make($data->product->name)
                        ->route('platform.collection-order', $data->id);
                }),
                TD::set('amount')->filter(TD::FILTER_TEXT)->sort(),
                TD::set('address')->filter(TD::FILTER_TEXT)->sort(),
                TD::set('date')->filter(TD::FILTER_TEXT)->sort(),
                TD::set(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(function (SiteCollectionOrder $data) {
                        return DropDown::make()
                            ->icon('options-vertical')
                            ->list([
                                Link::make(__('Edit'))
                                    ->route('platform.collection-order', $data->id)
                                    ->icon('pencil'),
                            ]);
                    }),
            ])
        ];
    }
}
