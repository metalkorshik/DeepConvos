<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class ArtistReward extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;

    protected $table = 'artist_rewards';

    protected $fillable = [
        'order_id', 'status_id', 'amount'
    ];

    protected $allowedFilters = [
        'amount'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(ArtistRewardStatus::class, 'status_id', 'id');
    }
}
