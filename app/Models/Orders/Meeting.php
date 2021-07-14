<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class Meeting extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;

    protected $table = 'meetings';

    protected $fillable = [
        'customer_id', 'artist_id', 'deadline_date', 'link', 'is_complete', 'is_alerted'
    ];

    protected $allowedFilters = [
        'deadline_date'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id', 'id');
    }

    public function meeting_info()
    {
        return $this->hasMany(MeetingInfo::class, 'meeting_id', 'id')->first();
    }

    public function meeting_payments()
    {
        return $this->hasMany(MeetingPayment::class, 'meeting_id', 'id');
    }

    public function meeting_attachments()
    {
        return $this->hasMany(MeetingAttachment::class, 'meeting_id', 'id');
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'meeting_id', 'id')->first();
    }
}
