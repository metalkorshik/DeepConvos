<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class SiteCollectionFeature extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;

    protected $table = 'collection_features';

    protected $fillable = [
        'feature'
    ];

    protected $allowedFilters = [
        'name'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }
}
