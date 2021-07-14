<?php

namespace App\Orchid\Screens\ReturnedFunds;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\DropDown;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

use Orchid\Screen\TD;
use App\Models\Orders\ReturnedFunds;
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
            'funds' => ReturnedFunds::filters()->paginate()
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
            Layout::table('funds', [
                TD::set('customer')
                    ->filter(TD::FILTER_TEXT)->sort()
                    ->render(function (ReturnedFunds $data) {
                        return $data->order->meeting->customer->name . ' ' . $data->order->meeting->customer->user_info()->surname;
                    }),
                TD::set('order')
                ->filter(TD::FILTER_TEXT)->sort()
                ->render(function (ReturnedFunds $data) {
                    return $data->order->title;
                }),
                TD::set('amount')->filter(TD::FILTER_TEXT)->sort(),
            ])
        ];
    }

  
}
