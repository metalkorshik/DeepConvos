<?php

namespace App\Orchid\Screens\SitePage;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\DropDown;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

use Orchid\Screen\TD;
use App\Models\SitePage;
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
            'pages' => SitePage::where('is_specific', 0)->filters()->paginate()
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
            Link::make('Create')->route('platform.site-page')
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
            Layout::table('pages', [
                TD::set('page')
                    ->filter(TD::FILTER_TEXT)//->sort()
                    ->render(function (SitePage $data) {
                        return Link::make($data->page)
                            ->route('platform.site-page', $data->page);
                    }),
                TD::set(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(function (SitePage $data) {
                        return DropDown::make()
                            ->icon('options-vertical')
                            ->list([

                                Link::make(__('Edit'))
                                ->route('platform.site-page', $data->page)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->confirm('Are you sure you want to delete this item?')
                                ->method('remove')
                                ->parameters(['page' => $data->page])
                                ->icon('trash'),
                            ]);
                    }),
            ])
        ];
    }

    public function remove(Request $request)
    {
        SitePage::findOrFail($request->get('page'))->delete();
        Toast::info('Page was removed');
    }
}
