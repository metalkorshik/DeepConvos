<?php

namespace App\Orchid\Screens\SiteFeature;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\DropDown;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

use Orchid\Screen\TD;
use App\Models\SiteFeature;
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
            'features' => SiteFeature::filters()->paginate()
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
            Layout::table('features', [
                TD::set('name')
                ->filter(TD::FILTER_TEXT)->sort()
                ->render(function (SiteFeature $data) {
                    return Link::make($data->name)
                        ->route('platform.site-feature', $data->id);
                }),
                TD::set(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(function (SiteFeature $data) {
                        return DropDown::make()
                            ->icon('options-vertical')
                            ->list([
                                Link::make(__('Edit'))
                                    ->route('platform.site-feature', $data->id)
                                    ->icon('pencil'),
                            ]);
                    }),
            ])
        ];
    }

  
}
