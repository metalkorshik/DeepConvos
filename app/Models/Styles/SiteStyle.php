<?php

namespace App\Models\Styles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class SiteStyle extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;

    protected $table = 'styles';

    protected $fillable = [
        'key'
    ];

    protected $allowedFilters = [
        'key'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function translates()
    {
        return $this->hasMany(SiteStyleTranslate::class, 'style_id', 'id');
    }

    public function getTranslate($lang)
    {
        $lang = strtoupper($lang);
        $result = null;

        foreach ($this->translates as $translate) {

            if($translate->translate->langr->code == $lang)
                $result = $translate->translate->value;

        }

        return $result;
    }
}
