<?php

namespace App\Models;

use Orchid\Platform\Models\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'permissions',
        'surname',
        'phone',
        'country',
        'city',
        'is_artist',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'permissions',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'permissions'          => 'array',
        'email_verified_at'    => 'datetime',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'name',
        'email',
        'permissions',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'email',
        'updated_at',
        'created_at',
    ];

    public function user_info()
    {
        return $this->hasMany(UserInfo::class, 'user_id', 'id')->first();
	}

    public function bank_details()
    {
        return $this->hasMany(BankDetails::class, 'user_id', 'id')->first();
	}

    public function artist_details()
    {
        return $this->hasMany(ArtistDetails::class, 'user_id', 'id')->first();
	}

    public function favorite_artists()
    {
        return $this->hasMany(FavoriteArtist::class, 'customer_id', 'id');
	}
}
