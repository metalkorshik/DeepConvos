<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class SitePage extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;

    protected $table = 'site_pages';
    protected $primaryKey = 'page';
    public $incrementing = false;

    protected $fillable = [
        'page'
    ];

    protected $allowedFilters = [
        'page'
    ];

    public function getRouteKeyName()
    {
        return 'page';
    }

    public function translates()
    {
        return $this->hasMany(Translate::class, 'page', 'page');
    }
}
