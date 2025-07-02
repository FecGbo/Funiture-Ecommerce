@extends('layouts.admin')

@section('title', 'Product Details')
<link rel="stylesheet" href="/css/product/detail_products.css">
@section('content')
    <div class="product-form-container">
        <div class="form-header">
            <h3>Product Details</h3>
            <p class="form-subtitle">View or update information below</p>
        </div>
        <!-- Update Form -->
        <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data"
            class="product-form">
            @csrf
           
            <div class="form-grid">
                <div class="form-fields">
                    <div class="form-group">
                        <label for="product_name" class="form-label">Product Name</label>
                        <x-input type="text" id="product_name" name="product_name" class="form-input"
                            placeholder="Enter product name" :value="old('product_name', $product->name)" required />
                        @error('product_name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="product_description" class="form-label">Product Description</label>
                        <textarea id="product_description" name="product_description" class="form-textarea"
                            placeholder="Enter product description" rows="4"
                            required>{{ old('product_description', $product->description) }}</textarea>
                        @error('product_description')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="purchase_price" class="form-label">Purchase Price</label>
                        <x-input type="number" id="purchase_price" name="purchase_price" class="form-input"
                            placeholder="Enter purchase price" :value="old('purchase_price', $product->purchase_price)" required />
                        @error('purchase_price')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="sale_price" class="form-label">Sale Price</label>
                        <x-input type="number" id="sale_price" name="sale_price" class="form-input"
                            placeholder="Enter sale price" :value="old('sale_price', $product->sale_price)" required />
                        @error('sale_price')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-actions">
                        <div class="form-actions-group">
                            <div class="form-actions-left">
                                <x-button type="submit" variant="success">
                                    <i class=""></i>
                                    Save
                                </x-button>
                                <x-button type="button" variant="secondary" onclick="window.history.back()">
                                    <i class=""></i>
                                    Cancel
                                </x-button>
                            </div>
                            <div class="form-actions-right">
                                <x-button type="button" variant="danger" id="showDeleteModalBtn">
                                    <i class="fas fa-trash"></i>
                                </x-button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column - Category, Stock, Image Upload -->
                 
                <div class="image-upload-section">
                    <div class="form-group">
                        <label for="category_id" class="form-label">Category</label>
                        <select id="category_id" name="category_id" class="form-input" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                     
                    <div class="form-group" id="stockGroup">
                        <label for="stock" class="form-label">Stock</label>
                        <x-input type="number" id="stock" name="stock" class="form-input"
                            placeholder="Enter stock" :value="old('stock', $product->stock)" required />
                        @error('stock')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="image-preview-container">
                        <div class="image-preview" id="imagePreview">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" id="previewImg">
                            @else
                                <img src="/images/logo.png" alt="Product Image" id="previewImg">
                            @endif
                        </div>
                        <button type="button" class="btn btn-primary btn-change-image"
                            onclick="document.getElementById('product_image').click()">
                            <i class="fas fa-camera"></i> Change Image
                        </button>
                        <x-input type="file" id="product_image" name="product_image" accept="image/*"
                            style="display: none;" onchange="previewImage(this)" />
                        @error('product_image')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </form>
        <!-- Delete Form -->
        <form id="deleteProductForm" action="{{ route('product.delete', $product->id) }}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="DELETE">
        </form>

        <!-- Delete Confirmation Modal Component -->
        <x-delete-modal :modalId="'deleteModal'" :title="'Confirm Delete'" :message="'Are you sure you want to delete this product?'" :cancelId="'cancelDeleteBtn'" :confirmId="'confirmDeleteBtn'" :formId="'deleteProductForm'" />
    </div>
    <script>
        const categoryImages = @json($categories->pluck('image', 'id'));
        const storageBase = "{{ asset('storage') }}";
        const defaultImg = "/images/logo.png";

        
        document.addEventListener('DOMContentLoaded', function () {
            const categorySelect = document.getElementById('category_id');
            const previewImg = document.getElementById('previewImg');
            const productImageInput = document.getElementById('product_image');

            categorySelect.addEventListener('change', function () {
                //   if no product image  
              
                if (!productImageInput.value) {
                    const selectedId = this.value;
                    const imgPath = categoryImages[selectedId];
                    if (imgPath) {
                        previewImg.src = storageBase + '/' + imgPath;
                    } else {
                        previewImg.src = defaultImg;
                    }
                }
            });

            //  new image
            productImageInput.addEventListener('change', function () {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        previewImg.src = e.target.result;
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });

            document.getElementById('showDeleteModalBtn').addEventListener('click', function (e) {
                e.preventDefault();
                document.getElementById('deleteModal').style.display = 'flex';
            });
        });
    </script>
@endsection