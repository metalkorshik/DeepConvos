<?php

namespace App\Orchid\Screens\SiteOrder;

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
use Orchid\Screen\Fields\Group;

use App\Models\Orders\Order;
use App\Models\Orders\OrderStatus;
use App\Models\Orders\ReturnedFunds;
use App\Models\Features\SketchFeatures;

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

    public $order_id = false;
    public $order = null;


    /**
     * Query data.
     *
     * @return array
     */
    public function query(Order $order): array
    {
        $this->exists = $order->exists;
        $this->order_id = $order->id;
        $this->customer_id = $order->meeting->customer->id;
        $this->order = $order;

        if ($this->exists)
            $this->name = 'Edit record';

        return [
            'order' => $order
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

                Input::make('order.title')
                    ->title('Title'),

                Input::make('order.description')
                    ->title('Description'),

                Input::make('order.technique')
                    ->title('Technique'),

                Input::make('order.amount')
                    ->title('Amount'),

                Checkbox::make('order.is_male_clothes')
                    ->title('Clothes for male')
                    ->sendTrueOrFalse(),

                Relation::make('order.status_id')
                    ->title('Status')
                    ->fromModel(OrderStatus::class, 'status'),

                Group::make([
                    Button::make('Save')->method('createOrUpdate')->parameters([ 'is_edit' => $this->exists, 'order_id' => $this->order_id ]),
                    Button::make('Return funds')->method('returnFunds')->parameters([ 'order_id' => $this->order_id, 'customer_id' => $this->customer_id ])
                ])->autoWidth()
            ])
        ];
    }

    public function createOrUpdate(Request $request)
    {
        $result = $request->get('order');
        $order_id = $request->get('order_id');

        $validate = $request->validate([
            'order.title' => 'required',
            'order.description' => 'required',
            'order.technique' => 'required',
            'order.amount' => 'required',
            'order.is_male_clothes' => 'required',
        ]);

        $order = SketchFeatures::getOrder($order_id);
        $order->fill($result)->save();

        Alert::info('You have successfully edited order');

        return redirect()->route('platform.site-orders');
    }

    public function returnFunds(Request $request)
    {
        $result = $request->get('order');

        ReturnedFunds::create([
            'order_id' => $request->order_id,
            'customer_id' => $request->customer_id,
            'amount' => $result['amount'],
        ]);

        return redirect()->route('platform.site-orders');
    }
}
