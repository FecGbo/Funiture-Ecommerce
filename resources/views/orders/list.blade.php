@extends('layouts.admin')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/order/list.css') }}">

@section('title', 'Order List')
@section('content')



    <div class="categories-section">
        <!-- header -->
        <div class="categories-header">
            <div>
                <h2 class="categories-title">Orders</h2>
                <p class="categories-subtitle">Here is a list of all orders</p>
            </div>
        </div>

        <div class="table-container">
            <table class="categories-table">
                <thead class="categories-thead">
                    <tr>
                        <th class="sortable-header">
                            <div class="sort-btn-group">
                                <span>ORDER ID</span>
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
                                <span>CUSTOMER</span>
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
                                <span>PRODUCT</span>
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
                                <span>QTY</span>
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
                                <span>TOTAL</span>
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
                        <th class="sortable-header">
                            <div class="sort-btn-group">
                                <span>DATE</span>
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
                                <span>STATUS</span>
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
                        <!-- <th style="width: 80px;">ACTION</th> -->
                    </tr>

                </thead>
                <tbody class="all-data" id="all-data">
                    @foreach ($orders as $order)
                        <tr class="table-row">

                            <td class="table-cell" data-label="Category">
                                <span>{{ $order->order_id }}</span>
                            </td>
                            <td class="table-cell" data-label="Image">
                                <div class="category-info">


                                    <img class="category-img" src="{{ asset('storage/' . $order->customer_image) }}" alt="">
                                    <span>{{ $order->customer_name }}</span>
                                </div>
                            </td>

                            <td class="table-cell" data-label="Product">
                                <div class="category-info">
                                    <img src="{{ asset('storage/' . $order->product_image) }}" alt="Product Image"
                                        class="category-img">

                                    <span>{{ $order->product_name }}</span>
                                </div>
                            </td>
                            <td class="table-cell" data-label="Quantity">
                                <span>{{ $order->quantity }}</span>
                            </td>
                            <td class="table-cell" data-label="Price">
                                <span>{{ $order->price }}</span>
                            </td>
                            <td class="table-cell" data-label="Date">
                                <span>{{ $order->order_date }}</span>
                            </td>
                            <td class="table-cell" data-label="Status">
                                <span>{{ $order->status }}</span>
                            </td>
                        </tr>


                    @endforeach
                </tbody>
                <tbody id="Content" class="search-data"></tbody>

            </table>
        </div>
        <div class="pagination-wrapper">
            {{ $orders->links() }}
        </div>
    </div>

@endsection
@push('scripts')
    <script>



        $('#searchInput').on('input', function () {
            let $value = $(this).val();
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
                    'type': 'orders'
                },
                success: function (data) {
                    $('#Content').html(data.html);
                },
            });
        });
    </script>
@endpush