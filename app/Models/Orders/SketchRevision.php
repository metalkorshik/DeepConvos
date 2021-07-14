<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class SketchRevision extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;

    protected $table = 'sketch_revisions';

    protected $fillable = [
        'sketch_id', 'comment'
    ];

    protected $allowedFilters = [
        'comment'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function sketch()
    {
        return $this->belongsTo(Sketch::class, 'id', 'sketch_id');
    }

    public function attachments()
    {
        return $this->hasMany(SketchRevisionAttachment::class, 'revision_id', 'id');
    }
}
