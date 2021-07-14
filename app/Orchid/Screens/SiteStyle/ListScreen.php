<?php

namespace App\Orchid\Screens\SiteStyle;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\DropDown;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

use Orchid\Screen\TD;
use App\Models\Styles\SiteStyle;
use App\Models\Features\StyleFeatures;
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
            'styles' => SiteStyle::filters()->paginate()
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
            Link::make('Create')->route('platform.site-style')
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
            Layout::table('styles', [
                TD::set('key')
                    ->filter(TD::FILTER_TEXT)->sort()
                    ->render(function (SiteStyle $data) {
                        return Link::make($data->key)
                            ->route('platform.site-style-translates', $data->id);
                    }),
                TD::set(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(function (SiteStyle $data) {
                        return DropDown::make()
                            ->icon('options-vertical')
                            ->list([
                                Link::make(__('Edit'))
                                    ->route('platform.site-style', $data->id)
                                    ->icon('pencil'),

                                Button::make(__('Delete'))
                                    ->confirm('Are you sure you want to delete the style?')
                                    ->method('remove')
                                    ->parameters([
                                        'id' => $data->id,
                                    ])
                                    ->icon('trash'),
                            ]);
                    }),
            ])
        ];
    }

    public function remove(Request $request)
    {
        StyleFeatures::removeStyle($request->get('id'));
        Toast::info('Style was removed');
    }
}
