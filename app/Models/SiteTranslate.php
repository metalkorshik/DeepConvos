<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class SiteTranslate extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;

	protected $table = 'site_translates';

    protected $fillable = [
        'page', 'lang', 'key', 'value'
    ];

    protected $allowedFilters = [
        'page', 'lang', 'key', 'value'
    ];

    public function page()
    {
        return $this->belongsTo(SitePage::class);
	}

	public function langr()
    {
        return $this->belongsTo(SiteLanguage::class, 'lang', 'lang');
    }
}
