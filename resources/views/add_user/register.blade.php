@extends('layouts.admin')

@section('title', 'Category Register')

<link rel="stylesheet" href="/css/add_user/add_user.css">
@section('content')
    <div class="category-form-container">
        <div class="form-header">
            <h3>Add New User</h3>
            <p class="form-subtitle">Fill all information below</p>
        </div>

        <form action="{{ route('user.register') }}" method="POST" enctype="multipart/form-data" class="category-form">
            @csrf

            <div class="form-grid">

                <div class="form-fields">
                    <div class="form-group">
                        <label for="name" class="form-label">User Name</label>
                        <input type="text" id="name" name="name" class="form-input" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">User Email</label>
                        <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="dob" class="form-label">User DOB</label>
                        <input type="text" id="dob" name="dob" class="form-input" value="{{ old('dob') }}" required>
                        @error('dob')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone" class="form-label">User Phone</label>
                        <input type="text" id="phone" name="phone" class="form-input" value="{{ old('phone') }}" required>
                        @error('phone')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="role" class="form-label">Role</label>
                        <select id="role" name="role" class="form-input" required>
                            <option value="customer" {{ old('role', 'customer') == 'customer' ? 'selected' : '' }}>Customer
                            </option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>

                        </select>
                        @error('role')
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
                        <label for="address" class="form-label">User Address</label>
                        <input type="text" id="address" name="address" class="form-input" value="{{ old('address') }}"
                            required>
                        @error('address')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-input"
                            value="{{ old('password') }}" required>
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>



                    <div class="image-preview-container">
                        <div class="image-preview" id="imagePreview">
                            <img src="" alt="Category Image" id="previewImg">
                        </div>
                        <x-button type="button" class="btn-change-image" onclick="document.getElementById('image').click()">
                            <i class="fas fa-camera"></i>
                            Change Image
                        </x-button>
                        <input type="file" id="image" name="image" accept="image/*" style="display: none;"
                            onchange="previewImage(this)">
                    </div>
                    @error('image')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </form>
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
</script>