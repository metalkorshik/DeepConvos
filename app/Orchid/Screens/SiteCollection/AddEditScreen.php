<?php

namespace App\Orchid\Screens\SiteCollection;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Relation;

use App\Models\SiteCollection;

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
    public function query(SiteCollection $collection): array
    {
        $this->exists = $collection->exists;

        if ($this->exists)
            $this->name = 'Edit collection';

        return [
            'collection' => $collection
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
            Layout::rows([
                Input::make('collection.name')
                    ->title('Name'),

                Input::make('collection.description')
                    ->title('Description'),

                Button::make('Save')->method('createOrUpdate')
            ])
        ];
    }

    public function createOrUpdate(SiteCollection $data, Request $request)
    {
        $validate = $request->validate([
            'collection.name' => 'required|max:200|',
            'collection.description' => 'required'
        ]);

        $data->fill($request->get('collection'))->save();

        Alert::info('You have successfully created collection');

        return redirect()->route('platform.site-collections');
    }

    public function remove(SiteCollection $data)
    {
        $data->delete();

        Alert::info('You have successfully deleted collection');

        return redirect()->route('platform.site-collections');
    }
}
