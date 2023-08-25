<?php

namespace App\Http\Controllers;


use App\Models\CartItem;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
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
        $total = 0;
        $items = session('shoppingCart',[]);
        if(count($items) > 0){
            foreach ($items as $item){
                $total += $item['subTotal'];
            }
        }

        return view('cart', ['items'=> $items, 'total' =>$total]);
    }

    public function addToCart(CartService $cartService, Request $request)
    {
        if(Auth::user()){
            $shoppingSessionId = Auth::user()->shoppingSessions()->first()->id;
            $cartItem =  CartItem::where(['shopping_session_id'=> $shoppingSessionId, 'product_id' => $request->product])->first();
            if($cartItem){
                $cartItem->quantity += $request->quantity;
            }
            else{
                CartItem::create([
                    'shopping_session_id' => $shoppingSessionId,
                    'product_id' => $request->product,
                    'quantity' => $request->quantity
                ]);
            }

        }
        $cartService->addToCart($request->product, $request->quantity);
        return  redirect()->route('cart');
    }

    public function removeFromCart(CartService $cartService, Request $request)
    {
        if(Auth::user()){
            $shoppingSessionId = Auth::user()->shoppingSessions()->first()->id;
            CartItem::where(['shopping_session_id'=> $shoppingSessionId, 'product_id' => $request->product])->delete();

        }
        $cartService->removeFromCart($request->product);
        return  redirect()->route('cart');
    }

    public function changeQuantity(CartService $cartService, Request $request)
    {
        if(Auth::user()){
            $shoppingSessionId = Auth::user()->shoppingSessions()->first()->id;
            $cartItem =  CartItem::where(['shopping_session_id'=> $shoppingSessionId, 'product_id' => $request->product])->first();
            if($cartItem){
                if($request->type == 'increase'){
                    $cartItem->quantity += 1;
                }
                else {
                    $cartItem->quantity -= 1;

                }
                $cartItem->save();
            }
            else{
                CartItem::create([
                    'shopping_session_id' => $shoppingSessionId,
                    'product_id' => $request->product,
                    'quantity' => $request->quantity
                ]);
            }

        }
        if($request->type == 'increase'){
            $cartService->addToCart($request->product, 1);
        }
        else {
            $cartService->reduceQuantity($request->product);

        }

        return  redirect()->route('cart');
    }

}
