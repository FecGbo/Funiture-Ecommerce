@extends('layouts.admin')

@section('title', 'Category Register')

<link rel="stylesheet" href="/css/product/add_product.css">
@section('content')
    <div class="category-form-container">
        <div class="form-header">
            <h3>Add New Product</h3>
            <p class="form-subtitle">Fill all information below</p>
        </div>
        <form action="{{ route('product.add') }}" method="POST" enctype="multipart/form-data" class="category-form">
            @csrf

            <div class="form-grid">

                <div class="form-fields">
                    <div class="form-group">
                        <label for="product_name" class="form-label">Product Name</label>
                        <input type="text" id="product_name" name="product_name" class="form-input"
                            placeholder="Enter product name" value="{{ old('product_name') }}" required>
                        @error('product_name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="product_code" class="form-label">Product Code</label>
                        <input type="text" id="product_code" name="product_code" class="form-input"
                            placeholder="Enter category name" value="{{ old('product_code') }}" required>
                        @error('product_code')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="product_stock" class="form-label">Product Stock</label>
                        <input type="text" id="product_stock" name="product_stock" class="form-input"
                            placeholder="Enter category name" value="{{ old('product_stock') }}" required>
                        @error('product_stock')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="purchase_price" class="form-label">Purchase Price</label>
                        <input type="text" id="purchase_price" name="purchase_price" class="form-input"
                            placeholder="Enter category name" value="{{ old('purchase_price') }}" required>
                        @error('purchase_price')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="sale_price" class="form-label">Sale Price</label>
                        <input type="text" id="sale_price" name="sale_price" class="form-input"
                            placeholder="Enter category name" value="{{ old('sale_price') }}" required>
                        @error('sale_price')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>



                    <div class="form-actions">
                        <x-button type="submit" variant="success">
                            <i class=""></i>
                            Save Data
                        </x-button>
                        <x-button type="button" variant="secondary" onclick="window.history.back()">
                            <i class=""></i>
                            Cancel
                        </x-button>
                    </div>
                </div>

                <!-- Right Column - Image Upload -->
                <div class="image-upload-section">

                    <div class="form-group">
                        <label for="category_id" class="form-label">Category</label>
                        <select id="category_id" name="category_id" class="form-input" required>
                            <option value="">Select category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="product_description" class="form-label">Product Description</label>
                        <input type="text" id="product_description" name="product_description" class="form-input"
                            placeholder="Enter category name" value="{{ old('product_description') }}" required>
                        @error('product_description')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>



                    <div class="image-preview-container">
                        <div class="image-preview" id="imagePreview">
                            <img src="" alt="Category Image" id="previewImg">
                        </div>
                        <x-button type="button" class="btn-change-image"
                            onclick="document.getElementById('category_image').click()">
                            <i class="fas fa-camera"></i>
                            Change Image
                        </x-button>
                        <input type="file" id="category_image" name="category_image" accept="image/*" style="display: none;"
                            onchange="previewImage(this)">
                    </div>
                    @error('category_image')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </form>
    </div>

    <script>

        const categoryImages = @json($categories->pluck('image', 'id'));
        const storageBase = "{{ asset('storage') }}";
        const defaultImg = "/images/logo.png";
        document.addEventListener('DOMContentLoaded', function () {
            const categorySelect = document.getElementById('category_id');
            const previewImg = document.getElementById('previewImg');
            const categoryImageInput = document.getElementById('category_image');

            categorySelect.addEventListener('change', function () {
                // if no image is uploaded
                if (!categoryImageInput.value) {
                    const selectedId = this.value;
                    const imgPath = categoryImages[selectedId];
                    if (imgPath) {
                        previewImg.src = storageBase + '/' + imgPath;
                    } else {
                        previewImg.src = defaultImg;
                    }
                }
            });

            // If uploads a new image
            categoryImageInput.addEventListener('change', function () {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        previewImg.src = e.target.result;
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    </script>
@endsection


