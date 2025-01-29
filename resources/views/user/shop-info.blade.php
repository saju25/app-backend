
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
            <div class="">
                <div class="">
                    <div class="page section-header  bg-white mt-5 mb-4 p-4">
                        <h1>Update Shop</h1>
                         <form class="gap-3" action="{{ route('shop_update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') <!-- Method spoofing to simulate PUT request for update -->
        
                            <!-- Shop Name -->
                            <div class="form-group mt-3">
                                <label for="shop_name">Shop Name</label>
                                <input type="text" class="form-control @error('shop_name') is-invalid @enderror" id="shop_name" name="shop_name" value="{{ old('shop_name', $shop->shop_name) }}" required>
                                @error('shop_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
        
                            <!-- Shop Description -->
                            <div class="form-group mt-3">
                                <label for="shop_description">Shop Description</label>
                                <textarea class="form-control @error('shop_description') is-invalid @enderror" id="shop_description" name="shop_description">{{ old('shop_description', $shop->shop_description) }}</textarea>
                                @error('shop_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
        
                            <!-- Shop Address -->
                            <div class="form-group mt-3">
                                <label for="shop_address">Shop Address</label>
                                <input type="text" class="form-control @error('shop_address') is-invalid @enderror" id="shop_address" name="shop_address" value="{{ old('shop_address', $shop->shop_address) }}" required>
                                @error('shop_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
        
                            <!-- Shop Phone -->
                            <div class="form-group mt-3">
                                <label for="shop_phone">Shop Phone</label>
                                <input type="text" class="form-control @error('shop_phone') is-invalid @enderror" id="shop_phone" name="shop_phone" value="{{ old('shop_phone', $shop->shop_phone) }}">
                                @error('shop_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
        
                            <!-- Shop Email -->
                            <div class="form-group mt-3">
                                <label for="shop_email">Shop Email</label>
                                <input type="email" class="form-control @error('shop_email') is-invalid @enderror" id="shop_email" name="shop_email" value="{{ old('shop_email', $shop->shop_email) }}">
                                @error('shop_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
        
                            <!-- Shop Photo -->
                            <div class="form-group mt-3">
                                <label for="shop_photo">Shop Photo</label>
                                <input type="file" class="form-control-file @error('shop_photo') is-invalid @enderror" id="shop_photo" name="shop_photo">
                                @error('shop_photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <!-- Show existing photo if any -->
                                @if($shop->shop_photo)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $shop->shop_photo) }}" alt="Shop Photo" class="img-fluid" style="max-width: 150px;">
                                    </div>
                                @endif
                            </div>
        
                            <button type="submit" class="btn btn-primary mt-3">Update Shop</button>
                        </form>
                    </div>
                </div>
            </div>
         </div>
        
   
           
         </div>
   </div>

</x-guest-layout>