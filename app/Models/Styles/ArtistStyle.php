<?php

namespace App\Models\Styles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use App\Models\ArtistDetails;

class ArtistStyle extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;

    protected $table = 'artist_styles';

    protected $fillable = [
        'artist_details_id', 'style_id'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function artist_details()
    {
        return $this->belongsTo(ArtistDetails::class, 'artist_details_id', 'id');
    }

    public function style()
    {
        return $this->belongsTo(SiteStyle::class, 'style_id', 'id');
    }
}
