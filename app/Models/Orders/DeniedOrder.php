<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class DeniedOrder extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;

    protected $table = 'denied_orders';

    protected $fillable = [
        'order_id', 'reason_id', 'comment'
    ];

    protected $allowedFilters = [
        'comment'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'id', 'order_id');
    }

    public function reason()
    {
        return $this->belongsTo(DeniedOrderReason::class, 'id', 'reason_id');
    }
}
