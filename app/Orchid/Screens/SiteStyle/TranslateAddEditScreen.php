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
use App\Models\Styles\SiteStyleTranslate;
use App\Models\SiteTranslate;
use App\Models\SitePage;
use App\Models\SiteLanguage;
use App\Models\Features\StyleFeatures;

class TranslateAddEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'TranslateAddEditScreen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'TranslateAddEditScreen';

     /**
     * Current style.
     *
     * @var string|null
     */
    public $style_id = null;

    /**
     * Current translate.
     *
     * @var string|null
     */
    public $translate_id = null;

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Request $request): array
    {
        $this->style_id = $request->style;
        $this->translate_id = $request->translate;
        $translate = null;

        $this->exists = $this->translate_id != null;

        if ($this->exists)
        {
            $this->name = 'Edit record';
            $translate = SiteStyleTranslate::findOrFail($this->translate_id);
        }
        else
            $translate = new SiteStyleTranslate;

        return [
            'translate' => $translate
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
                Relation::make('translate.translate.lang')
                    ->title('Language')
                    ->fromModel(SiteLanguage::class, 'lang'),

                TextArea::make('translate.translate.value')
                    ->title('Value')
                    ->rows(3),

                Button::make('Save')->method('createOrUpdate')->parameters([ 'style_id' => $this->style_id, 
                    'translate_id' => $this->translate_id, 'is_edit' => $this->exists ])
            ])
        ];
    }

    public function createOrUpdate(Request $request)
    {
        $validate = $request->validate([
            'translate.translate.lang' => 'required',
            'translate.translate.value' => 'required',
        ]);

        $style_id = $request->get('style_id');
        $translate_id = $request->get('translate_id');
        $is_edit = $request->get('is_edit');
        $result = $request->get('translate')['translate'];

        if($is_edit)
            StyleFeatures::editStyleTranslate($translate_id, $result['lang'], $result['value']);
        else
            StyleFeatures::addStyleTranslate($style_id, $result['lang'], $result['value']);

        Alert::info('You have successfully created translate');

        return redirect()->route('platform.site-style-translates', $style_id);
    }
}
