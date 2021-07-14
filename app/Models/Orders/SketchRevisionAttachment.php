<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class SketchRevisionAttachment extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;

    protected $table = 'sketch_revision_attachments';

    protected $fillable = [
        'revision_id', 'file'
    ];

    protected $allowedFilters = [
        'file'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function revision()
    {
        return $this->belongsTo(SketchRevision::class, 'id', 'revision_id');
    }
}
