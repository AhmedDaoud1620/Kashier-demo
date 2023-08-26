<?php

namespace App\Http\Helpers;



class Hashing
{


   public static function generateKashierOrderHash($order){
        $mid = env('KASHIER_MERCHANT_ID');
        $amount = $order->total;
        $currency = $order->currency;
        $orderId = $order->id;
        $secret = env('KASHIER_SECRET_KEY');

        $path = "/?payment=".$mid.".".$orderId.".".$amount.".".$currency;
        $hash = hash_hmac( 'sha256' , $path , $secret ,false);
        return $hash;
    }

}
