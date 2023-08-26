<?php
$pageTitle = 'Success!'
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-success">Payment Successful!</h1>
        <p>Thank you for your payment.</p>
        <a href="/" class="btn btn-primary">Return Home</a>
    </div>

@endsection

