<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class Sketch extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;

    protected $table = 'sketches';

    protected $fillable = [
        'order_id', 'title', 'comment', 'is_complete', 'is_primary', 'is_alerted', 'deadline_date', 'sended_date', 'status_id'
    ];

    protected $allowedFilters = [
        'deadline_date'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function sketch_attachments()
    {
        return $this->hasMany(SketchAttachment::class, 'sketch_id', 'id');
    }

    public function revision()
    {
        $revisions = $this->hasMany(SketchRevision::class, 'sketch_id', 'id');
        return $revisions->first();
    }
}
