<?php

namespace App\Http\Controllers;

use App\Models\Dm;
use App\Models\Order;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminWebController extends Controller
{
    public function index(){
          $shops = Shop::all();
         return view('admin.shoplist', ['shops' => $shops]);
      
    }
 
    public function approved($id){
         Shop::where('id', $id)->update(['is_approved' => 1]);
         return redirect()->route('admin_index');
      
    }
   
    public function approved_cancel($id){
         Shop::where('id', $id)->update(['is_approved' => 0]);
         return redirect()->route('admin_index');
      
    }
   // Driver fountion
    public function driver(){
        $drivers = Dm::all();
       return view('admin.driverlist', ['drivers' => $drivers]);
    
  }
    public function driver_approved($id){
        Dm::where('id', $id)->update(['is_approved' => 1]);
        return redirect()->route('driver_index');
     
   }
    public function driver_cancel($id){
        Dm::where('id', $id)->update(['is_approved' => 0]);
        return redirect()->route('driver_index');
     
   }
    public function admin(){
     return view('admin.adminregister');
     
   }

   public function register(Request $request)
   {
       $validated = $request->validate([
           'name' => 'required|string|max:255',
           'email' => 'required|string|email|max:255|unique:users,email',
           'role' => 'required',
           'password' => 'required|string|min:8|confirmed',
       ]);

       // Create user
       $user = User::create([
           'name' => $validated['name'],
           'email' => $validated['email'],
           'role' => $validated['role'],
           'password' => Hash::make($validated['password']),
       ]);

      return redirect()->route('admin_list');
   }

   public function adminList(){
     $users = User::where('role', 'admin')->get();
    return view('admin.adminlist', ['users' => $users]);
 
}


                public function adminDelete($id)
                {
                    User::where('id', $id)->delete();
                    return redirect()->route('admin_list');
                
                }

                public function complete_order_List()
                {
                    // Fetch orders with payment 'payé' or status 'complète'
                    $orders = Order::where('payment', 'payé')->orWhere('status', 'complète')->get();
                
                    // Initialize empty arrays for DM and Shop data
                    $dms = [];
                    $shops = [];
                
                    // If there are orders, fetch corresponding DM and Shop data
                    if ($orders->isNotEmpty()) {
                        foreach ($orders as $order) {
                            $dm = Dm::where('id', $order->driver_id)->first();
                            $shop = Shop::where('id', $order->shop_id)->first();
                
                            // Store DM and Shop objects
                            $dms[] = $dm;
                            $shops[] = $shop;
                        }
                    }
                
                    // Return view with orders, dms, and shops
                    return view('admin.complete-order-list', [
                        'orders' => $orders,
                        'dms' => $dms,
                        'shops' => $shops
                    ]);
                }
                     


}
