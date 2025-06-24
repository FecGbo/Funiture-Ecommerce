@extends('layouts.admin')

@section('title', 'Category List')
<link rel="stylesheet" href="/css/list_categories.css">
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
    <div class="categories-section">
        <!-- Header -->
        <div class="categories-header">
            <div>
                <h2 class="categories-title">Categories</h2>
                <p class="categories-subtitle">Here is a list of all categories</p>
            </div>
            <a href="{{ route('category.register') }}" class="add-category-btn">Add Category</a>
        </div>

        <!-- Table -->
        <table class="categories-table">
            <thead class="categories-thead">
                <tr>
                    <th style="width: 40px;"></th>
                    <th>CATEGORY</th>
                    <th>DESCRIPTION</th>
                    <th style="width: 80px;">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr class="table-row" data-category-id="{{ $category->id }}">
                        <td class="table-cell" data-label="Select">
                            <input type="checkbox" class="checkbox">
                        </td>
                        <td class="table-cell" data-label="Category">
                            <div class="category-info">
                                @if($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                        class="category-img">
                                @else
                                    <div class="category-icon sofa">{{ strtoupper(substr($category->name, 0, 2)) }}</div>
                                @endif
                                <span class="category-name editable" data-field="name">{{ $category->name }}</span>
                            </div>
                        </td>
                        <td class="table-cell" data-label="Description">
                            <p class="category-description editable" data-field="description">{{ $category->description }}</p>
                        </td>
                        <td class="table-cell" data-label="Action">
                            <div class="action-menu">
                                <a href="{{ route('category.detail', $category->id) }}" class="action-btn"
                                    title="View Details">⋯</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper">
            {{ $categories->links() }}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function makeEditable(element, type = 'input') {
                if (element.classList.contains('editing')) return;
                element.classList.add('editing');
                const oldValue = element.textContent;
                let input;
                if (type === 'textarea') {
                    input = document.createElement('textarea');
                    input.style.minHeight = '50px';

                } else {
                    input = document.createElement('input');
                    input.type = 'text';

                }
                input.value = oldValue;
                input.className = 'inline-edit-input';
                element.textContent = '';
                element.appendChild(input);
                input.focus();
                input.select();
                input.addEventListener('blur', function () {
                    const newValue = input.value.trim();
                    if (newValue !== oldValue) {
                        const row = element.closest('.table-row');
                        const categoryId = row.getAttribute('data-category-id');
                        const field = element.getAttribute('data-field');
                        // Send AJAX request
                        fetch(`/categories/${categoryId}/inline-update`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ field, value: newValue })
                        })
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) {
                                    element.textContent = newValue;
                                } else {
                                    element.textContent = oldValue;
                                    alert('Update failed');
                                }
                                element.classList.remove('editing');
                            })
                            .catch(() => {
                                element.textContent = oldValue;
                                element.classList.remove('editing');
                                alert('Update failed');
                            });
                    } else {
                        element.textContent = oldValue;
                        element.classList.remove('editing');
                    }
                });
                input.addEventListener('keydown', function (e) {
                    if (e.key === 'Enter' && type !== 'textarea') {
                        input.blur();
                    }
                });
            }
            document.querySelectorAll('.category-name.editable').forEach(el => {
                el.addEventListener('click', function () {
                    makeEditable(el, 'input');
                });
            });
            document.querySelectorAll('.category-description.editable').forEach(el => {
                el.addEventListener('click', function () {
                    makeEditable(el, 'textarea');
                });
            });
        });
    </script>
@endpush