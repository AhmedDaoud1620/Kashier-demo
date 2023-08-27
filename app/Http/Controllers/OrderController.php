<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $userRole = Auth::user()->role;
        $userId = Auth::user()->id;
        $orders = '';
        if ($userRole == 'admin'){
            $orders = Order::orderBy("created_at", 'desc')->get();
        }
        else{
            $orders = Order::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        }

        return view('orders', ['orders'=>$orders]);
    }
}
