<?php

namespace App\Orchid\Screens\ArtistReward;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Picture;

use App\Models\Orders\ArtistReward;
use App\Models\Orders\ArtistRewardStatus;

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
    public function query(ArtistReward $reward): array
    {
        $this->exists = $reward->exists;

        if ($this->exists)
        {
            $this->name = 'Edit record';
        }

        return [
            'reward' => $reward
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

                Input::make('reward.amount')
                    ->title('amount')
                    ->type('number'),

                Relation::make('reward.status_id')
                    ->title('Status')
                    ->fromModel(ArtistRewardStatus::class, 'status'),

                Button::make('Save')->method('createOrUpdate')
            ])
        ];
    }

    public function createOrUpdate(ArtistReward $reward, Request $request)
    {
        $validate = $request->validate([
            'reward.amount' => 'required',
        ]);

        $data = $request->get('reward');
        $reward->fill($data)->save();

        Alert::info('You have successfully edited reward');

        return redirect()->route('platform.artist-rewards');
    }
}
