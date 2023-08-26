<?php
$pageTitle = 'Orders'
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($orders as $order)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Order Details</h5>
                    <p class="card-text"><strong>Order Total:</strong> {{$order->total}}</p>
                    <p class="card-text"><strong>Full Name:</strong> {{$order->full_name}}</p>
                    <p class="card-text"><strong>Status:</strong> {{$order->payment->status}}</p>
                    @if($order->payment->status == 'unpaid')
                    <a href="https://example.com/prepay" class="btn btn-primary">PayNow</a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

@endsection
