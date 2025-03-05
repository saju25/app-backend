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
            <div class=" d-flex justify-content-center align-items-center">
            <div class="page section-header col-md-6 bg-white  mt-5 mb-4 p-4">
                <h2>Modifier les frais de livraison</h2>
        
                <!-- Display Success Message -->
                @if(session('success'))
                    <div style="color: green;">
                        {{ session('success') }}
                    </div>
                @endif
        
                <!-- Display Validation Errors -->
                @if($errors->any())
                    <div style="color: red;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
        
                <!-- Delivery Fee Form -->
                <form 
                    action="{{ isset($deliveryFee) ? route('delivryfeeupdate', $deliveryFee->id) : route('delivryfeeadd') }}" 
                    method="POST">
                    @csrf
                    @if(isset($deliveryFee))
                        @method('PUT') <!-- Add this method field for PUT request -->
                    @endif
        
                    <div class="mb-2">
                        <label for="dayfee" class="form-label">Frais de livraison en journée</label>
                        <input type="number" class="form-control" name="dayfee" value="{{ old('dayfee', $deliveryFee->dayfee ?? '') }}"  required>
                    </div>
                    <div class="mb-2">
                        <label for="dayfee" class="form-label">Frais de livraison pour un jour supplémentaire</label>
                        <input type="number" class="form-control" name="addi_dayfee" value="{{ old('addi_dayfee', $deliveryFee->addi_dayfee ?? '') }}" required>
                    </div>
        
                    <div class="mb-2">
                        <label for="nightfee" class="form-label">Frais de livraison de nuit</label>
                        <input type="number" class="form-control" name="nightfee" value="{{ old('nightfee', $deliveryFee->nightfee ?? '') }}"  required>
                    </div>
                    <div class="mb-2">
                        <label for="nightfee" class="form-label">Frais de livraison de nuit supplémentaires</label>
                        <input type="number" class="form-control" name="addi_nightfee" value="{{ old('addi_nightfee', $deliveryFee->addi_nightfee ?? '') }}"  required>
                    </div>
                    <div class="mb-2">
                        <label for="nightfee" class="form-label">Voulez-vous payer le chauffeur (%)</label>
                        <input type="number" class="form-control" name="paydriver" value="{{ old('paydriver', $deliveryFee->paydriver ?? '') }}"  required>
                    </div>
        
                    <div>
                        <button type="submit" class="btn mt-3">Mise à jour des frais de livraison</button>
                    </div>
                </form>
             </div>
            </div>
         </div>
        
   
           
         </div>
   </div>

</x-guest-layout>