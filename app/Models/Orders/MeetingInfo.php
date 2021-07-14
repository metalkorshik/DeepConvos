<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class MeetingInfo extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;

    protected $table = 'meeting_info';

    protected $fillable = [
        'meeting_id', 'title', 'description', 'is_male_clothes', 'send_sketches_before'
    ];

    protected $allowedFilters = [
        'title', 'description'
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
