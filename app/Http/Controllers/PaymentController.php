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
        $order->payment->prepay_link = $this->createPrepayUrl($order, $orderHash);
        $order->payment->save();
        return view('payment',['order' => $order,'orderAmount'=> $order->total,'orderHash'=> $orderHash,'orderCurrency'=> $order->currency,'orderId'=> $order->order_merchant_id,'orderPaymentMethod'=> $order->payment_method, 'inviceId'=> $order->payment->invoice_kash_id, 'orderItems'=>$order->orderItems]);
    }

    public function paymentSuccess()

    {
        $isSignaturValid = VerifySignature::verifyRedirectSignature();
        if (!$isSignaturValid){
            abort(403, 'Invalid redirection');
        }
        return view('success');
    }

    public function createPrepayUrl($order, $hash)
    {
        $baseUrl = env('SUB_DOMAIN_URL');
        $merchantId = env('KASHIER_MERCHANT_ID');
        $orderId = $order->order_merchant_id;
        $amount =  $order->total;
        $currency = env('CURRENCY');
        $mode= env('MODE');
        $merchantRedirect = route('success');
        $webhook = route('paidWebHook');
        $paymentRequestId = $order->payment->invoice_kash_id;
        $allowedMethods = "card,wallet,fawry";
        $failureRedirect = "TRUE";
        $display = "en";

        return $baseUrl.'/?merchantId='.$merchantId.'&orderId=' .$orderId.'&amount='.$amount.'&currency='.$currency.'&hash='.$hash.'&mode='.$mode.'&merchantRedirect='.$merchantRedirect.'&serverWebhook='.$webhook.'&paymentRequestId='.$paymentRequestId.'&allowedMethods='.$allowedMethods.'&failureRedirect='.$failureRedirect.'&display='. $display;
    }
}
