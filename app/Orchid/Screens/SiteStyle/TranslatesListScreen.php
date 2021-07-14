<?php

namespace App\Orchid\Screens\SiteStyle;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\DropDown;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

use Orchid\Screen\TD;
use App\Models\Styles\SiteStyle;
use App\Models\Styles\SiteStyleTranslate;
use App\Models\Features\StyleFeatures;
use Illuminate\Http\Request;

class TranslatesListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'TranslatesListScreen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'TranslatesListScreen';

    /**
     * Current style.
     *
     * @var string|null
     */
    public $currentStyle = null;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(SiteStyle $style): array
    {
        $this->currentStyle = $style;

        return [
            'translates' => $style->translates
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
            Link::make('Back')->route('platform.site-styles'),
            Link::make('Create')->route('platform.site-style-translate', $this->currentStyle->id . '/'),
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
            Layout::table('translates', [
                TD::set('lang')
                    ->filter(TD::FILTER_TEXT)->sort()
                    ->render(function (SiteStyleTranslate $data) {
                        return Link::make($data->translate->lang)
                            ->route('platform.site-style-translate', $this->currentStyle->id . '/' . $data->id);
                    }),
                TD::set('value')->filter(TD::FILTER_TEXT)
                    ->render(function (SiteStyleTranslate $data) {
                        return mb_substr($data->translate->value, 0, 50) . (strlen($data->translate->value) > 50 ? '...' : '');
                    }),
                TD::set(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(function (SiteStyleTranslate $data) {
                        return DropDown::make()
                            ->icon('options-vertical')
                            ->list([

                                Link::make(__('Edit'))
                                    ->route('platform.site-style-translate', $data->id)
                                    ->icon('pencil'),

                                Button::make(__('Delete'))
                                    ->confirm('Are you sure you want to delete the translate?')
                                    ->method('remove')
                                    ->parameters([
                                        'id' => $data->id,
                                        'style_id' => $this->currentStyle->id
                                    ])
                                    ->icon('trash'),
                            ]);
                    }),
            ])
        ];
    }

    public function remove(Request $request)
    {
        StyleFeatures::removeStyleTranslate($request->get('id'));
        Toast::info('Translate was removed');
        return redirect()->route('platform.site-style-translates' ,$request->get('style_id'));
    }
}