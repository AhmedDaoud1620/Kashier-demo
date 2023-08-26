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
            $shoppingSession = Auth::user()->shoppingSessions()->first();
            $cartItem =  CartItem::where(['shopping_session_id'=> $shoppingSession->id, 'product_id' => $request->product])->first();
            if($cartItem){
                $cartItem->quantity += $request->quantity;
                $shoppingSession->total += $request->product_price * $request->quantity;
                $cartItem->save();
                $shoppingSession->save();
            }
            else{
                CartItem::create([
                    'shopping_session_id' => $shoppingSession->id,
                    'product_id' => $request->product,
                    'quantity' => $request->quantity
                ]);
                $shoppingSession->total += $request->product_price * $request->quantity;
                $shoppingSession->save();
            }

        }
        $cartService->addToCart($request->product, $request->quantity);
        return  redirect()->route('cart');
    }

    public function removeFromCart(CartService $cartService, Request $request)
    {
        if(Auth::user()){
            $shoppingSession = Auth::user()->shoppingSessions()->first();
            CartItem::where(['shopping_session_id'=> $shoppingSession->id, 'product_id' => $request->product])->delete();
            $shoppingSession->total -= $request->product_total_price;
            $shoppingSession->save();

        }
        $cartService->removeFromCart($request->product);
        return  redirect()->route('cart');
    }

    public function changeQuantity(CartService $cartService, Request $request)
    {
        if(Auth::user()){
            $shoppingSession = Auth::user()->shoppingSessions()->first();
            $cartItem =  CartItem::where(['shopping_session_id'=> $shoppingSession->id, 'product_id' => $request->product])->first();
            if($cartItem){
                if($request->type == 'increase'){
                    $cartItem->quantity += 1;
                    $shoppingSession->total += $request->product_price;
                }
                else {
                    $cartItem->quantity -= 1;
                    $shoppingSession->total -= $request->product_price;

                }
                $cartItem->save();
                $shoppingSession->save();
                if($cartItem->quantity == 0){
                    $cartItem->delete();
                }
            }
            else{
                CartItem::create([
                    'shopping_session_id' => $shoppingSession->id,
                    'product_id' => $request->product,
                    'quantity' => $request->quantity
                ]);
                $shoppingSession->total += $request->product_price;
                $shoppingSession->save();
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
