<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use App\Models\Styles\ArtistStyle;
use App\Models\ArtistAttachment;

class ArtistDetails extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;

    protected $table = 'artist_details';

    protected $fillable = [
        'birthdate', 'education', 'additional_education', 'participation', 'style_info', 'technique', 'about', 'user_id'
    ];

    protected $allowedFilters = [
        'birthdate', 'style_info'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function styles()
    {
        return $this->hasMany(ArtistStyle::class, 'artist_details_id', 'id');
    }

    public function participations()
    {
        return $this->hasMany(ArtistAttachment::class, 'artist_details_id', 'id')->where('type', 'participation');
    }

    public function portfolios()
    {
        return $this->hasMany(ArtistAttachment::class, 'artist_details_id', 'id')->where('type', 'portfolio');
    }
}
