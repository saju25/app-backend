<x-app-layout>
<div class="container">
    <h2>{{ isset($product) ? 'Edit Product' : 'Create Product' }}</h2>
    
    <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (isset($product))
            @method('PUT')
        @endif
        
        <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" name="product_name" id="product_name" class="form-control @error('product_name') is-invalid @enderror" value="{{ old('product_name', $product->product_name ?? '') }}">
            @error('product_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="product_type">Product Type</label>
            <input type="text" name="product_type" id="product_type" class="form-control @error('product_type') is-invalid @enderror" value="{{ old('product_type', $product->product_type ?? '') }}">
            @error('product_type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="product_brand_name">Product Brand Name</label>
            <input type="text" name="product_brand_name" id="product_brand_name" class="form-control @error('product_brand_name') is-invalid @enderror" value="{{ old('product_brand_name', $product->product_brand_name ?? '') }}">
            @error('product_brand_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="product_description">Product Description</label>
            <textarea name="product_description" id="product_description" class="form-control @error('product_description') is-invalid @enderror">{{ old('product_description', $product->product_description ?? '') }}</textarea>
            @error('product_description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="mrp_price_of_piece">MRP Price of Piece</label>
            <input type="number" step="0.01" name="mrp_price_of_piece" id="mrp_price_of_piece" class="form-control @error('mrp_price_of_piece') is-invalid @enderror" value="{{ old('mrp_price_of_piece', $product->mrp_price_of_piece ?? '') }}">
            @error('mrp_price_of_piece')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="best_price_of_piece">Best Price of Piece</label>
            <input type="number" step="0.01" name="best_price_of_piece" id="best_price_of_piece" class="form-control @error('best_price_of_piece') is-invalid @enderror" value="{{ old('best_price_of_piece', $product->best_price_of_piece ?? '') }}">
            @error('best_price_of_piece')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="Num_of_piece_one_strip">Number of Pieces per Strip</label>
            <input type="text" name="Num_of_piece_one_strip" id="Num_of_piece_one_strip" class="form-control @error('Num_of_piece_one_strip') is-invalid @enderror" value="{{ old('Num_of_piece_one_strip', $product->Num_of_piece_one_strip ?? '') }}">
            @error('Num_of_piece_one_strip')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="Num_of_strip_one_pack">Number of Strips per Pack</label>
            <input type="text" name="Num_of_strip_one_pack" id="Num_of_strip_one_pack" class="form-control @error('Num_of_strip_one_pack') is-invalid @enderror" value="{{ old('Num_of_strip_one_pack', $product->Num_of_strip_one_pack ?? '') }}">
            @error('Num_of_strip_one_pack')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="stock_quantity">Stock Quantity</label>
            <input type="number" name="stock_quantity" id="stock_quantity" class="form-control @error('stock_quantity') is-invalid @enderror" value="{{ old('stock_quantity', $product->stock_quantity ?? 0) }}">
            @error('stock_quantity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group my-2">
            <label for="product_photo">Product Photo</label>
            <input type="file" name="product_photo" id="product_photo" class="form-control p-2 @error('product_photo') is-invalid @enderror">
            @if (isset($product) && $product->product_photo)
                <div>
                    <img src="{{ asset('storage/' . $product->product_photo) }}" alt="Product Image" width="150">
                </div>
            @endif
            @error('product_photo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary">
            {{ isset($product) ? 'Update Product' : 'Create Product' }}
        </button>
    </form>
</div>
</x-app-layout>