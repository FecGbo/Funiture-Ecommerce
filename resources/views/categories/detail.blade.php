@extends('layouts.admin')

@section('title', 'Category Details')
<link rel="stylesheet" href="/css/detail_categories.css">
@section('content')
    <div class="category-form-container">
        <div class="form-header">
            <h3>Category Details</h3>
            <p class="form-subtitle">View or update information below</p>
        </div>
        <!-- Update Form -->
        <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data"
            class="category-form">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="form-grid">
                <div class="form-fields">
                    <div class="form-group">
                        <label for="category_name" class="form-label">Category Name</label>
                        <x-input type="text" id="category_name" name="category_name" class="form-input"
                            placeholder="Enter category name" :value="old('category_name', $category->name)" required />
                        @error('category_name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category_description" class="form-label">Category Description</label>
                        <textarea id="category_description" name="category_description" class="form-textarea"
                            placeholder="Enter category description" rows="4"
                            required>{{ old('category_description', $category->description) }}</textarea>
                        @error('category_description')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-actions">
                        <div class="form-actions-group">
                            <x-button type="submit" variant="success">
                                <i class=""></i>
                                Save
                            </x-button>
                            <x-button type="button" variant="secondary" onclick="window.history.back()">
                                <i class=""></i>
                                Cancel
                            </x-button>

                            <x-button type="button" variant="danger" id="showDeleteModalBtn">
                                <i class="fas fa-trash"></i>
                            </x-button>
                        </div>
                    </div>
                </div>
                <!-- Right Column - Image Upload -->
                <div class="image-upload-section">
                    <div class="image-preview-container">
                        <div class="image-preview" id="imagePreview">
                            @if($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" id="previewImg">
                            @else
                                <img src="/images/logo.png" alt="Category Image" id="previewImg">
                            @endif
                        </div>
                        <button type="button" class="btn btn-primary btn-change-image"
                            onclick="document.getElementById('category_image').click()">
                            <i class="fas fa-camera"></i> Change Image
                        </button>
                        <x-input type="file" id="category_image" name="category_image" accept="image/*"
                            style="display: none;" onchange="previewImage(this)" />
                    </div>
                    @error('category_image')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </form>

        <!-- Delete Form -->
        <form id="deleteCategoryForm" action="{{ route('category.delete', $category->id) }}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="DELETE">
        </form>

        <!-- Delete Confirmation Modal Component -->
        <x-delete-modal :modalId="'deleteModal'" :title="'Confirm Delete'" :message="'Are you sure you want to delete this category?'" :cancelId="'cancelDeleteBtn'" :confirmId="'confirmDeleteBtn'" :formId="'deleteCategoryForm'" />
    </div>

    <script>
                Image preview
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('previewImg').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        document.getElementById('showDeleteModalBtn').addEventListener('click', function (e) {
            e.preventDefault();
            document.getElementById('deleteModal').style.display = 'flex';
        });


    </script>
@endsection