<?php

namespace App\Http\Controllers;

use App\Models\Dm;
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
    $users = User::where('role', 'admin')->get();
    return view('admin.complete-order-list', ['users' => $users]);
 
   }


}
