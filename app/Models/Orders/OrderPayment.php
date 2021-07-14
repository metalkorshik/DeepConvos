<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class OrderPayment extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;

    protected $table = 'order_payments';

    protected $fillable = [
        'order_id', 'amount', 'date'
    ];

    protected $allowedFilters = [
        'amount', 'date'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'id', 'order_id');
    }
}
