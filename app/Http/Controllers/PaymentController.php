<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function paymentsuccess($id, $uniqueid)
    {
       $order = Order::find($id);
    
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }
    
        if ($order->paymentid === $uniqueid) {
            $order->payment  = 'payé';
            $order->save();
            return view('payment');
        }
    
        return response()->json(['error' => 'Payment ID mismatch'], 400); 
    }
}
