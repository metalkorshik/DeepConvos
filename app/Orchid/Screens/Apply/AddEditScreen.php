<?php

namespace App\Orchid\Screens\Apply;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Group;

use App\Models\ArtistApply;
use App\Models\UserInfo;
use App\Models\BankDetails;
use App\Models\ArtistDetails;
use App\Models\Features\UserFeatures;

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
     * current apply variable.
     *
     * @var string|null
     */
    public $current_apply = null;

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(ArtistApply $apply): array
    {
        $this->exists = $apply->exists;

        if ($this->exists)
        {
            $this->current_apply = $apply;
            $this->name = 'Edit record';
        }

        return [
            'apply' => $apply
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
                Relation::make('apply.user_info')
                    ->title('Name')
                    ->fromModel(UserInfo::class, 'name'),

                Relation::make('apply.user_info')
                    ->title('Surname')
                    ->fromModel(UserInfo::class, 'surname'),

                Relation::make('apply.user_info')
                    ->title('Email')
                    ->fromModel(UserInfo::class, 'email'),

                Relation::make('apply.artist_details')
                    ->title('Birthdate')
                    ->fromModel(UserInfo::class, 'birthdate'),

                Relation::make('apply.user_info')
                    ->title('Phone')
                    ->fromModel(UserInfo::class, 'phone'),

                Relation::make('apply.user_info')
                    ->title('Country')
                    ->fromModel(UserInfo::class, 'country'),

                Relation::make('apply.user_info')
                    ->title('City')
                    ->fromModel(UserInfo::class, 'city'),

                Relation::make('apply.bank_details')
                    ->title('Card number')
                    ->fromModel(BankDetails::class, 'card_number'),

                Relation::make('apply.bank_details')
                    ->title('Card owner')
                    ->fromModel(BankDetails::class, 'card_owner'),

                Relation::make('apply.bank_details')
                    ->title('Card validity')
                    ->fromModel(BankDetails::class, 'card_validity'),

                Link::make('Portfolio')
                    ->href(url('/') . $this->current_apply->portfolio),

                Group::make([
                    Button::make('Accept')->method('createOrUpdate'),
                    Button::make('Deny')->method('denyApply')
                ])->autoWidth()
            ])
        ];
    }

    public function createOrUpdate(ArtistApply $apply, Request $request)
    {
        UserFeatures::acceptApply($apply->id);
        Alert::info('You accepted the apply');
        return redirect()->route('platform.applies');
    }

    public function denyApply(ArtistApply $apply, Request $request)
    {
        UserFeatures::denyApply($apply->id);
        Alert::info('You denied the apply');
        return redirect()->route('platform.applies');
    }

    // header("location:Delivery_form.php?cnno=$cnno&copies='$nocopy'");
}
