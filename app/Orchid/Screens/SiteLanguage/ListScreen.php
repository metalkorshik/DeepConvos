<?php

namespace App\Orchid\Screens\SiteLanguage;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\DropDown;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

use Orchid\Screen\TD;
use App\Models\SiteLanguage;
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
            'languages' => SiteLanguage::filters()->paginate()
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
            Link::make('Create')->route('platform.site-language')
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
            Layout::table('languages', [
                TD::set('lang')
                    ->filter(TD::FILTER_TEXT)//->sort()
                    ->render(function (SiteLanguage $data) {
                        return Link::make($data->lang)
                            ->route('platform.site-language', $data->lang);
                    }),
                TD::set('code')
                    ->filter(TD::FILTER_TEXT),//->sort()
                TD::set(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(function (SiteLanguage $data) {
                        return DropDown::make()
                            ->icon('options-vertical')
                            ->list([

                                Link::make(__('Edit'))
                                ->route('platform.site-language', $data->lang)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->confirm('Are you sure you want to delete this item?')
                                ->method('remove')
                                ->parameters(['lang' => $data->lang])
                                ->icon('trash'),
                            ]);
                    }),
            ])
        ];
    }

    public function remove(Request $request)
    {
        SiteLanguage::findOrFail($request->get('lang'))->delete();
        Toast::info('Language was removed');
    }
}
