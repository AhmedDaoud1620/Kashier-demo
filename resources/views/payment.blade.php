<?php
$pageTitle = 'Payment'
?>
@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="mt-2">Order Details</h1>
    <div class="invoice-container">
        <div class="invoice-header">
            <h2>Kashier Store Invoice</h2>
            <img src="{{asset('assets/img/invoicelogo.png')}}" alt="Logo" width="50">
        </div>
        <div class="invoice-details">
            <div>
                <p><strong>Name:</strong> {{$order->full_name}}</p>
                <p><strong>Email:</strong> {{$order->email}}</p>
                <p><strong>Phone Number:</strong> {{$order->phone}}</p>
                <p><strong>Provider:</strong> {{env('STORE_NAME')}}</p>
            </div>
            <div>
                <p><strong>Invoice Number:</strong>{{$order->payment->invoice_kash_id}}</p>
                <p><strong>Date:</strong>{{$order->created_at}}</p>
            </div>
        </div>
        <div class="invoice-items">
            <table>
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>SubTotal</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->orderItems as $item)
                    <tr>
                        <td>{{$item->product->name}}</td>
                        <td>{{env('CURRENCY') .' '. $item->product->price}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{env('CURRENCY') .' '.$item->quantity * $item->product->price }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="invoice-total">
            <p class="h1"><strong>Total:</strong> {{env('CURRENCY') .' '. $order->total}}</p>
        </div>
    </div>
</div>
    <div class="w-75 m-auto d-flex justify-content-center mt-2">
        @include('layouts.partials.payment-script')
    </div>
@endsection

