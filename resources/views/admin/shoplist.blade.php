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
                         <th>identifiant phcie</th>
                         <th>Photo phcie</th>
                         <th>Nom phcies </th>
                         <th>Numéro Wave Phcies (Wave number for payment)</th>
                         <th>email Phcies </th>
                         <th>Action</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($shops as $shop)
                     <tr>
                         <td>{{ $shop->id  }}</td> 
                         <td>
                                <img src="{{ asset($shop->shop_photo) }}" alt="" width="80px" height="40px">
                           
                        </td> 
                         <td>{{ $shop->shop_name}}</td> 
                         <td>{{ $shop->shop_phone}}</td> 
                         <td>{{ $shop->shop_email}}</td> 
                        
                         <td>
                            @if ($shop->is_approved == 0)
                                <button class="btn"><a class="text-white text-decoration-none" href="{{route('approved', $shop->id)}}">Approved</a></button>
                                
                            @else
                            <button class="btn_cancel"><a class="text-white text-decoration-none" href="{{route('approved_cancel', $shop->id)}}">Cancel Approved</a></button>
                           @endif
                         </td> 
                     </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>
        
   
           
         </div>
   </div>

</x-guest-layout>