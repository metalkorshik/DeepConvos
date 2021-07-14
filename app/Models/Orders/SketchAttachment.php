<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class SketchAttachment extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;

    protected $table = 'sketch_attachments';

    protected $fillable = [
        'sketch_id', 'file'
    ];

    protected $allowedFilters = [
        'file'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function sketch()
    {
        return $this->belongsTo(Sketch::class, 'id', 'sketch_id');
    }
}
