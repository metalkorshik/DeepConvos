<?php

namespace App\Models\Features;
use App\Models\SiteCollection;
use App\Models\SiteCollectionProduct;
use App\Models\SiteCollectionVideo;
use App\Models\SiteCollectionFeature;
use App\Helper\FeaturesHelper;

class CollectionFeatures
{
    public static $count = 8;

    public static function init() {
        self::$count = SiteCollectionFeature::where('key', 'pagination_count')->first()->feature;
    }

    public static function getCollections($offset = 0, $all_products = false)
    {
        $results = SiteCollection::all();
        $collections = [];

        foreach ($results as $result) {

            $products = self::getProducts($result->id, $offset, $all_products);
            $collection = [];
            $collection['id'] = $result->id;
            $collection['name'] = $result->name;
            $collection['description'] = $result->description;
            $collection['products'] = $products;
            $collection['pages_count'] = ceil($result->products->count() / count($products));
            $collections[] = $collection;

        }

        return $collections;
    }

    public static function getProducts($collection_id, $offset = 0, $all_products = false)
    {
        $collection = SiteCollection::findOrFail($collection_id);
        $items = $all_products ? $collection->products : $collection->products->skip($offset)->take(self::$count);
        $products = [];

        foreach ($items as $item) {

            $product = [];
            $product['id'] = $item->id;
            $product['name'] = $item->name;
            $product['price'] = $item->price;
            $product['image'] = $item->image;
            $products[] = $product;

        }

        return $products;
    }

    public static function getVideos()
    {
        $results = SiteCollectionVideo::all();
        $videos = [];

        foreach ($results as $result) 
            $videos[] = $result->video;

        return $videos;
    }

    public static function getFeatures()
    {
        $results = SiteCollectionFeature::all();
        $features = [];

        foreach ($results as $result) 
        {
            if($result->key == 'release_date')
            {
                $date_arr = FeaturesHelper::getTimeRemains($result->feature);
                $features[$result->key] = [ 'days' => $date_arr['days'], 'hours' => $date_arr['hours'], 'minutes' => $date_arr['minutes'] ];
            }
            else
                $features[$result->key] = $result->feature;
        }

        return $features;
    }
}

CollectionFeatures::init();