<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class SketchStatus extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;

    protected $table = 'sketch_statuses';

    protected $fillable = [
        'status'
    ];

    protected $allowedFilters = [
        'status'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }
}
