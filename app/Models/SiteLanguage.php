<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class SiteLanguage extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;

    protected $table = 'site_languages';
    protected $primaryKey = 'lang';
    public $incrementing = false;

    protected $fillable = [
        'lang', 'code'
    ];

    protected $allowedFilters = [
        'lang', 'code'
    ];

    public function getRouteKeyName()
    {
        return 'lang';
    }
}
