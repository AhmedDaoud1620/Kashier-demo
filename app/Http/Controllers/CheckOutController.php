<?php

namespace App\Http\Controllers;


use App\Http\Helpers\Kashier;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckOutController extends Controller
{
//    /**
//     * Create a new controller instance.
//     *
//     * @return void
//     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function index()
    {
        $fullName = '';
        $email = '';
        $phone= '';
        $address = '';
        if (Auth::user()){
            $fullName = Auth::user()->name;
            $email = Auth::user()->email;
            $phone= Auth::user()->phone;
            $address = Auth::user()->address;
        }
        return view('checkout', ['name'=>$fullName, 'email'=>$email, 'phone'=>$phone, 'address'=>$address]);
    }

    public function createOrder(Request $request)
    {
        $userId = Auth::user() ? Auth::user()->id : null;
        $total = 0;
        $orderItems = session('shoppingCart',[]);
        if(count($orderItems) > 0){
            foreach ($orderItems as $item){
                $total += $item['subTotal'];
            }
        }
        $order = Order::create([
            'user_id' => $userId,
            'total' => $total,
            'address' => $request->address,
            'full_name' => $request->fullName,
            'phone' => $request->phone,
            'email' => $request->email,
            'payment_method' => $request->paymentMethod,
            'currency' => env('CURRENCY')
        ]);
        $this->createOrderItems($order->id);

        $kashier = new Kashier(env('CURRENCY'), 'en');
        $invoice =  $kashier->CreateInvoice($order);
        dd($invoice);
        $payment = $this->createPayment($invoice);
        $order->payment_id = $payment;
        $order->order_merchant_id = $invoice->_id;
        $order->save();
        $cart = new CartService();
        $cart->destroyCart();
        return redirect()->route('payment')->with('orderId', $order->id);
    }

    public function createOrderItems($orderId)
    {
        $orderItems = session('shoppingCart',[]);
        if(count($orderItems) > 0){
            foreach ($orderItems as $item){
                OrderItem::create([
                    'order_id'=>$orderId,
                    'product_id' => $item['productId'],
                    'quantity' => $item['quantity']
                ]);
            }
        }
    }
    public function createPayment($invoice)
    {
        $payment = Payment::create([
            'amount' => $invoice->totalAmount,
            'provider' => 'Kashier',
            'status' => $invoice->paymentStatus,
            'invoice_kash_id' => $invoice->paymentRequestId,
            'prepay_link' => $this->createPrepayUrl($invoice->paymentRequestId),

        ]);
        return $payment->id;
    }

    public function createPrepayUrl($invoiceId)
    {
        return env('SUB_DOMAIN_URL').'/'.$invoiceId.'?mode=' . env('MODE');
    }

}
