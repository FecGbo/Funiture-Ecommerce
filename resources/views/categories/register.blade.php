@extends('layouts.admin')

@section('title', 'Category Register')

<link rel="stylesheet" href="/css/add_categories.css">
@section('content')
    <div class="category-form-container">
        <div class="form-header">
            <h3>Add New Category</h3>
            <p class="form-subtitle">Fill all information below</p>
        </div>

        <form action="{{ route('category.add') }}" method="POST" enctype="multipart/form-data" class="category-form">
            @csrf

            <div class="form-grid">

                <div class="form-fields">
                    <div class="form-group">
                        <label for="category_name" class="form-label">Category Name</label>
                        <input type="text" id="category_name" name="category_name" class="form-input"
                            placeholder="Enter category name" value="{{ old('category_name') }}" required>
                        @error('category_name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category_description" class="form-label">Category Description</label>
                        <textarea id="category_description" name="category_description" class="form-textarea"
                            placeholder="Enter category description" rows="4">{{ old('category_description') }}</textarea>
                        @error('category_description')
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
                    <div class="image-preview-container">
                        <div class="image-preview" id="imagePreview">
                            <img src="/images/chair-placeholder.png" alt="Category Image" id="previewImg">
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
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('previewImg').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection