<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SiteCollection;
use App\Models\SiteProductSize;
use App\Models\SiteSize;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;

class SiteCollectionProduct extends Model
{
    use AsSource, HasFactory, Filterable, Attachable;

    public $timestamps = false;

    protected $table = 'site_collection_products';

    protected $fillable = [
        'collection', 'name', 'price', 'image', 'description'
    ];

    protected $allowedFilters = [
        'name', 'price', 'collection'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function getCollection()
    {
        return SiteCollection::find($this->collection);
	}

    public function collection()
    {
        return $this->belongsTo(SiteCollection::class, 'id', 'collection');
	}

    public function product_sizes()
    {
        return $this->belongsToMany(SiteSize::class, 'products_sizes', 'product_id', 'size_id');
	}
}
