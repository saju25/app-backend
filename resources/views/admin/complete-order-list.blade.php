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


           <table id="myTable" class="display">
                 <thead>
                     <tr >
                         <th>Admin ID</th>
                          <th>statut de paiement du livreur</th>
                          <th>statut de paiement de la boutique</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($orders as $order)
                     <tr>
                         <td>{{ $order->id  }}</td> 
                        <td>{{ $dm->dm_phone   }}</td> 
                         <td>{{ $shop->shop_phone  }}</td> 
                      
                      
                     </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>
        
   
           
         </div>
   </div>







</x-guest-layout>