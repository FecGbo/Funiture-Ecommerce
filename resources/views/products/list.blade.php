@extends('layouts.admin')
<link rel="stylesheet" href="/css/product/list_products.css">
@section('title', 'Category List')

<meta name="csrf-token" content="{{ csrf_token() }}">
@php
    $newProductId = session('new_product_id');
@endphp
@section('content')
    <div class="categories-section">
        <!-- Header -->
        <div class="categories-header">
            <div>
                <h2 class="categories-title">Products</h2>
                <p class="categories-subtitle">Here is a list of all products</p>
            </div>
            <a href="{{ route('product.register') }}" class="add-category-btn"><span class="add-category-full">Add
                    Product</span><span class="add-category-short">Add</span></a>
        </div>

        <!-- Table with Scrollable Container -->
        <div class="table-container">
            <table class="categories-table">
                <thead class="categories-thead">
                    <tr>
                        <th class="sortable-header"><span>CATEGORY</span></th>
                        <th class="sortable-header">
                            <div class="sort-btn-group">
                                <span>PRODUCT</span>
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
                            <div class="sort-btn-group">
                                <span>PURCHASE PRICE</span>
                                <div class="sort-btn-group-tdown">
                                    <button class="sort-btn" data-sort="purchase_price" data-dir="asc"
                                        aria-label="Sort Low-High">
                                        <i class="fa fa-caret-up" aria-hidden="true"></i>
                                    </button>
                                    <button class="sort-btn" data-sort="purchase_price" data-dir="desc"
                                        aria-label="Sort High-Low">
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </th>
                        <th class="sortable-header">
                            <div class="sort-btn-group">
                                <span>SALE PRICE</span>
                                <div class="sort-btn-group-tdown">
                                    <button class="sort-btn" data-sort="sale_price" data-dir="asc"
                                        aria-label="Sort Low-High">
                                        <i class="fa fa-caret-up" aria-hidden="true"></i>
                                    </button>
                                    <button class="sort-btn" data-sort="sale_price" data-dir="desc"
                                        aria-label="Sort High-Low">
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </th>
                        <th class="sortable-header">
                            <div class="sort-btn-group">
                                <span>STOCK</span>
                                <div class="sort-btn-group-tdown">
                                    <button class="sort-btn" data-sort="stock" data-dir="asc" aria-label="Sort Low-High">
                                        <i class="fa fa-caret-up" aria-hidden="true"></i>
                                    </button>
                                    <button class="sort-btn" data-sort="stock" data-dir="desc" aria-label="Sort High-Low">
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </th>
                        <!-- <th style="width: 80px;">ACTION</th> -->
                    </tr>
                </thead>
                <tbody class="all-data" id="all-data">
                    @foreach($products as $product)
                        <tr class="table-row" data-category-id="{{ $product->category->id ?? '' }}"
                            data-product-id="{{ $product->id }}"
                            data-url="{{ route('product.detail', $product->id) }}">
                            <td class="table-cell" data-label="Category">
                                <div class="category-info">
                                    @if($product->category && $product->category->image)
                                        <img src="{{ asset('storage/' . $product->category->image) }}"
                                            alt="{{ $product->category->name }}" class="category-img">
                                    @else
                                        <div class="category-icon sofa">
                                            {{ strtoupper(substr($product->category->name ?? 'NA', 0, 2)) }}</div>
                                    @endif
                                    <span class="category-name">
                                        {{ $product->category->name ?? 'No Category' }}
                                    </span>
                                </div>
                            </td>
                            <td class="table-cell" data-label="Product">
                                <div class="category-info">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                            class="category-img">
                                    @else
                                        <div class="category-icon sofa">{{ strtoupper(substr($product->name, 0, 2)) }}</div>
                                    @endif
                                    <span class="product-name editable" data-field="name">
                                        {{ $product->name }}
                                        @if(isset($newProductId) && $product->id == $newProductId)
                                            <span class="new-badge">new</span>
                                        @endif
                                    </span>
                                </div>
                            </td>
                            <td class="table-cell" data-label="Purchase Price">
                                <span class="purchase-price editable"
                                    data-field="purchase_price">{{ $product->purchase_price }}</span>MMK
                            </td>
                            <td class="table-cell" data-label="Sale Price">
                                <span class="sale-price editable" data-field="sale_price">{{ $product->sale_price }}</span>MMK
                            </td>
                            <td class="table-cell" data-label="Stock">
                                <span class="stock editable" data-field="stock">{{ $product->stock }}</span>
                            </td>
                            <!-- <td class="table-cell" data-label="Action">
                                <div class="action-menu">
                                    <a href="" class="action-btn"
                                        title="View Details">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </div>
                            </td> -->
                        </tr>
                    @endforeach
                </tbody>
                <tbody id="Content" class="search-data"></tbody>
            </table>
        </div>
        <div class="pagination-wrapper">
            {{ $products->links() }}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            document.querySelectorAll('.table-row').forEach(row => {
                row.addEventListener('click', function (e) {

                    if (e.target.closest('.editable')) return;
                    window.location.href = row.getAttribute('data-url');
                });
            });
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
                    input.style.maxWidth = '100px';


                }
                input.value = oldValue.trim();
                input.className = 'inline-edit-input';
                element.innerHTML = '';
                element.appendChild(input);
                input.focus();
                // input.select();
                setTimeout(() => { input.focus(); input.select(); }, 0);
                input.addEventListener('blur', function () {
                    const newValue = input.value.trim();
                    if (newValue !== oldValue.trim()) {
                        const row = element.closest('.table-row');
                        let id = row.getAttribute('data-category-id');
                        const isProductPage = window.location.pathname.includes('list-products');
                        if (isProductPage) {
                            id = row.getAttribute('data-product-id') || id;
                        }
                        const field = element.getAttribute('data-field');
                        // Send AJAX request
                        fetch(`${isProductPage ? '/products' : '/categories'}/${id}/inline-update`, {
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
            document.querySelectorAll('.product-name.editable').forEach(el => {
                el.addEventListener('click', function (e) {
                    e.stopPropagation();
                    makeEditable(el, 'input');
                });
            });
            document.querySelectorAll('.purchase-price.editable').forEach(el => {
                el.addEventListener('click', function (e) {
                    e.stopImmediatePropagation();
                    makeEditable(el, 'input');
                });
            });
            document.querySelectorAll('.sale-price.editable').forEach(el => {
                el.addEventListener('click', function (e) {
                    e.stopImmediatePropagation();
                    makeEditable(el, 'input');
                });
            });
            document.querySelectorAll('.stock.editable').forEach(el => {
                el.addEventListener('click', function (e) {
                    e.stopImmediatePropagation();
                    makeEditable(el, 'input');
                });
            });
            document.querySelectorAll('.category-description').forEach(el => {
                if (el.classList.contains('editable')) {
                    el.addEventListener('click', function (e) {
                        e.stopImmediatePropagation();
                        makeEditable(el, 'textarea');
                    });
                }
            });
            
            // Sorting
            document.querySelectorAll('.sort-btn').forEach(btn => {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    const sortField = btn.getAttribute('data-sort');
                    const dir = btn.getAttribute('data-dir');
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
                    'type': 'products'
                },
                success: function (data) {
                    console.log(data);
                    $('#Content').html(data.html);
                },
            });
        })

    </script>
@endpush