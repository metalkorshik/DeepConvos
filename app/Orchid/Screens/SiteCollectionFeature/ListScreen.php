<?php

namespace App\Orchid\Screens\SiteCollectionFeature;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\DropDown;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

use Orchid\Screen\TD;
use App\Models\SiteCollectionFeature;
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
            'features' => SiteCollectionFeature::filters()->paginate()
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
            // Link::make('Create')->route('platform.site-collection-feature')
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
                TD::set('feature')
                    ->filter(TD::FILTER_TEXT)
                    ->render(function (SiteCollectionFeature $data) {
                        return Link::make($data->name)
                            ->route('platform.site-collection-feature', $data->id);
                    }),
                TD::set(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(function (SiteCollectionFeature $data) {
                        return DropDown::make()
                            ->icon('options-vertical')
                            ->list([

                                Link::make(__('Edit'))
                                ->route('platform.site-collection-feature', $data->id)
                                ->icon('pencil'),
                            ]);
                    }),
            ])
        ];
    }

    public function remove(Request $request)
    {
        SiteCollectionFeature::findOrFail($request->get('id'))->delete();
        Toast::info(__('Feature was removed'));
    }
}
