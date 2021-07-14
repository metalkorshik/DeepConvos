<?php

namespace App\Orchid\Screens\SiteCollectionVideo;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Relation;

use App\Models\SiteCollectionVideo;

class AddEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'AddEditScreen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'AddEditScreen';

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(SiteCollectionVideo $video): array
    {
        $this->exists = $video->exists;

        if ($this->exists)
            $this->name = 'Edit sitePage';

        return [
            'video' => $video
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
            // Button::make('Remove')
            //     ->icon('trash')
            //     ->method('remove')
            //     ->canSee($this->exists),
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
            Layout::rows([
                Input::make('video.video')
                    ->title('Video')
                    ->type('url'),

                Button::make('Save')->method('createOrUpdate')
            ])
        ];
    }

    public function createOrUpdate(SiteCollectionVideo $data, Request $request)
    {
        $validate = $request->validate([
            'video.video' => 'required'
        ]);

        $data->fill($request->get('video'))->save();

        Alert::info('You have successfully created video');

        return redirect()->route('platform.site-collection-videos');
    }

    public function remove(SiteCollectionVideo $data)
    {
        $data->delete();

        Alert::info('You have successfully deleted video');

        return redirect()->route('platform.site-collection-videos');
    }
}
