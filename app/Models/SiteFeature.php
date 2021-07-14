<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class SiteFeature extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;

    protected $table = 'site_features';

    protected $fillable = [
        'key', 'name', 'feature'
    ];

    protected $allowedFilters = [
        'name'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }
}
