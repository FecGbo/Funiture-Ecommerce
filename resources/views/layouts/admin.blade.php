<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - @yield('title', 'Furniture E-Commerce')</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body class="admin-layout">
    <aside class="admin-sidebar">
        <div class="admin-logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="50" height="50">
        </div>
        <nav>
            <ul>
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        <span class="sidebar-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="{{ request()->is('admin/orders*') ? 'active' : '' }}">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="sidebar-text">Orders</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('customer.list') }}"
                        class="{{ request()->routeIs('customer.list') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        <span class="sidebar-text">Customers</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.list') }}"
                        class="{{ request()->routeIs('user.list', 'user.register', 'user.detail') ? 'active' : '' }}">
                        <i class="fas fa-user"></i>
                        <span class="sidebar-text">Users</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('category.list') }}"
                        class="{{ request()->routeIs('category.list', 'category.register', 'category.detail') ? 'active' : '' }}">
                        <i class="fas fa-list"></i>
                        <span class="sidebar-text">Categories</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('product.list') }}"
                        class="{{ request()->routeIs('product.list', 'product.register', 'product.detail') ? 'active' : '' }}">
                        <i class="fas fa-box"></i>
                        <span class="sidebar-text">Products</span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="admin-card">
            <div class="admin-card-profile">
                <img src="https://ui-avatars.com/api/?name=Admin&background=0D8ABC&color=fff" alt="Admin">
                <p>Furino Owner</p>
                <p>Mr. Kelvin</p>
            </div>
        </div>
    </aside>

    <main class="admin-main">
        <header class="admin-header">
            <div class="admin-header-left">
                <button id="admin-hamburger" class="admin-hamburger" aria-label="Toggle sidebar" aria-expanded="false">
                    <i class="fas fa-bars"></i>
                </button>
                <h2>@yield('header', 'Dashboard')</h2>
            </div>
            <div class="admin-header-right">
                <form class="admin-search-bar" action="" method="get">
                    <button type="submit" aria-label="Search"><i class="fas fa-search"></i></button>
                    <input type="text" placeholder="Search here" name="search" aria-label="Search input"
                        id="searchInput">
                </form>
                <div class="admin-profile">
                    <span>Admin</span>
                    <img src="https://ui-avatars.com/api/?name=Admin&background=0D8ABC&color=fff" alt="Admin"
                        id="adminAvatar">
                    <ul class="admin-dropdown" id="adminDropdown">
                        <li><a href="#">Profile</a></li>
                        <li><a href="#">Settings</a></li>
                        <li><a href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>
        <div class="admin-content">
            @yield('content')
        </div>
        @stack('scripts')
    </main>

    <!-- Mobile overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const hamburger = document.getElementById('admin-hamburger');
            const sidebar = document.querySelector('.admin-sidebar');
            const main = document.querySelector('.admin-main');
            const avatar = document.getElementById('adminAvatar');
            const dropdown = document.getElementById('adminDropdown');
            // const overlay = document.getElementById('sidebarOverlay');
            const body = document.body;

            // Sidebar toggle
            hamburger.addEventListener('click', function () {
                const isOpen = sidebar.classList.contains('sidebar-open');

                if (isOpen) {
                    closeSidebar();
                } else {
                    openSidebar();
                }
            });

            // Overlay click to close sidebar

            // overlay.addEventListener('click', function () {
            //     closeSidebar();
            // });

            function openSidebar() {
                sidebar.classList.add('sidebar-open');
                // overlay.classList.add('active');
                hamburger.setAttribute('aria-expanded', 'true');

                // Prevent body scroll on mobile when sidebar is open
                if (window.innerWidth <= 767) {
                    body.classList.add('no-scroll');
                }
            }

            function closeSidebar() {
                sidebar.classList.remove('sidebar-open');
                // overlay.classList.remove('active');
                hamburger.setAttribute('aria-expanded', 'false');
                body.classList.remove('no-scroll');
            }

            // Profile dropdown
            avatar.addEventListener('click', function (e) {
                e.stopPropagation();
                dropdown.classList.toggle('active');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function (e) {
                if (!avatar.contains(e.target) && !dropdown.contains(e.target)) {
                    dropdown.classList.remove('active');
                }
            });

            // Handle window resize
            window.addEventListener('resize', function () {
                if (window.innerWidth > 767) {
                    body.classList.remove('no-scroll');
                    // overlay.classList.remove('active');
                }
            });


            // Close sidebar on escape key
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && sidebar.classList.contains('sidebar-open')) {
                    closeSidebar();
                }
            });
        });
    </script>
</body>

</html>