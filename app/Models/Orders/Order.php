<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class Order extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;

    protected $table = 'orders';

    protected $fillable = [
        'meeting_id', 'title', 'description', 'technique', 'amount', 'is_male_clothes', 'status_id'
    ];

    protected $allowedFilters = [
        'title', 'technique', 'amount'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function meeting()
    {
        return $this->belongsTo(Meeting::class, 'meeting_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'meeting_id', 'id');
    }

    public function primarySketch()
    {
        return $this->hasMany(Sketch::class, 'order_id', 'id')->where('is_primary', 1)->first();
    }

    public function sketches()
    {
        return $this->hasMany(Sketch::class, 'order_id', 'id')->where('is_primary', 0);
    }
    
    public function denied_order()
    {
        return $this->hasMany(DeniedOrder::class, 'order_id', 'id')->first();
    }
}
