<?php
$pageTitle = 'Cart'
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1>Cart</h1>
                <div class="cart-items">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Product 1</h5>
                            <p class="card-text">Price: $10</p>
                            <button class="btn btn-danger remove-btn">Remove</button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Product 2</h5>
                            <p class="card-text">Price: $15</p>
                            <button class="btn btn-danger remove-btn">Remove</button>
                        </div>
                    </div>
                </div>
                <div class="total">
                    <h3>Total: <span id="totalAmount">$25</span></h3>
                </div>
                <div class="checkout">
                    <button class="btn btn-primary" id="checkoutBtn">Checkout</button>
                </div>
            </div>
        </div>
    </div>

@endsection
