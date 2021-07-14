<?php

namespace App\Orchid\Screens\SiteTranslate;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\DropDown;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\Group;

use Orchid\Screen\TD;
use App\Models\SiteTranslate;
use App\Models\Features\TranslateFeatures;
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
            'translates' => SiteTranslate::where('is_specific', 0)->filters()->paginate()
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
            Link::make('Create')->route('platform.site-translate'),
            Button::make('Sync translate')->method('sync')
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
            Layout::table('translates', [
                TD::set('key')
                    ->filter(TD::FILTER_TEXT)//->sort()
                    /* ->render(function (SiteTranslate $data) {
                        return Link::make($data->key)
                            ->route('platform.site-translate', $data->id);
                    }) */,
                TD::set('value')->filter(TD::FILTER_TEXT)->render(function (SiteTranslate $data) {
                    return mb_substr($data->value, 0, 50) . (strlen($data->value) > 50 ? '...' : '');
                }),
                TD::set('page')->filter(TD::FILTER_TEXT)->sort(),
                TD::set('lang')->filter(TD::FILTER_TEXT)->sort(),
                TD::set(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(function (SiteTranslate $data) {
                        return DropDown::make()
                            ->icon('options-vertical')
                            ->list([

                                Button::make(__('Sync'))
                                    ->method('syncOne')
                                    ->parameters([
                                        'id' => $data->id,
                                    ])
                                    ->icon('refresh'),

                                Link::make(__('Edit'))
                                    ->route('platform.site-translate', $data->id)
                                    ->icon('pencil'),

                                Button::make(__('Delete'))
                                    ->confirm('Are you sure you want to delete this item?')
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
        SiteTranslate::findOrFail($request->get('id'))->delete();
        Toast::info(__('Translate was removed'));
    }

    private function createLangFile()
    { 
        return TranslateFeatures::createLangFile();
    }

    public function sync(Request $request)
    {
        TranslateFeatures::syncTranslates();
        Toast::info('You successfully synchronized translates');
    }

    public function syncOne(Request $request)
    {
        TranslateFeatures::syncOneTranslate($request->get('id'));
        Toast::info('You successfully synchronized translates');
    }
}
