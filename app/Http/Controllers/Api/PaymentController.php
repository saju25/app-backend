<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function paymentsuccess($id)
    {
        $order = Order::find($id);
        $order->status = "payé";
        $order->save();
        dd($order);
        return view('payment',);
    }
}
