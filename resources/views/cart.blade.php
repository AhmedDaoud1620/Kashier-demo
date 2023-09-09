<?php
$pageTitle = 'Cart'
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if(count($items) > 0)
            <div class="col-md-6 offset-md-3">
                <h1>Cart</h1>
                <div class="cart-items">
                    @foreach( $items as $key =>$cartItem)
                    <div class="card mb-2">
                        <div class="card-body d-flex flex-column flex-lg-row justify-content-between">
                            <h5 class="card-title">{{$cartItem['itemName']}}</h5>
                            <p class="card-text">Price: {{$cartItem['unitPrice']}}</p>
                            <form action="{{route('changeQuantity')}}" method="post" class="d-flex justify-content-between">
                                @csrf
                                <input type="hidden" class="post-type" name="type">
                                <div class="counter">
                                    <button class="counter-btn decrement decrease-c">-</button>
                                    <input type="number" class="counter-input" value="{{$cartItem['quantity']}}" min="1" name="quantity" readonly>
                                    <button class="counter-btn increment increase-c">+</button>
                                </div>
                                <input type="hidden" id="product" name="product" value="{{$cartItem['productId']}}">
                                <input type="hidden" id="product" name="product_price" value="{{$cartItem['unitPrice']}}">

                            </form>
                            <form action="{{route('removeFromCart')}}" method="post" class="d-flex justify-content-between mt-2 mt-lg-0">
                                @csrf
                                <input type="hidden" id="product" name="product" value="{{$cartItem['productId']}}">
                                <input type="hidden" id="product" name="product_total_price" value="{{$cartItem['subTotal']}}">
                                <button class="btn btn-danger remove-btn" type="submit">Remove</button>

                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="total">
                    <h3>Total: <span id="totalAmount">EGP {{$total}}</span></h3>
                </div>
                <div class="d-flex justify-content-around">
                    <div class="checkout">
                        <a href="{{ route('home') }}" class="btn btn-primary" id="checkoutBtn">Continue Shopping</a>
                    </div>
                    <div class="checkout">
                        <a href="{{ route('checkout') }}" class="btn btn-success" id="checkoutBtn">Checkout</a>
                    </div>
                </div>

            </div>
        </div>
        @else
            <div class="m-auto w-75 d-flex flex-column align-items-center justify-content-center">
                <h2>Your cart is empty</h2>
                <div class="checkout">
                    <a href="{{ route('home') }}" class="btn btn-primary" id="checkoutBtn">Continue Shopping</a>
                </div>
            </div>


        @endif
    </div>

@endsection
