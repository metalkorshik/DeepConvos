<?php

namespace App\Orchid\Screens\Mailing;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\DropDown;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Actions\ModalToggle;

use Orchid\Screen\TD;
use App\Models\Mailing;
use Illuminate\Http\Request;
use App\Models\MailManager;
use App\Models\Features\TranslateFeatures;

class ListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'ListScreen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'ListScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'emails' => Mailing::filters()->paginate()
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
            ModalToggle::make('Send')
                ->modal('mailingModal')
                ->modalTitle('Letter details')
                ->method('send')
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

            Layout::modal('mailingModal', [

                Layout::rows([

                    Input::make('letter_header')
                        ->title('Header'),

                    Input::make('letter_body')
                        ->title('Body'),

                ]),

            ])->ApplyButton('Send')->withoutCloseButton(),

            Layout::table('emails', [
                TD::set('email'),
            ])

        ];
    }

    public function send(Request $request)
    {
        $emails = Mailing::filters()->paginate();

        foreach ($emails as $email) 
            MailManager::sendEmail($email->email, $request->get('letter_header'), 
                $request->get('letter_body') . ' ' . TranslateFeatures::getTranslate('unsubscribe_mailing', 'Mail') . ':' . 
                url('/unsubscribe-from-news') . '/' . $email->id);
       
        Toast::info('The letters have been sent');
    }
}
