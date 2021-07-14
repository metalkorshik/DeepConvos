<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class Mailing extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;
    protected $table = 'mailing';

    protected $fillable = [
        'email'
    ];

    protected $allowedFilters = [
        'email'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }
}
