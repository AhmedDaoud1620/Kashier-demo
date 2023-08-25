<?php

namespace App\Http\Controllers;


use App\Models\Product;

class HomeController extends Controller
{
//    /**
//     * Create a new controller instance.
//     *
//     * @return void
//     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function index()
    {
        $products = Product::all();
        return view('home', ['products' => $products]);
    }
}
