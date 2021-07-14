<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class MeetingAttachment extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;

    protected $table = 'meeting_attachments';

    protected $fillable = [
        'meeting_id', 'file'
    ];

    protected $allowedFilters = [
        'file'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function meeting()
    {
        return $this->belongsTo(Meeting::class, 'id', 'meeting_id');
    }
}
