<?php
$pageTitle = 'Check out'
?>
@extends('layouts.app')

@section('content')
<div class="container-checkout mt-3">
    <h1>Checkout</h1>
    <form id="checkoutForm" action="{{route('placeOrder')}}" method="post">
        @csrf
        <div class="form-group required">
            <label for="fullName">Full Name</label>
            <input type="text" class="form-control" id="fullName" name="fullName" value="{{$name}}" required>
        </div>
        <div class="form-group required">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{$email}}" required>
        </div>
        <div class="form-group required">
            <label for="address">Phone</label>
            <input type="tel" class="form-control" id="phone" name="phone" value="{{$phone}}" required>
        </div>
        <div class="form-group required">
            <label for="address">Shipping Address</label>
            <textarea class="form-control" id="address" rows="3" name="address" required>{{$address}}</textarea>
        </div>
        <div class="form-group">
            <label for="paymentMethod">Payment Method</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="paymentMethod" id="creditCard" value="card" checked>
                <label class="form-check-label" for="creditCard">
                    Credit Card
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="paymentMethod" id="fawry" value="fawry">
                <label class="form-check-label" for="fawry">
                    Fawry
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="paymentMethod" id="wallet" value="wallet">
                <label class="form-check-label" for="wallet">
                    Wallet
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-checkout">Proceed to Payment</button>
    </form>
</div>
@endsection

