<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SiteSize;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class SiteProductSize extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;
    protected $table = 'products_sizes';
    public $incrementing = false;

    protected $fillable = [
        'product_id', 'size_id'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function size()
    {
        return $this->belongsTo(SiteSize::class, 'id', 'size_id');
	}
}
