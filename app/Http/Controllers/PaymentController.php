<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Hashing;
use App\Http\Helpers\VerifySignature;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function index()
    {
        $orderId = Session::get('orderId');
        $order= Order::where('id', $orderId)->first();
        $orderHash= Hashing::generateKashierOrderHash($order);

        return view('payment',['orderAmount'=> $order->total,'orderHash'=> $orderHash,'orderCurrency'=> $order->currency,'orderId'=> $order->order_merchant_id,'orderPaymentMethod'=> $order->payment_method, 'inviceId'=> $order->payment->invoice_kash_id]);
    }

    public function paymentSuccess()
    {
        $isSignaturValid = VerifySignature::verifyRedirectSignature();
        if (!$isSignaturValid){
            abort(403, 'Invalid redirection');
        }
        return view('success');
    }
}
