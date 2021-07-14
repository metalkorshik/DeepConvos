<?php

namespace App\Models\Features;
use Illuminate\Support\Facades\Storage;
use App\Models\ArtistApply;
use App\Models\ArtistDetails;
use App\Models\BankDetails;
use App\Models\UserInfo;
use App\Models\User;
use App\Models\MailManager;
use App\Models\SiteCollectionOrder;
use Illuminate\Support\Facades\Hash;
use App\Models\SiteCollectionProduct;

class OrderFeatures
{
    public static function getProductInfo($id)
    {
        $product = SiteCollectionProduct::findOrFail($id);

        $result = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->image,
            'collection' => $product->getCollection()->name,
        ];

        return $result;
    }

    public static function createOrder($product_id, $amount, $address)
    {
        SiteCollectionOrder::create([
            'product_id' => $product_id,
            'amount' => $amount,
            'address' => $address
        ]);
    }
}
