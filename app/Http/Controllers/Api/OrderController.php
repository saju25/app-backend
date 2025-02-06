<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AddToCart;
use App\Models\Order;
use App\Mail\StockMail;
use Illuminate\Support\Facades\Mail;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
        {
                $request->validate([
                        'delivery_address' => 'required',
                        'phone' => 'required',
                        'total' => 'required',
                ]);
                if (!Auth::check()) {
                        return redirect()->route('login')->with('error', 'Please log in to place an order.');
                    }

                    $user = Auth::user();

                    $cartItems = AddToCart::where('user_id', $user->id)->get();

                if ($cartItems->isEmpty()) {
                        return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
                    }
                     try {


                        foreach ($cartItems as $cartItem) {
                           $product = Product::find($cartItem->product_id);
                            
                            if ($product) {
                                if ($cartItem->piece_strip_pack === 'piece') {
                                   $product->stock_quantity -= 1;
                                } elseif ($cartItem->piece_strip_pack === 'strip') {
                                    $product->stock_quantity -= ($product->Num_of_piece_one_strip * $cartItem->quantity);
                                } elseif ($cartItem->piece_strip_pack === 'pack') {
                                    $product->stock_quantity -= ($product->Num_of_strip_one_pack * $product->Num_of_piece_one_strip * $cartItem->quantity);
                                }
                    
                                $product->stock_quantity = max($product->stock_quantity, 0);
                    
                                $product->save();
                                $shop = Shop::find($product->shop_id);
                                $get_product_name = $product->product_name;
                                $get_product_quantity = $product->stock_quantity;
                                if (  $get_product_quantity <= 10) {
                                    Mail::to($shop->shop_email)->send(new StockMail(  $get_product_name,$get_product_quantity));
                               }
                               
                            }
                        }
                    

                    $order = Order::create([
                            'user_id' => $user->id,
                            'shop_id' => $request->shop_id,
                            'delivery_address' => $request->delivery_address,
                            'phone' => $request->phone,
                            'total' => $request->total,
                            'latitude' => $request->latitude,
                            'longitude' => $request->longitude,
                        ]);

                    foreach ($cartItems as $cartItem) {
                       OrderItem::create([
                                'order_id' => $order->id,
                                'product_id' => $cartItem->product_id,
                                'quantity' => $cartItem->quantity,
                                'piece_strip_pack' => $cartItem->piece_strip_pack,
                            ]);
                        }

                    if ( $request->buy_again === "check") {
                        
                        } else {
                            AddToCart::where('user_id', $user->id)->delete();
                        }
                        
                        return response()->json(['product' => $order]);
                    } catch (\Exception $e) {
                        return redirect()->route('cart.index')->with('error', 'There was an error placing your order.');
                    }
                
}




public function updateOrder(Request $request, $id)
{
        $order = Order::find($id);
        $order->status = $request->driver_id;
        $order->status = $request->status;
        $order->save();
        return response()->json(['order' => $order]);
}
public function completeOrder($id)
{
        $order = Order::find($id);
        $order->status = 'Demande complète';
        $order->save();
        return response()->json(['order' => $order]);
}
public function completeOrderAccept($id)
{
        $order = Order::find($id);
        $order->status = 'complète';
        $order->save();
        return response()->json(['order' => $order]);
}





public function getOrder(){
                    $user = Auth::user();
                    $orders = Order::where('user_id', $user->id)->get(); 
                    return $orders; 
}
public function shopOrder($id){
                    $orders = Order::where('shop_id', $id)->get(); 
                    return $orders; 
}
 public function getSpec_Order($id)
                {
                    $user = Auth::user();
                  $order = Order::with('orderItems')->where('id', $id)
                                  ->first();
                
                    return $order;
 }
      
public function getShopOrder($id){
            $shopOrder = Order::where('shop_id', $id)->get();
            return response()->json(['shopOrder' => $shopOrder]);
}
public function getAcceptOrder($driver_id){
            $shopOrder = Order::where('driver_id', $driver_id)->get();
            return response()->json(['acceptOrder' => $shopOrder]);
}

}
