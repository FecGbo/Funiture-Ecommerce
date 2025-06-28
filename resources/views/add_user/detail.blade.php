@extends('layouts.admin')

@section('title', 'User Details')

<link rel="stylesheet" href="/css/add_user/detail_user.css">
@section('content')
    <div class="category-form-container">
        <div class="form-header">
            <h3>User Details</h3>
            <p class="form-subtitle">View or update information below</p>
        </div>

        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data"
            class="category-form">
            @csrf
            <div class="form-grid">
                <div class="form-fields">
                    <div class="form-group">
                        <label for="name" class="form-label">User Name</label>
                        <x-input type="text" id="name" name="name" class="form-input" :value="old('name', $user->name)"
                            required />
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">User Email</label>
                        <x-input type="email" id="email" name="email" class="form-input" :value="old('email', $user->email)"
                            required />
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="dob" class="form-label">User DOB</label>
                        <x-input type="text" id="dob" name="dob" class="form-input" :value="old('dob', $user->dob)"
                            required />
                        @error('dob')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone" class="form-label">User Phone</label>
                        <x-input type="text" id="phone" name="phone" class="form-input" :value="old('phone', $user->phone)"
                            required />
                        @error('phone')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="role" class="form-label">Role</label>
                        <select id="role" name="role" class="form-input" required>
                            <option value="customer" {{ old('role', $user->role) == 'customer' ? 'selected' : '' }}>Customer
                            </option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('role')
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

                <!-- Right Column - Image Upload -->
                <div class="image-upload-section">
                    <div class="form-group">
                        <label for="address" class="form-label">User Address</label>
                        <x-input type="text" id="address" name="address" class="form-input" :value="old('address', $user->address)" required />
                        @error('address')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password <span
                                style="font-weight:normal; color:#888;">(leave blank to keep current)</span></label>
                        <x-input type="password" id="password" name="password" class="form-input" :value="old('password')"
                            autocomplete="new-password" />
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="image-preview-container">
                        <div class="image-preview" id="imagePreview">
                            <img src="{{ $user->image ? asset('storage/' . $user->image) : '' }}" alt="User Image"
                                id="previewImg">
                        </div>

                        <button type="button" class="btn btn-primary btn-change-image"
                            onclick="document.getElementById('image').click()">
                            <i class="fas fa-camera"></i> Change Image
                        </button>

                        <input type="file" id="image" name="image" accept="image/*" style="display: none;"
                            onchange="previewImage(this)">
                    </div>
                    @error('image')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </form>

        <form id="deleteUserForm" action="{{ route('user.delete', $user->id) }}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="DELETE">
        </form>

        <!-- Delete Confirmation Modal Component -->
        <x-delete-modal :modalId="'deleteModal'" :title="'Confirm Delete'" :message="'Are you sure you want to delete this user?'" :cancelId="'cancelDeleteBtn'" :confirmId="'confirmDeleteBtn'" :formId="'deleteUserForm'" />
    </div>
@endsection
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


    // need DOMContentLoaded if outside of adsection
    document.addEventListener('DOMContentLoaded', function () {
        var deleteBtn = document.getElementById('showDeleteModalBtn');
        if (deleteBtn) {
            deleteBtn.addEventListener('click', function (e) {
                e.preventDefault();
                document.getElementById('deleteModal').style.display = 'flex';
            });
        }
    });
</script>