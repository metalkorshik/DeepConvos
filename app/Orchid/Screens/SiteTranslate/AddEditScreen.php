<?php

namespace App\Orchid\Screens\SiteTranslate;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Relation;

use App\Models\SiteTranslate;
use App\Models\SitePage;
use App\Models\SiteLanguage;

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
    public function query(SiteTranslate $translate): array
    {
        $this->exists = $translate->exists;

        if ($this->exists)
            $this->name = 'Edit record';

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
                Relation::make('translate.page')
                    ->title('Page')
                    ->fromModel(SitePage::class, 'page', 'page'),

                Relation::make('translate.lang')
                    ->title('Language')
                    ->fromModel(SiteLanguage::class, 'lang'),

                Input::make('translate.key')
                    ->title('Key'),

                TextArea::make('translate.value')
                    ->title('Value')
                    ->rows(3),
                    // ->maxlength(200)

                Button::make('Save')->method('createOrUpdate')
            ])
        ];
    }

    public function createOrUpdate(SiteTranslate $translate, Request $request)
    {
        $validate = $request->validate([
            'translate.page' => 'required',
            'translate.lang' => 'required',
            'translate.key' => 'required|max:25|',
            'translate.value' => 'required',
        ]);

        $data = $request->get('translate');
        
        if(SiteTranslate::where('lang', $data['lang'])->where('key', $data['key'])->where('page', $data['page'])->count() > 0)
            Alert::info('This key is already exists!');
        else
        {
            $translate->fill($request->get('translate'))->save();

            Alert::info('You have successfully created translate');

            return redirect()->route('platform.site-translates');
        }
    }

    public function remove(SiteTranslate $translate)
    {
        $translate->delete();

        Alert::info('You have successfully deleted translate');

        return redirect()->route('platform.site-translates');
    }
}
