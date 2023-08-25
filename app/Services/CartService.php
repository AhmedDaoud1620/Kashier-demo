<?php

namespace App\Services;

use App\Models\Product;

class CartService {

    public function addToCart(int $productId, int $quantity)
    {

        $shoppingCart = session('shoppingCart', []);


        if (isset($shoppingCart[$productId]))
        {
            $shoppingCart[$productId]['quantity'] += $quantity;
            $shoppingCart[$productId]['subTotal'] = $shoppingCart[$productId]['quantity'] * $shoppingCart[$productId]['unitPrice'];
        }
        else
        {
            $product = Product::findOrFail($productId);
            $shoppingCart[$productId] = [
                'productId' => $productId,
                'quantity'    => $quantity,
                'unitPrice'     => $product->price,
                'itemName'      => $product->name,
                'description'  => $product->description,
                'subTotal'  => $product->price * $quantity
            ];
        }
        session(['shoppingCart' => $shoppingCart]);
        return $shoppingCart;
    }

    public function removeFromCart(int $productId)
    {
        $shoppingCart = session('shoppingCart', []);

        if (!isset($shoppingCart[$productId]))
        {
            return null;
        }
        else
        {
                unset($shoppingCart[$productId]);
        }

        session(['shoppingCart' => $shoppingCart]);
        return $shoppingCart;
    }
    public function reduceQuantity(int $productId)
    {
        $shoppingCart = session('shoppingCart', []);

        if (!isset($shoppingCart[$productId]))
        {
            return null;
        }
        else
        {
            if ($shoppingCart[$productId]['quantity'] == 1){
                unset($shoppingCart[$productId]);
            }
            else
            {
                $shoppingCart[$productId]['quantity'] -= 1;
                $shoppingCart[$productId]['subTotal'] = $shoppingCart[$productId]['quantity'] * $shoppingCart[$productId]['unitPrice'];

            }
        }

        session(['shoppingCart' => $shoppingCart]);
        return $shoppingCart;
    }
    public function destroyCart()
    {
        session(['shoppingCart' => []]);
    }
}
