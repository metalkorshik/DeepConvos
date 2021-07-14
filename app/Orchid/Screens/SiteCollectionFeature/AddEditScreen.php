<?php

namespace App\Orchid\Screens\SiteCollectionFeature;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\DateTimer;

use App\Models\SiteCollectionFeature;

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
     * Keeps feature object.
     *
     * @var object|null
     */
    public $currentFeature = null;

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(SiteCollectionFeature $feature): array
    {
        $this->exists = $feature->exists;

        if ($this->exists)
        {
            $this->name = 'Edit feature';
            $this->currentFeature = $feature;
        }

        return [
            'feature' => $feature
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
        $viewRows = [];

        if($this->currentFeature && $this->currentFeature->key == 'release_date')
            $viewRows[] = DateTimer::make('feature.feature')->title('Value')->enableTime()->format('d.m.Y H:i:s');
        else
            $viewRows[] = Input::make('feature.feature')->title('Value');

        $viewRows[] = Button::make('Save')->method('createOrUpdate');

        return [
            Layout::rows($viewRows)
        ];
    }

    public function createOrUpdate(SiteCollectionFeature $data, Request $request)
    {
        $validate = $request->validate([
            'feature.feature' => 'required|max:100|'
        ]);

        $data->fill($request->get('feature'))->save();

        Alert::info('You have successfully created feature');

        return redirect()->route('platform.site-collection-features');
    }

    public function remove(SiteCollectionFeature $data)
    {
        $data->delete();

        Alert::info('You have successfully deleted feature');

        return redirect()->route('platform.site-collection-features');
    }
}
