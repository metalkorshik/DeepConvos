<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class FavoriteArtist extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;

    protected $table = 'favorite_artists';

    protected $fillable = [
        'customer_id', 'artist_id'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'id', 'customer_id');
    }

    public function artist()
    {
        return $this->belongsTo(User::class, 'id', 'artist_id');
    }
}
