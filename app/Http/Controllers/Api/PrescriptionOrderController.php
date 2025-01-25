<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrescriptionOrderController extends Controller
{
 public function PrescriptionOrder(Request $request)
    {
            $request->validate([
                    'delivery_address' => 'required',
                    'phone' => 'required',
                    'prescription' => 'required',
            ]);
               if (!Auth::check()) {
                    return redirect()->route('login')->with('error', 'Please log in to place an order.');
                }

                $user = Auth::user();
                $order = Order::create([
                    'user_id' => $user->id,
                    'shop_id' => $request->shop_id,
                    'delivery_address' => $request->delivery_address,
                    'phone' => $request->phone,
                ]);

                if ($request->hasFile('prescription')) {
                    $file = $request->file('prescription');
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    // Move the file to the public folder (within 'uploads/products')
                    $file->move(public_path('uploads/prescription'), $fileName);
                    
                    // Store only the relative path in the database
                    $order->prescription_photo = 'uploads/prescription/' . $fileName;
                }
                $order->save();
                  return response()->json(['order' => $order],200);
              
            
        }
}
