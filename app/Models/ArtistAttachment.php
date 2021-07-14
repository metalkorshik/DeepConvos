<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use App\Models\ArtistDetails;

class ArtistAttachment extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;

    protected $table = 'artist_attachments';

    protected $fillable = [
        'artist_details_id', 'file', 'type'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function artist_details()
    {
        return $this->belongsTo(ArtistDetails::class, 'artist_details_id', 'id');
    }
}
