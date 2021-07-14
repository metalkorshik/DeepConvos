<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use Orchid\Attachment\Attachable;

class SiteSize extends Model
{
    use AsSource, HasFactory, Filterable, Attachable;

    public $timestamps = false;
    protected $table = 'site_sizes';

    protected $fillable = [
        'size'
    ];

    protected $allowedFilters = [
        'size'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }
}
