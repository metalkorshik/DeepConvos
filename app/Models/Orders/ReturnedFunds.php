<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use App\Models\User;

class ReturnedFunds extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;

    protected $table = 'returned_funds';

    protected $fillable = [
        'order_id', 'customer_id', 'amount', 'date'
    ];

    protected $allowedFilters = [
        'amount'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }
}
