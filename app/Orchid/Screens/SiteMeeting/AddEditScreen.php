<?php

namespace App\Orchid\Screens\SiteMeeting;

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

use App\Models\Orders\Meeting;
use App\Models\Features\MeetingFeatures;

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

    public $meeting_id = false;
    public $meeting = null;


    /**
     * Query data.
     *
     * @return array
     */
    public function query(Meeting $meeting): array
    {
        $this->exists = $meeting->exists;
        $this->meeting_id = $meeting->id;
        $this->meeting = $meeting;

        if ($this->exists)
            $this->name = 'Edit record';

        return [
            'meeting' => $meeting
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
                // Input::make($this->meeting->customer->user_info()->name . ' ' . $this->meeting->customer->user_info()->surname)
                //     ->title('Customer'),

                // Input::make('meeting.artist.name meeting.artist.surname')
                //     ->title('Artist'),

                DateTimer::make('meeting.deadline_date')
                    ->title('Date')
                    ->enableTime()
                    ->format24hr(),

                Checkbox::make('meeting.is_complete')
                    ->title('Is Complete')
                    ->sendTrueOrFalse(),

                Button::make('Save')->method('createOrUpdate')->parameters([ 'is_edit' => $this->exists, 'meeting_id' => $this->meeting_id ])
            ])
        ];
    }

    public function createOrUpdate(Request $request)
    {
        $result = $request->get('meeting');
        $meeting_id = $request->get('meeting_id');

        $validate = $request->validate([
            'meeting.deadline_date' => 'required',
        ]);

        $meeting = MeetingFeatures::getMeeting($meeting_id);
        $meeting->fill($result)->save();

        Alert::info('You have successfully edited meeting');

        return redirect()->route('platform.site-meetings');
    }
}
