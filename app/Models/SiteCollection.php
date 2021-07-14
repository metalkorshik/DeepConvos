<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class SiteCollection extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;

    protected $table = 'site_collections';

    protected $fillable = [
        'name', 'description'
    ];

    protected $allowedFilters = [
        'name', 'description'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function products()
    {
        return $this->hasMany(SiteCollectionProduct::class, 'collection', 'id');
    }
}
