<?php

namespace App\Http\Controllers;


use App\Http\Helpers\Hashing;
use App\Http\Helpers\Kashier;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

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
        if(!isset($_SERVER['HTTP_REFERER'])){
            abort(403, 'Access denied');
        }
        if(count(session('shoppingCart', [])) == 0)
            return redirect('/');
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

    public function createOrder(Request $request, CartService $cart)
    {
        if(count(session('shoppingCart', [])) == 0)
            return redirect('/');

        try {
            DB::beginTransaction();
            $userId = Auth::user() ? Auth::user()->id : null;
            $total = 0;
            $orderItems = session('shoppingCart',[]);
            if(count($orderItems) > 0){
                foreach ($orderItems as $item){
                    $total += $item['subTotal'];
                }
            }
            $order = null;
            $paymentId = null;
            $order = Order::create([
                'user_id' => $userId,
                'total' => $total,
                'address' => $request->address,
                'full_name' => $request->fullName,
                'phone' => $request->phone,
                'email' => $request->email,
                'payment_method' => $request->paymentMethod,
                'currency' => env('CURRENCY'),
                'invoice_reference_id'=> Str::uuid()->toString()
            ]);
            $this->createOrderItems($order->id);

            $kashier = new Kashier(env('CURRENCY'), 'en');
            $invoice =  $kashier->CreateInvoice($order);
            $paymentId = $this->createPayment($invoice);
            $order->payment_id = $paymentId;
            $order->order_merchant_id = $invoice->_id;
            $order->save();

            DB::commit();
            $cart->destroyCart();
            if(!Auth::user())
                $kashier->ShareInvoiceByEmail($order);
            return redirect()->route('payment')->with('orderId', $order->id);

        }catch (\Exception $e) {
            throw new \Exception($e);
            DB::rollback();
            return view('error');
        }

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

        ]);
        return $payment->id;
    }



}
