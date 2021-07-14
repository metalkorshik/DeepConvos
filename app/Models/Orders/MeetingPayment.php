<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class MeetingPayment extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;

    protected $table = 'meeting_payments';

    protected $fillable = [
        'meeting_id', 'amount', 'date'
    ];

    protected $allowedFilters = [
        'amount', 'date'
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
