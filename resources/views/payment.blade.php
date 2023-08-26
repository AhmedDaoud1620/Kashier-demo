<?php
$pageTitle = 'Payment'
?>
@extends('layouts.app')

@section('content')
        <table id="invoice" class="table table-striped table-bordered mt-2 p-1">
            <thead>
            <tr>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orderItems as $orderItem)
                <tr>
                    <td>{{$orderItem->product->name}}</td>
                    <td>{{$orderItem->quantity}}</td>
                    <td>EGP {{$orderItem->product->price}}</td>
                    <td>EGP {{$orderItem->product->price * $orderItem->quantity}}</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th colspan="3" class="text-end">Total:</th>
                <th>{{$orderAmount}}</th>
            </tr>
            </tfoot>
        </table>
    <div class="w-75 m-auto d-flex justify-content-center mt-2">
        @include('layouts.partials.payment-script')
    </div>
@endsection

