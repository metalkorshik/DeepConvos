<?php

namespace App\Models\Styles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use App\Models\SiteTranslate;

class SiteStyleTranslate extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;

	protected $table = 'styles_translates';

    protected $fillable = [
        'translate_id', 'style_id'
    ];

    public function style()
    {
        return $this->belongsTo(SiteStyle::class, 'style_id', 'id');
	}

    public function translate()
    {
        return $this->belongsTo(SiteTranslate::class, 'translate_id', 'id');
	}
}
