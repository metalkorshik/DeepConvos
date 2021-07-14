<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class UserInfo extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;

    protected $table = 'users_info';

    protected $fillable = [
        'name', 'surname', 'email', 'phone', 'country', 'city', 'is_artist', 'user_id'
    ];

    protected $allowedFilters = [
        'name', 'surname', 'phone', 'country', 'city', 'is_artist'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
