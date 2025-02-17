<x-guest-layout>
 
    <!-- Sidebar -->
    <div class="sidebar collapse d-md-block" id="sidebar">
     @include('admin.sidebar')
   </div>

   <!-- Main content -->
   <div class="content">
     <div class="nav_container">
         <div class="nav_div">
             <nav class="navbar navbar-expand-md navbar-dark bg-dark ">
                 <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                 </button>
             </nav>
         </div>
       
     </div>
  
    
      <div class="container ">

         <div class="conten_div">



            <div class="btm btn-success w-100 p-3 mt-3 cursor-pointer" href="#" onclick='calltouchpay()'>S'abonner</div>

             {{-- <table id="myTable" class="display">
                 <thead>
                     <tr >
                         <th>Admin ID</th>
                         <th>Name</th>
                          <th>Email</th>
                          <th>Action</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($users as $user)
                     <tr>
                         <td>{{ $user->id  }}</td> 
                         <td>{{ $user->name  }}</td> 
                         <td>{{ $user->email  }}</td> 
                      
                     
                        <td>
                          
                            <form action="{{ route('admin_delete', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this admin?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn_cancel text-white text-decoration-none" type="submit">Delete</button>
                            </form>
                            
                         </td> 
                     </tr>
                     @endforeach
                 </tbody>
             </table> --}}
         </div>
        
   
           
         </div>
   </div>





   @php
   $email = Auth::user()->email;
   $first = Auth::user()->name;
   $last = Auth::user()->fullname;
   $phone = Auth::user()->phone;
@endphp


<script src=https://touchpay.gutouch.net/touchpayv2/script/touchpaynr/prod_touchpay-0.0.1.js  type="text/javascript"></script>
     <script type="text/javascript">
       function calltouchpay(){

           var email = {!! json_encode($email) !!};
           var first = {!! json_encode($first) !!};
           var last = {!! json_encode($last) !!};
           var phone = {!! json_encode($phone) !!};



           sendPaymentInfos(new Date().getTime(),
                            'XCPNY11168','v4GE9BuvtAA9tuDS9xZsmPLVpAZ0wZFcZFAb9OBcauTQeS3Dw4',
                            'xcompnay.com',  {!! json_encode(url('test-success')) !!},
       {!! json_encode(url('test-fail')) !!}, 3000,
                            'Abidjan',email,first,last,phone);
       }
   </script>






</x-guest-layout>