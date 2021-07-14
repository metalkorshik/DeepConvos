<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SiteCollectionProduct;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;

class SiteCollectionOrder extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;

    protected $table = 'site_collection_orders';

    protected $fillable = [
        'product_id', 'amount', 'address', 'date'
    ];

    protected $allowedFilters = [
        'amount', 'address', 'date'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function product()
    {
        return $this->belongsTo(SiteCollectionProduct::class, 'product_id', 'id');
	}
}