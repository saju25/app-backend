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
                         <th> id livreur </th>
                         <th>Photo d’identité </th>
                         <th>Contrat de boutique en PDF</th>
                         <th>Contrat livreur </th>
                     
                         <th>Nom du livreur </th>
                         <th>Numéro du livreur </th>
                         <th>Adresse mail livreur</th>
                         <th>Action</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($drivers as $driver)
                     <tr>
                         <td>{{ $driver->id  }}</td> 
                         <td>
                            <a href="{{ asset($driver->face_photo ) }}">
                                <img src="{{ asset($driver->face_photo ) }}" alt="" width="80px" height="40px">
                            </a>
                              
                        </td> 
                        <td>
                            <a href="{{ asset($driver->pdf_contract  ) }}">Voir</a>
                         </td> 
                         <td>
                            <a href="{{ asset($driver->id_card  ) }}">
                                <img src="{{ asset($driver->id_card  ) }}" alt="" width="80px" height="40px">
                            </a>
                        </td> 
                       
                         <td>{{ $driver->dm_name }}</td> 
                         <td>{{ $driver->dm_phone }}</td> 
                         <td>{{ $driver->dm_email}}</td> 
                        
                         <td>
                            @if ($driver->is_approved == 0)
                                <button class="btn"><a class="text-white text-decoration-none" href="{{route('driver_approved', $driver->id)}}">Approved</a></button>
                                
                            @else
                            <button class="btn_cancel"><a class="text-white text-decoration-none" href="{{route('driver_cancel', $driver->id)}}">Cancel Approved</a></button>
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