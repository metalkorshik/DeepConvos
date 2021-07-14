<?php

namespace App\Http\Controllers;
use App\Models\Features\CollectionFeatures;

use Illuminate\Http\Request;

class CollectionsController extends Controller
{
    public function index()
    {
        $collections = CollectionFeatures::getCollections();
        $videos = CollectionFeatures::getVideos();
        $features = CollectionFeatures::getFeatures();

        return $this->handleView('collections', [ 'collections' => $collections, 'videos' => $videos, 'features' => $features ]);
    }

    public function getProducts(Request $request)
    {
        $products = CollectionFeatures::getProducts($request->collection_id, $request->offset);
        return response()->json($products);
    }
}
