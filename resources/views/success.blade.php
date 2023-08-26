<?php
$pageTitle = 'Success!'
?>
@extends('layouts.app')

@section('content')
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .success-icon {
            font-size: 60px;
            color: #28a745;
        }

        .title {
            font-size: 32px;
            font-weight: bold;
            margin-top: 20px;
        }

        .message {
            font-size: 22px;
            margin-top: 10px;
            text-align: center;
        }

        .btn-return-home {
            margin-top: 30px;
        }
    </style>
    </head>

    <body>
    <div class="container">
        <i class="fa-regular fa-circle-check fa-bounce fa-2xl" style="color: #5cb85c"></i>
        <div class="title text-success">Payment Successful</div>
        <div class="message">Thank you for your purchase!</div>
        <a href="/" class="btn btn-primary btn-return-home">Return Home</a>
    </div>

@endsection

