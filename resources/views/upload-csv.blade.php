<x-guest-layout>
 
    <!-- Sidebar -->
    <div class="sidebar collapse d-md-block" id="sidebar">
     @include('user.sidebar')
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
       <div class=" d-flex justify-content-center align-items-center">
       <div class="page section-header col-md-6 bg-white  mt-5 mb-4 p-4">
        <form action="{{ route('upload.csv') }}" method="POST" enctype="multipart/form-data">
            @csrf
        
            <div class="mb-2">
                <label for="name" class="form-label">Choisissez toutes les images du produit :</label>
            </div>
        
            <div class="input-group">
                <input type="file" class="form-control" name="images[]" id="images" multiple accept="image/*" required>
            </div>
            @error('images')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        
            <div class="mb-2 mt-3">
                <label for="name" class="form-label">Choisir le fichier :</label>
            </div>
        
            <div class="input-group">
                <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="file" required>
            </div>
            @error('file')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        
            <div>
                <button class="btn mt-3" type="submit">Télécharger</button>
            </div>
        </form>
        
        </div>
       </div>
    </div>
   

      
    </div>
</div>

</x-guest-layout>