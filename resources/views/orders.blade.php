<?php
$pageTitle = 'Orders'
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="w-50 mx-auto my-2">Your Orders</h1>
        @if(count($orders) > 0)
            @foreach($orders as $order)
                @if($order->payment)
                    <div class="order-details-box mx-auto">
                        <h5 class="order-details-title">Order Details</h5>
                        <div class="order-details-body">
                            <p class="order-details-text"><strong>Full Name:</strong> {{$order->full_name}}</p>
                            <p class="order-details-text"><strong>Order Total:</strong> {{$order->total}}</p>
                            <p class="order-details-text"><strong>Status:</strong> <span class="{{$order->payment->status == 'unpaid' ? 'text-danger' : 'text-success'}}">{{$order->payment->status}}</span></p>
                            <div class="d-flex justify-content-between">
                                <a class=" text-decoration-none link-primary pt-3" href="{{route('orderDetails', $order->id)}}">View Order Details</a>
                                @if($order->payment->status == 'unpaid' && auth()->user() && auth()->user()->role != 'admin')
                                    <a href="{{$order->payment->prepay_link}}" class="btn btn-primary">Pay Now</a>
                                @endif
                            </div>

                        </div>
                    </div>
                @endif
            @endforeach
        @else
            <div class="mx-auto mt-3 w-75 d-flex flex-column align-items-center justify-content-center">
                <h2>Your have no orders</h2>
            </div>
        @endif
        </div>

@endsection
