<?php

namespace App\Orchid\Screens\SiteStyle;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Relation;

use App\Models\Styles\SiteStyle;
use App\Models\Features\StyleFeatures;

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

    public $style_id = false;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(SiteStyle $style): array
    {
        $this->exists = $style->exists;
        $this->style_id = $style->id;

        if ($this->exists)
            $this->name = 'Edit record';

        return [
            'style' => $style
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
                Input::make('style.key')
                    ->title('Key'),

                Button::make('Save')->method('createOrUpdate')->parameters([ 'is_edit' => $this->exists, 'style_id' => $this->style_id ])
            ])
        ];
    }

    public function createOrUpdate(Request $request)
    {
        $result = $request->get('style');
        $style_id = $request->get('style_id');

        $validate = $request->validate([
            'style.key' => 'required',
        ]);

        $style = null;

        if($request->get('is_edit'))
        {
            StyleFeatures::editStyle($style_id, $result['key']);
            $style = SiteStyle::findOrFail($style_id);
        }
        else
            $style = new SiteStyle;

        $style->fill($result)->save();

        Alert::info('You have successfully created style');

        return redirect()->route('platform.site-style-translates', $style->id);
    }
}
