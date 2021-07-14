<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class ArtistApply extends Model
{
    use AsSource, HasFactory, Filterable, SoftDeletes;

    public $timestamps = false;

    protected $table = 'artist_apply';

    protected $fillable = [
        'user_info_id', 'user_bank_details_id', 'artist_details_id', 'portfolio'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function user_info()
    {
        return $this->belongsTo(UserInfo::class, 'user_info_id', 'id');
    }

    public function bank_details()
    {
        return $this->belongsTo(BankDetails::class, 'user_bank_details_id', 'id');
    }

    public function artist_details()
    {
        return $this->belongsTo(ArtistDetails::class, 'artist_details_id', 'id');
    }
}
