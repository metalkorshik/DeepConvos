<?php

namespace App\Orchid\Screens\SiteOrder;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\DropDown;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

use Orchid\Screen\TD;
use App\Models\Orders\Order;
use App\Models\Features\SketchFeatures;
use App\Helper\FeaturesHelper;

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
            'orders' => Order::filters()->paginate()
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
            Layout::table('orders', [
                TD::set('customer')
                    ->filter(TD::FILTER_TEXT)->sort()
                    ->render(function (Order $data) {
                        return Link::make($data->meeting->customer->name . ' ' . $data->meeting->customer->user_info()->surname)
                            ->route('platform.site-order', $data->id);
                    }),
                TD::set('artist')
                ->filter(TD::FILTER_TEXT)->sort()
                ->render(function (Order $data) {
                    return Link::make($data->meeting->artist->name . ' ' . $data->meeting->artist->user_info()->surname)
                        ->route('platform.site-order', $data->id);
                }),
                TD::set('title')
                ->filter(TD::FILTER_TEXT)->sort()
                ->render(function (Order $data) {
                    return Link::make($data->title)
                        ->route('platform.site-order', $data->id);
                }),
                TD::set('amount')
                ->filter(TD::FILTER_TEXT)->sort()
                ->render(function (Order $data) {
                    return Link::make($data->amount)
                        ->route('platform.site-order', $data->id);
                }),
                TD::set(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(function (Order $data) {
                        return DropDown::make()
                            ->icon('options-vertical')
                            ->list([
                                Link::make(__('Edit'))
                                    ->route('platform.site-order', $data->id)
                                    ->icon('pencil'),
                            ]);
                    }),
            ])
        ];
    }

  
}
