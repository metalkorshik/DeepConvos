<?php

namespace App\Helper;
use App\Models\SiteFeature;

class FeaturesHelper
{
    public static function getDate($date, $type_format = '')
    {
        $result = $date;
        $format = '';

        if($type_format == 'full')
            $format = config('format.full_date');
        else if($type_format == 'long')
            $format = config('format.long_date');
        else if($type_format == 'sql')
            $format = config('format.sql_date');
        else
            $format = config('format.date');

        if(is_int($date))
            $result = date($format, $date);

        if(is_string($date))
            $result = date($format, strtotime($date));

        if(is_object($date) && method_exists('format'))
            $result = $date->format($format);

        return $result;
    }

    public static function getSeparateDate($date, $type_format = '')
    {
        $date_part = '';
        $time_part = '';
        $date_format = '';
        $time_format = '';

        if($type_format == 'full')
        {
            $date_format = config('format.first_part_full_date');
            $time_format = config('format.second_part_full_date');
        }
        else if($type_format == 'long')
        {
            $date_format = config('format.first_part_long_date');
            $time_format = config('format.second_part_long_date');
        }
        else if($type_format == 'sql')
        {
            $date_format = config('format.first_part_sql_date');
            $time_format = config('format.second_part_sql_date');
        }
        else
            $date_format = config('format.date');

        if(is_int($date))
        {
            $date_part = date($date_format, $date);
            $time_part = date($time_format, $date);
        }

        if(is_string($date))
        {
            $date_part = date($date_format, strtotime($date));
            $time_part = date($time_format, strtotime($date));
        }

        if(is_object($date) && method_exists('format'))
        {
            $date_part = $date->format($date_format);
            $time_part = $date->format($time_format);
        }

        $result = ['date' => $date_part, 'time' => $time_part];

        return $result;
    }

    public static function modifyDate($date, $modifier, $type_format = '')
    {
        $date = date('d.m.Y H:i:s', strtotime($date . $modifier));
        $date = self::getDate($date, $type_format);
        return $date;
    }

    public static function getSketchDeadlineDate($type_format = 'sql')
    {
        $date = FeaturesHelper::modifyDate(date('d.m.Y H:i:s'), '+2days', $type_format);
        return $date;
    }

    public static function getTimeRemains($date, $type_format = '')
    {
        $date = self::getDate($date, $type_format);

        $seconds = strtotime($date) - time();
        $days = floor($seconds / 86400);
        $seconds %= 86400;

        $hours = floor($seconds / 3600);
        $seconds %= 3600;

        $minutes = floor($seconds / 60);
        $seconds %= 60;

        $days = ($days <= 0 ? 0 : $days);
        $hours = ($hours <= 0 ? 0 : ($hours < 10 ? '0' . $hours : $hours));
        $minutes = ($minutes <= 0 ? 0 : ($minutes < 10 ? '0' . $minutes : $minutes));

        $result = [ 'days' => $days, 'hours' => $hours, 'minutes' => $minutes ];

        return $result;
    }

    public static function getHoursRemains($date, $type_format = '')
    {
        $date = self::getDate($date, $type_format);
        $hours = (strtotime($date) - time()) / 3600;

        return $hours;
    }

    public static function uploadFiles($files, $folder = 'attachments')
    {
        $results = [];

        if($files)
        {
            foreach ($files as $file) {
                $result = $file->storeAs("public/$folder", $file->getClientOriginalName());
                $result = self::getUrlFromPath($result);
                $results[] = $result;
            }
        }

        return $results;
    }

    public static function getPathFromUrl($url)
    {
        return public_path() . $url;
    }

    public static function getUrlFromPath($path)
    {
        $arr = explode('/storage/', $path);

        if(count($arr) <= 1)
            $arr = explode('public/', $path);

        return '/storage/' . $arr[1];
    }

    public static function getUniqueFileName($folder, $prefix = 'files', $extention = null)
    {
        $file_name = '';

        while(true)
        {
            $name = time();

            if(!file_exists($folder . '/' . $name))
            {
                
                $file_name = $prefix . '_' . $name . $extention ?? '';
                break;
            }
        }

        return $file_name;
    }

    public static function getSiteFeature($feature)
    {
        return SiteFeature::where('key', $feature)->first()->feature;
    }
}