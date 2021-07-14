<?php

namespace App\Orchid\Screens\SitePage;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Relation;

use App\Models\SitePage;

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
    public function query(SitePage $page): array
    {
        $this->exists = $page->exists;

        if ($this->exists)
            $this->name = 'Edit sitePage';

        return [
            'page' => $page
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
                Input::make('page.page')
                    ->title('Page'),

                Button::make('Save')->method('createOrUpdate')
            ])
        ];
    }

    public function createOrUpdate(SitePage $data, Request $request)
    {
        $validate = $request->validate([
            'page.page' => [
                'required',
                Rule::unique(SitePage::class, 'page')->ignore($data),
            ]
        ]);

        $data->fill($request->get('page'))->save();

        Alert::info('You have successfully created page');

        return redirect()->route('platform.site-pages');
    }

    public function remove(SitePage $data)
    {
        $data->delete();

        Alert::info('You have successfully deleted pages');

        return redirect()->route('platform.site-pages');
    }
}
