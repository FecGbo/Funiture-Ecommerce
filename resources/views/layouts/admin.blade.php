<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - @yield('title', 'Furniture E-Commerce')</title>
    <link rel="stylesheet" href="/css/global.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body class="admin-layout">
    <button id="admin-hamburger" class="admin-hamburger" aria-label="Toggle sidebar">
        <span></span>
        <span></span>
        <span></span>
    </button>
    <aside class="admin-sidebar">
        <div class="admin-logo">
            <img src="/images/logo.png" alt="" width="50" height="50">
        </div>
        <nav>
            <ul>
                <li>
                    <a href=" #">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Orders</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="fas fa-users"></i>
                        <span>Customers</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="fas fa-user"></i>
                        <span>Users</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="fas fa-list"></i>
                        <span>Categories</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="fas fa-box"></i>
                        <span>Products</span>
                    </a>
                </li>

            </ul>
        </nav>
        <div class="admin-card">
            <div class="admin-card-profile">
                <img src="https://ui-avatars.com/api/?name=Admin&background=0D8ABC&color=fff" alt="admin">
                <p>Furino Owner</p>
                <p>Mr.Kelvin</p>

            </div>


        </div>
    </aside>
    <main class="admin-main">
        <header class="admin-header">
            <h2>@yield('header', 'Dashboard')</h2>
            <div class="admin-header-right">
                <form class="admin-search-bar" action="#" method="get">
                    <button type="submit"><i class="fas fa-search"></i></button>
                    <input type="text" placeholder="Search here" name="search">

                </form>
                <div class="admin-profile">
                    <span>Admin</span>
                    <img src="https://ui-avatars.com/api/?name=Admin&background=0D8ABC&color=fff" alt="admin"
                        id="adminAvatar">

                    <ul class="admin-dropdown" id="adminDropdown" style="display:none;">
                        <li><a href="#">Profile</a></li>
                        <li><a href="#">Settings</a></li>
                        <li><a href="#">Logout</a></li>
                    </ul>

                </div>
            </div>
        </header>
        <div class="admin-content">
            @yield('content')
        </div>

    </main>
</body>

</html>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const hamburger = document.getElementById('admin-hamburger');
        const sidebar = document.querySelector('.admin-sidebar');
        hamburger.addEventListener('click', function () {
            sidebar.classList.toggle('sidebar-open');
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const avatar = document.getElementById('adminAvatar');
        const dropdown = document.getElementById('adminDropdown');
        avatar.addEventListener('click', function (e) {
            e.stopPropagation();
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });
        document.addEventListener('click', function () {
            dropdown.style.display = 'none';
        });
    });
</script>