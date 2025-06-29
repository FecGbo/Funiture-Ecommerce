@extends('layouts.admin')

@section('title', 'Category List')
<link rel="stylesheet" href="/css/category/list_categories.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
@php
    $newCategoryId = session('new_category_id');
@endphp

@section('content')
    <div class="categories-section">
        <!-- Header -->
        <div class="categories-header">
            <div>
                <h2 class="categories-title">Categories</h2>
                <p class="categories-subtitle">Here is a list of all categories</p>
            </div>
            <a href="{{ route('category.register') }}" class="add-category-btn"><span class="add-category-full">Add
                    Category</span><span class="add-category-short">Add</span></a>
        </div>

        <!-- Table -->
        <table class="categories-table">
            <thead class="categories-thead">
                <tr>
                    <!-- <th style="width: 40px;"></th> -->
                    <th class="sortable-header">
                        <!-- <span>CATEGORY</span> -->
                        <div class="sort-btn-group">
                            CATEGORY
                            <div class="sort-btn-group-tdown">
                                <button class="sort-btn" data-sort="name" data-dir="asc" aria-label="Sort A-Z">
                                    <i class="fa fa-caret-up" aria-hidden="true"></i>
                                </button>
                                <button class="sort-btn" data-sort="name" data-dir="desc" aria-label="Sort Z-A">
                                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                                </button>
                            </div>

                        </div>
                    </th>
                    <th class="sortable-header">
                        <!--  -->
                        <div class="sort-btn-group">
                            <span>DESCRIPTION</span>
                            <div class="sort-btn-group-tdown">
                                <button class="sort-btn" data-sort="description" data-dir="asc" aria-label="Sort A-Z">
                                    <i class="fa fa-caret-up" aria-hidden="true"></i>
                                </button>
                                <button class="sort-btn" data-sort="description" data-dir="desc" aria-label="Sort Z-A">
                                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </th>
                    <th style="width: 80px;">ACTION</th>
                </tr>
            </thead>
            <tbody class="all-data" id="all-data">
                @foreach($categories as $category)
                    <tr class="table-row" data-category-id="{{ $category->id }}">

                        <td class="table-cell" data-label="Category">
                            <div class="category-info">
                                @if($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                        class="category-img">
                                @else
                                    <div class="category-icon sofa">{{ strtoupper(substr($category->name, 0, 2)) }}</div>
                                @endif
                                <span class="category-name editable" data-field="name">
                                    {{ $category->name }}
                                    @if(isset($newCategoryId) && $category->id == $newCategoryId)
                                        <span class="new-badge">new</span>
                                    @endif
                                </span>
                            </div>
                        </td>
                        <td class="table-cell" data-label="Description">
                            <p class="category-description editable" data-field="description">{{ $category->description }}</p>
                        </td>
                        <td class="table-cell" data-label="Action">
                            <div class="action-menu">
                                <a href="{{ route('category.detail', $category->id) }}" class="action-btn" title="View Details">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach



            </tbody>
            <tbody id="Content" class="search-data"></tbody>
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
                    input.style.minHeight = '20px';
                } else {
                    input = document.createElement('input');
                    input.type = 'text';
                }
                input.value = oldValue.trim();
                input.className = 'inline-edit-input';
                element.innerHTML = '';
                element.appendChild(input);
                setTimeout(() => { input.focus(); input.select(); }, 0);
                input.addEventListener('blur', function () {
                    const newValue = input.value.trim();
                    if (newValue !== oldValue.trim()) {
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
                el.addEventListener('click', function (e) {
                    e.stopPropagation();
                    makeEditable(el, 'input');
                });
            });
            document.querySelectorAll('.category-description.editable').forEach(el => {
                el.addEventListener('click', function (e) {
                    e.stopPropagation();
                    makeEditable(el, 'textarea');
                });
            });
            // Sorting
            document.querySelectorAll('.sort-btn').forEach(btn => {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    const sortField = btn.getAttribute('data-sort');
                    const dir = btn.getAttribute('data-dir');
                    // Redirect with sort params (or use AJAX)
                    const url = new URL(window.location.href);
                    url.searchParams.set('sort', sortField);
                    url.searchParams.set('dir', dir);
                    window.location.href = url.toString();
                });
            });
        });

        //search


        $('#searchInput').on('input', function () {
            $value = $(this).val();

            if ($value) {
                $('#all-data').css('display', 'none');
                $('#Content').css('display', 'table-row-group');
            } else {
                $('#all-data').css('display', 'table-row-group');
                $('#Content').css('display', 'none');
            }
            $.ajax({
                type: 'GET',
                url: '{{ URL::to('search') }}',
                data: {
                    'search': $value,
                    'type': 'categories'
                },
                success: function (data) {
                    console.log(data);
                    $('#Content').html(data.html);
                },
            });
        })

    </script>
@endpush