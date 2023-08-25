<?php
$pageTitle = 'Check out'
?>
@extends('layouts.app-payment')

@section('content')
<div class="container-checkout">
    <h1>Checkout</h1>
    <form id="checkoutForm">
        <div class="form-group required">
            <label for="fullName">Full Name</label>
            <input type="text" class="form-control" id="fullName" required>
        </div>
        <div class="form-group required">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" id="email" required>
        </div>
        <div class="form-group required">
            <label for="address">Shipping Address</label>
            <textarea class="form-control" id="address" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="paymentMethod">Payment Method</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="paymentMethod" id="creditCard" value="creditCard" checked>
                <label class="form-check-label" for="creditCard">
                    Credit Card
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="paymentMethod" id="paypal" value="paypal">
                <label class="form-check-label" for="paypal">
                    PayPal
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-checkout">Place Order</button>
    </form>
</div>
@endsection

