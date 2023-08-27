<?php
$pageTitle = 'Orders'
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        @if(count($orders) > 0)
            @foreach($orders as $order)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order Details</h5>
                        <p class="card-text"><strong>Order Total:</strong> {{$order->total}}</p>
                        <p class="card-text"><strong>Full Name:</strong> {{$order->full_name}}</p>
                        <p class="card-text"><strong>Status:</strong> <span class="{{$order->payment->status == 'unpaid' ? 'text-danger' : 'text-success'}}">{{$order->payment->status}}</span></p>
                        @if($order->payment->status == 'unpaid' && auth()->user() && auth()->user()->role != 'admin')
                        <a href="{{$order->payment->prepay_link}}" class="btn btn-primary">Pay Now</a>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <div class="mx-auto mt-3 w-75 d-flex flex-column align-items-center justify-content-center">
                <h2>Your have no orders</h2>
            </div>
        @endif
        </div>

@endsection
