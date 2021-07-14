<?php

namespace App\Models\Features;
use App\Models\Styles\SiteStyle;
use App\Models\Styles\SiteStyleTranslate;
use App\Models\SiteLanguage;
use App\Models\SitePage;
use App\Models\SiteTranslate;
use Illuminate\Support\Facades\Session;
use App;

class TranslateFeatures
{
    private static function getFileTranslates()
    {
        $locale = Session::get('locale') ?? 'en';
        $file = resource_path('lang');
        $path = $file . "/{$locale}/main.php";
        $results = include($path);

        return $results;
    }

    public static function getTranslate($needle_key, $needle_page = 'General')
    {
        $results = self::getFileTranslates();
        $translate = '';

        foreach ($results as $key => $value) {

            $arr = explode('.', $key);
            $page = $arr[0];
            $keyword = $arr[1];

            if($page == $needle_page && $keyword == $needle_key)
            {
                $translate = $value;
                break;
            }

        }

        return $translate;
    }

    public static function getTranslates($needle_page, $is_specific = false)
    {
        $results = self::getFileTranslates();
        $translates = [];

        foreach ($results as $key => $value) {

            $arr = explode('.', $key);
            $page = $arr[0];
            $keyword = $arr[1];

            if((($page == 'Header' || $page == 'Footer' || $page == 'General') && !$is_specific) || $page == $needle_page)
                $translates[$keyword] = $value;

        }

        return $translates;
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
    }

    public static function removeStyleTranslate($id)
    {
        SiteStyleTranslate::findOrFail($id)->delete();
        SiteTranslate::findOrFail($id)->delete();
    }

    private static function createLangFile()
    {
        $path = resource_path('lang/main');
        if (!file_exists($path))
            mkdir($path);

        $file = $path . '/main.php';

        if (!file_exists($file))
            file_put_contents($file, '');

        return $file;
    }

    public static function syncTranslates()
    {
        $result = [];
        foreach (SiteTranslate::all() as $translate)
        {
            $key = strtolower($translate->langr()->first()->code);
            $result[$key]["{$translate->page}.{$translate->key}"] = $translate->value;
        }

        $file = resource_path('lang');
        foreach ($result as $lang => $translate)
        {
            $path = $file . "/{$lang}/main.php";
            if (!file_exists($path))
                file_put_contents($path, '');
            file_put_contents($path, "<?php\n\nreturn " . var_export($result[$lang], true) . ';');
        }
    }

    public static function syncOneTranslate($id)
    {
        $translate = SiteTranslate::findOrFail($id);

        $lang = strtolower($translate->langr()->first()->code);
        $file = resource_path('lang') . "/{$lang}/main.php";
        if (!file_exists($file))
            file_put_contents($file, '');
        $data = include($file);

        $data["{$translate->page}.{$translate->key}"] = $translate->value;

        file_put_contents($file, "<?php\n\nreturn " . var_export($data, true) . ';');
    }
}
