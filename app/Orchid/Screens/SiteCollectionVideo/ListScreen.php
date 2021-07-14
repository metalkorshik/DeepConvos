<?php

namespace App\Orchid\Screens\SiteCollectionVideo;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\DropDown;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

use Orchid\Screen\TD;
use App\Models\SiteCollectionVideo;
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
            'videos' => SiteCollectionVideo::filters()->paginate()
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
            Link::make('Create')->route('platform.site-collection-video')
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
            Layout::table('videos', [
                TD::set('video')
                    ->filter(TD::FILTER_TEXT)
                    ->render(function (SiteCollectionVideo $data) {
                        return Link::make($data->video)
                            ->route('platform.site-collection-video', $data->id);
                    }),
                TD::set(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(function (SiteCollectionVideo $data) {
                        return DropDown::make()
                            ->icon('options-vertical')
                            ->list([

                                Link::make(__('Edit'))
                                ->route('platform.site-collection-video', $data->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->confirm('Are you sure you want to delete this item?')
                                ->method('remove')
                                ->parameters(['id' => $data->id])
                                ->icon('trash'),
                            ]);
                    }),
            ])
        ];
    }

    public function remove(Request $request)
    {
        SiteCollectionVideo::findOrFail($request->get('id'))->delete();
        Toast::info(__('Video was removed'));
    }
}
