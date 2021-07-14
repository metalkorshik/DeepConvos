<?php

namespace App\Models\Features;
use App\Models\Styles\ArtistStyle;
use App\Models\Styles\SiteStyle;
use App\Models\Styles\SiteStyleTranslate;
use App\Models\ArtistDetails;
use App\Models\SiteLanguage;
use App\Models\SitePage;
use App\Models\SiteTranslate;
use App\Models\Features\TranslateFeatures;
use Illuminate\Support\Facades\Session;

class StyleFeatures
{
    public static function getStyles()
    {
        $locale = Session::get('locale') ?? 'en';
        $results = SiteStyle::all();
        $styles = [];

        foreach ($results as $result) 
            $styles[$result->id] = $result->getTranslate($locale);

        return $styles;
    }

    public static function getArtistStyles($artist_details_id)
    {
        $locale = Session::get('locale') ?? 'en';
        $results = ArtistDetails::findOrFail($artist_details_id)->styles;
        $styles = [];

        foreach ($results as $result) 
            $styles[$result->style->id] = $result->style->getTranslate($locale);

        return $styles;
    }

    public static function updateArtistStyles($artist_details_id, $styles)
    {
        ArtistStyle::whereIn('style_id', $styles)->delete();

        foreach ($styles as $style) {

            ArtistStyle::create([
                'style_id' => $style,
                'artist_details_id' => $artist_details_id
            ]);

        }
    }

    public static function addStyleTranslate($style_id, $lang, $value)
    {
        $style = SiteStyle::findOrFail($style_id);

        $translate = SiteTranslate::create([
            'page' => 'Styles',
            'lang' => $lang,
            'key' => $style->key,
            'value' => $value,
            'is_specific' => true
        ]);

        SiteStyleTranslate::create([
            'translate_id' => $translate->id,
            'style_id' => $style_id,
        ]);

        TranslateFeatures::syncOneTranslate($translate->id);
    }

    public static function editStyleTranslate($translate_id, $lang, $value)
    {
        $translate = SiteStyleTranslate::findOrFail($translate_id)->translate;
        $translate->lang = $lang;
        $translate->value = $value;
        $translate->save();

        TranslateFeatures::syncOneTranslate($translate->id);
    }

    public static function removeStyleTranslate($id)
    {
        $translate = SiteStyleTranslate::findOrFail($id);
        $translate_id = $translate->translate->id;

        $translate->delete();
        SiteTranslate::findOrFail($translate_id)->delete();

        TranslateFeatures::syncTranslates();
    }

    public static function editStyle($id, $key)
    {
        $style = SiteStyle::findOrFail($id);
        $style->key = $key;
        $style->save();

        foreach ($style->translates as $translate) {
            $current_translate = $translate->translate;
            $current_translate->key = $key;
            $current_translate->save();
        }

        TranslateFeatures::syncTranslates();
    }

    public static function removeStyle($id)
    {
        $style = SiteStyle::findOrFail($id);

        foreach ($style->translates as $translate) 
            self::removeStyleTranslate($translate->id);

        $style->delete();

        TranslateFeatures::syncTranslates();
    }
}