<?php

namespace App\Orchid\Screens\SiteSize;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Relation;

use App\Models\SiteSize;

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
    public function query(SiteSize $size): array
    {
        $this->exists = $size->exists;

        if ($this->exists)
            $this->name = 'Edit';

        return [
            'size' => $size
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
                Input::make('size.size')
                    ->title('Size'),

                Button::make('Save')->method('createOrUpdate')
            ])
        ];
    }

    public function createOrUpdate(SiteSize $data, Request $request)
    {
        $validate = $request->validate([
            'size.size' => [
                'required',
                Rule::unique(SiteSize::class, 'size')->ignore($data),
            ],
        ]);

        $data->fill($request->get('size'))->save();

        Alert::info('You have successfully created size');

        return redirect()->route('platform.site-sizes');
    }
}
