<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function paymentsuccess($id,$uniqueid)
    {
        $order = Order::find($id);
        if ($order->paymentid === "$uniqueid" ) {
            $order->payment = "payé";
            $order->save();
            return view('payment');
        }
   
    }
}
