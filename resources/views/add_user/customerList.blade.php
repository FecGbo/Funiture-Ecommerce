@extends('layouts.admin')

@section('title', 'Category List')
<link rel="stylesheet" href="/css/add_user/list_users.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
@php
    $newUserId = session('new_user_id');
@endphp

@section('content')
    <div class="categories-section">
        <!-- Header -->
        <div class="categories-header">
            <div>
                <h2 class="categories-title">Customers</h2>
                <p class="categories-subtitle">Here is a list of all customers</p>
            </div>
            <a href="{{ route('user.register') }}" class="add-user-btn"><span class="add-user-full">Add
                    User</span><span class="add-user-short">Add</span></a>
        </div>

        <!-- Table -->

        <div class="table-container">
            <table class="categories-table">
                <thead class="categories-thead">
                    <tr>
                     
                        <th class="sortable-header">
                        
                            <div class="sort-btn-group">
                                CUSTOMER
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
                                <span>EMAIL</span>
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
                        <th class="sortable-header">
                            <!--  -->
                            <div class="sort-btn-group">
                                <span>ROLE</span>
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

                        <th class="sortable-header">
                      
                            <div class="sort-btn-group">
                                <span>ADDRESS</span>
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

                        <th class="sortable-header">
                            
                            <div class="sort-btn-group">
                                <span>PHONE</span>
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

                        <th>
                            
                            <div class="sort-btn-group">
                                <span>LAST LOGIN</span>
                                <div class="sort-btn-group-tdown">
                                    <button class="sort-btn" data-sort="dob" data-dir="asc" aria-label="Sort A-Z">
                                        <i class="fa fa-caret-up" aria-hidden="true"></i>
                                    </button>
                                    <button class="sort-btn" data-sort="dob" data-dir="desc" aria-label="Sort Z-A">
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </th>



                    </tr>
                </thead>
                <tbody id="all-data">
                    @foreach($customers as $user)
                        <tr class="table-row" data-user-id="{{ $user->id }}" data-url="{{ route('user.detail', $user->id) }}">

                            <td class="table-cell" data-label="Category">
                                <div class="user-info">
                                    @if($user->image)
                                        <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}" class="user-img">
                                    @else
                                        <div class="user-icon sofa">{{ strtoupper(substr($user->name, 0, 2)) }}</div>
                                    @endif
                                    <span class="user-name editable" data-field="name">
                                        {{ $user->name }}
                                        @if(isset($newUserId) && $user->id == $newUserId)
                                            <span class="new-badge">new</span>
                                        @endif
                                    </span>
                                </div>
                            </td>

                            <td class="table-cell" data-label="Email">
                                <p class="user-email editable" data-field="email">{{ $user->email }}</p>
                            </td>
                            <td class="table-cell" data-label="Role">
                                <p class="user-role editable" data-field="role">{{ $user->role }}</p>
                            </td>
                            <td class="table-cell" data-label="Address">
                                <p class="user-address editable" data-field="address">{{ $user->address }}</p>
                            </td>
                            <td class="table-cell" data-label="Phone">
                                <p class="user-phone editable" data-field="phone">{{ $user->phone }}</p>
                            </td>

                            <td class="table-cell" data-label="Last Login">
                                <p class="user-last-login">{{ $user->last_login }}</p>
                            </td>
                     
                        </tr>
                    @endforeach
                </tbody>
                <tbody class="search-data" id="Content"></tbody>
            </table>
        </div>
        <div class="pagination-wrapper">
            {{ $customers->links() }}
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
                    input.style.minHeight = '20px';
                } else {
                    input = document.createElement('input');
                    input.type = 'text';
                    input.style.maxWidth = '100px';
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
                        const userId = row.getAttribute('data-user-id');
                        const field = element.getAttribute('data-field');
                        // Send AJAX request
                        fetch(`/users/${userId}/inline-update`, {
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
            document.querySelectorAll('.user-name.editable').forEach(el => {
                el.addEventListener('click', function (e) {
                    e.stopPropagation();
                    makeEditable(el, 'input');
                });
            });
            document.querySelectorAll('.user-email.editable').forEach(el => {
                el.addEventListener('click', function (e) {
                    e.stopPropagation();
                    makeEditable(el, 'input');
                });
            });
            document.querySelectorAll('.user-role.editable').forEach(el => {
                el.addEventListener('click', function (e) {
                    e.stopPropagation();
                    makeEditable(el, 'input');
                });
            });
            document.querySelectorAll('.user-address.editable').forEach(el => {
                el.addEventListener('click', function (e) {
                    e.stopPropagation();
                    makeEditable(el, 'input');
                });
            });
            document.querySelectorAll('.user-phone.editable').forEach(el => {
                el.addEventListener('click', function (e) {
                    e.stopPropagation();
                    makeEditable(el, 'input');
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
                    'type': 'customers'
                },
                success: function (data) {
                    console.log(data);
                    $('#Content').html(data.html);
                },
            });
        })
    </script>
@endpush