<?php

namespace App\Orchid\Screens\SiteFeature;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Group;

use App\Models\SiteFeature;

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
    public function query(SiteFeature $feature): array
    {
        $this->exists = $feature->exists;

        if ($this->exists)
            $this->name = 'Edit record';

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

                Input::make('feature.feature')
                    ->title('Feature'),

                Button::make('Save')->method('createOrUpdate')
            ])
        ];
    }

    public function createOrUpdate(SiteFeature $feature, Request $request)
    {
          $validate = $request->validate([
            'feature.feature' => 'required'
        ]);

        $feature->fill($request->get('feature'))->save();

        Alert::info('You have successfully edited order');

        return redirect()->route('platform.site-features');
    }
}
