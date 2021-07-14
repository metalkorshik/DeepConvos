<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class SiteCollectionVideo extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;

	protected $table = 'site_collection_videos';

    protected $fillable = [
        'video'
    ];

    protected $allowedFilters = [
        'video'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }
}
