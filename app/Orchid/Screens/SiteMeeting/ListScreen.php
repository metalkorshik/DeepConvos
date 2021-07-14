<?php

namespace App\Orchid\Screens\SiteMeeting;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\DropDown;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

use Orchid\Screen\TD;
use App\Models\Orders\Meeting;
use App\Models\Features\MeetingFeatures;
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
            'meetings' => Meeting::filters()->paginate()
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
            Layout::table('meetings', [
                TD::set('customer')
                    ->filter(TD::FILTER_TEXT)->sort()
                    ->render(function (Meeting $data) {
                        return Link::make($data->customer->name . ' ' . $data->customer->user_info()->surname)
                            ->route('platform.site-meeting', $data->id);
                    }),
                TD::set('artist')
                ->filter(TD::FILTER_TEXT)->sort()
                ->render(function (Meeting $data) {
                    return Link::make($data->artist->name . ' ' . $data->artist->user_info()->surname)
                        ->route('platform.site-meeting', $data->id);
                }),
                TD::set('date')
                ->filter(TD::FILTER_TEXT)->sort()
                ->render(function (Meeting $data) {
                    return Link::make($data->deadline_date)
                        ->route('platform.site-meeting', $data->id);
                }),
                TD::set(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(function (Meeting $data) {
                        return DropDown::make()
                            ->icon('options-vertical')
                            ->list([
                                Link::make(__('Edit'))
                                    ->route('platform.site-meeting', $data->id)
                                    ->icon('pencil'),
                            ]);
                    }),
            ])
        ];
    }

  
}
