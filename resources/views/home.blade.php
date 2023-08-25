<?php
$pageTitle = 'Kashier Demo'
?>
@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            @foreach($products as $key => $product)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <img class="card-img-top" src="{{$product->image}}" alt="Product {{$key}}" width="240px" height="220px" loading="lazy">
                    <div class="card-body">
                        <h5 class="card-title">{{$product->name}}</h5>
                        <p class="card-text">{{$product->description}}</p>
                        <p class="card-text"><b>{{$product->price}} EGP</b></p>
                        <form action="{{route('addToCart')}}" method="post" class="d-flex justify-content-between">
                            @csrf
                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                            <div class="counter">
                                <button class="counter-btn decrement" type="button">-</button>
                                <input type="number" class="counter-input" value="1" min="1" name="quantity" readonly>
                                <button class="counter-btn increment" type="button">+</button>
                            </div>
                            <input type="hidden" id="product" name="product" value="{{$product->id}}">

                        </form>

                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>

@endsection

