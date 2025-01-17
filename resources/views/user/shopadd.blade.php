<!-- resources/views/shops/create.blade.php -->

<x-app-layout>
    <div class="container">
        <h1>Add New Shop</h1>

        <!-- Shop Creation Form -->
        <form action="{{ route('shops.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Shop Name -->
            <div class="form-group">
                <label for="shop_name">Shop Name</label>
                <input type="text" class="form-control @error('shop_name') is-invalid @enderror" id="shop_name" name="shop_name" value="{{ old('shop_name') }}" required>
                @error('shop_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Shop Description -->
            <div class="form-group">
                <label for="shop_description">Shop Description</label>
                <textarea class="form-control @error('shop_description') is-invalid @enderror" id="shop_description" name="shop_description">{{ old('shop_description') }}</textarea>
                @error('shop_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Shop Address -->
            <div class="form-group">
                <label for="shop_address">Shop Address</label>
                <input type="text" class="form-control @error('shop_address') is-invalid @enderror" id="shop_address" name="shop_address" value="{{ old('shop_address') }}" required>
                @error('shop_address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Shop Phone -->
            <div class="form-group">
                <label for="shop_phone">Shop Phone</label>
                <input type="text" class="form-control @error('shop_phone') is-invalid @enderror" id="shop_phone" name="shop_phone" value="{{ old('shop_phone') }}">
                @error('shop_phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Shop Email -->
            <div class="form-group">
                <label for="shop_email">Shop Email</label>
                <input type="email" class="form-control @error('shop_email') is-invalid @enderror" id="shop_email" name="shop_email" value="{{ old('shop_email') }}">
                @error('shop_email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Shop Photo -->
            <div class="form-group">
                <label for="shop_photo">Shop Photo</label>
                <input type="file" class="form-control-file @error('shop_photo') is-invalid @enderror" id="shop_photo" name="shop_photo">
                @error('shop_photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Save Shop</button>
        </form>
    </div>
</x-app-layout>
