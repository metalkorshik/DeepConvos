<?php

namespace App\Orchid\Screens\SiteLanguage;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Relation;

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
    public function query(SiteLanguage $lang): array
    {
        $this->exists = $lang->exists;

        if ($this->exists)
            $this->name = 'Edit ';

        return [
            'lang' => $lang
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
                Input::make('lang.lang')
                    ->title('Language'),

                Input::make('lang.code')
                    ->title('Language code'),

                Button::make('Save')->method('createOrUpdate')
            ])
        ];
    }

    public function createOrUpdate(SiteLanguage $data, Request $request)
    {
        $validate = $request->validate([
            'lang.lang' => [
                'required',
                Rule::unique(SiteLanguage::class, 'lang')->ignore($data),
            ],
            'lang.code' => 'required|max:2'
        ]);

        $data->fill($request->get('lang'))->save();

        Alert::info('You have successfully created lang');

        return redirect()->route('platform.site-languages');
    }

    public function remove(SiteLanguage $data)
    {
        $data->delete();

        Alert::info('You have successfully deleted lang');

        return redirect()->route('platform.site-languages');
    }
}
