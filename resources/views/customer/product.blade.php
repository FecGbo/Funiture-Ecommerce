@extends('layouts.customer')
<link rel="stylesheet" href="{{ asset('css/customer/product.css') }}">

@section('title', 'Product')
@section('content')
    <!-- Banner -->
    <div class="banner">
        <div class="banner-content">
            <h1>Product</h1>
            <div class="breadcrumb">
                <a href="">Home</a>
                <span>></span>
                <span>Product</span>
            </div>
        </div>
    </div>


    <div class="contact">
        <div class="container">
            <div class="title">
                <div class="title-left">
                    <img src="{{ asset('images/logo.png') }}" alt="Product Banner">
                    <span>Furniro</span>
                </div>

                <div class="title-right">
                    <div class="search-bar">
                        <input type="text" placeholder="Search for products...">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </div>
                    <div class="sort">
                        <span style="color: #ffd700;">Sort by</span>
                        <select name="sort" id="sort">
                            <option value="default">lower to higher</option>
                            <option value="price-asc">Price: Low to High</option>
                            <option value="price-desc">Price: High to Low</option>
                            <option value="newest">Newest</option>
                        </select>

                    </div>


                </div>


            </div>
            <div class="main-content-product">

                <div class="product-sidebar">
                    <div class="filter-section">
                        <h3>Searching Information</h3>
                    </div>

                    <div class="filter-section">
                        <h3>Price</h3>
                        <div class="price-range">
                            <div class="price-inputs">
                                <div class="price-input">
                                    <label>Min</label>
                                    <input type="number" placeholder="0" min="0">
                                </div>
                                <div class="price-input">
                                    <label>Max</label>
                                    <input type="number" placeholder="1000000" min="0">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="filter-section">
                        <h3>Filter</h3>
                        <h3>Furniture</h3>
                        <ul class="filter-options">

                            <li>
                                <label>
                                    <input type="checkbox" name="category" value="chair">
                                    Chair
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="category" value="sofa">
                                    Sofa
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="category" value="table">
                                    Table
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="category" value="lamp">
                                    Lamp
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>


                <div class="product-flex">
                    <div class="products-container">
                        <!-- Product Card 1 -->
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset('images/products/syltherine.jpg') }}" alt="Syltherine">
                            </div>
                            <div class="product-info">
                                <h3 class="product-name">Syltherine</h3>
                                <p class="product-description">Stylish cafe chair perfect for modern dining spaces</p>
                                <div class="product-price">MMK 2,500,000</div>

                            </div>
                        </div>

                        <!-- Product Card 2 -->
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset('images/products/lolito.jpg') }}" alt="Lolito">
                            </div>
                            <div class="product-info">
                                <h3 class="product-name">Lolito</h3>
                                <p class="product-description">Luxury big sofa for comfortable living room experience</p>
                                <div class="product-price">MMK 7,000,000</div>

                            </div>
                        </div>

                        <!-- Product Card 3 -->
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset('images/products/respira.jpg') }}" alt="Respira">
                            </div>
                            <div class="product-info">
                                <h3 class="product-name">Respira</h3>
                                <p class="product-description">Outdoor bar table and stool set for garden parties</p>
                                <div class="product-price">MMK 500,000</div>

                            </div>
                        </div>

                        <!-- Product Card 4 -->
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset('images/products/leviosa.jpg') }}" alt="Leviosa">
                            </div>
                            <div class="product-info">
                                <h3 class="product-name">Leviosa</h3>
                                <p class="product-description">Stylish cafe chair perfect for modern dining spaces</p>
                                <div class="product-price">MMK 2,500,000</div>

                            </div>
                        </div>

                        <!-- Product Card 5 -->
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset('images/products/lolito2.jpg') }}" alt="Lolito">
                            </div>
                            <div class="product-info">
                                <h3 class="product-name">Lolito</h3>
                                <p class="product-description">Luxury big sofa for comfortable living room experience</p>
                                <div class="product-price">MMK 7,000,000</div>

                            </div>
                        </div>

                        <!-- Product Card 6 -->
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset('images/products/respira2.jpg') }}" alt="Respira">
                            </div>
                            <div class="product-info">
                                <h3 class="product-name">Respira</h3>
                                <p class="product-description">Outdoor bar table and stool set for garden parties</p>
                                <div class="product-price">MMK 500,000</div>

                            </div>
                        </div>
                    </div>



                </div>

            </div>






        </div>
    </div>
@endsection