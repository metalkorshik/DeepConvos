<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class DeniedOrderReason extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;

    protected $table = 'denied_order_reasons';

    protected $fillable = [
        'reason'
    ];

    protected $allowedFilters = [
        'reason'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }
}
