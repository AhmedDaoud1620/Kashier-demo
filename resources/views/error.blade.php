<?php
$pageTitle = 'Error!'
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="text-center mt-5">
                    <i class="fas fa-exclamation-circle fa-5x text-danger"></i>
                    <h4 class="mt-4">Oops! Something went wrong.</h4>
                    <p>Please try again.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary mt-3">Return Home</a>
                </div>
            </div>
        </div>
    </div>
@endsection

