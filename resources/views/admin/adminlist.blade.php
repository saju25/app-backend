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
             </table>
         </div>
        
   
           
         </div>
   </div>

</x-guest-layout>