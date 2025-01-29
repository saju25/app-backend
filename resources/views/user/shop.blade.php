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
                <table id="myTable" class="display">
                    <thead>
                        <tr >
                            <th>Product Name</th>
                            <th>MRP Price</th>
                            <th>Best Price</th>
                            <th>Stock Quantity </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->product_name  }}</td> 
                            <td>{{ $product->mrp_price_of_piece   }}</td> 
                            <td>{{ $product->best_price_of_piece    }}</td> 
                            <td>{{ $product->stock_quantity     }}</td> 
                            <td>
                                <button class="btn"><a class="text-white" href="{{route('edit_view', $product->id)}}">Edit</a></button>
                            </td> 
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
           
      
              
            </div>
      </div>

</x-guest-layout>