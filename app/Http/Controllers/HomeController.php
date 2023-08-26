<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Support\Facades\Auth;

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
        if(Auth::user() && Auth::user()->role == 'admin'){
            return redirect()->route('orders');
        }
        $products = Product::all();
        return view('home', ['products' => $products]);
    }
}
