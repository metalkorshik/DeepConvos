<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Features\UserFeatures;
use App\Models\Features\OrderFeatures;
use App\Models\Features\TranslateFeatures;
use App\Models\MailManager;

use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function success()
    {
        $user_info = UserFeatures::getUserInfo(Auth::id());
        return $this->handleView('order_payment_success', [ 'user_info' => $user_info ]);
    }

    public function checkoutSuccess(Request $request)
    {
        $user_info = UserFeatures::getUserInfo(Auth::id());
        $product_info = OrderFeatures::getProductInfo($request->product_id);
        OrderFeatures::createOrder($request->product_id, $product_info['price'], $request->delivery_address);
        
        MailManager::sendEmail($user_info['email'], TranslateFeatures::getTranslate('order', 'Mail'), 
            TranslateFeatures::getTranslate('you_successfully_ordered', 'Mail') . " {$product_info['name']} " . 
            TranslateFeatures::getTranslate('for', 'Mail') . " {$product_info['price']} €." .  
            TranslateFeatures::getTranslate('delivery_address', 'Mail') . ": {$request->delivery_address}." . TranslateFeatures::getTranslate('thank_you_for_order', 'Mail'));

        return redirect('/');
    }

    public function checkout($product_id)
    {
        if(!Auth::check() || Auth::id() == 1)
            return redirect('/login');

        $user_info = UserFeatures::getUserInfo(Auth::id());
        $product_info = OrderFeatures::getProductInfo($product_id);
        $action = '/checkout-success';
        $amount = $product_info['price'];

        return $this->handleView('checkout', [ 'user_info' => $user_info, 'product_info' => $product_info, 
            'action' => $action, 'amount' => $amount ]);
    }

    public function reviewSuccess()
    {
        $user_info = UserFeatures::getUserInfo(Auth::id());
        return $this->handleView('review_success', [ 'user_info' => $user_info ]);
    }
}
