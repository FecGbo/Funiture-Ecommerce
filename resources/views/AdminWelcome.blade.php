@extends('layouts.admin')
@section('title', 'Admin Dashboard')
<link rel="stylesheet" href="/css/admin/dashboard.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@section('content')

    <div class="chart-content">
        <div class="chart-left">
            <!-- total sale and  orders-->
            <div class="total-sale-order">
                <div class="total-sale-order-left">
                    <div class="sale-price">
                        <div class="sale-price-left">
                            <h3>1000000000</h3>
                            <span>Total Sales</span>
                            <div class="total-sale">
                                <span style="opacity: 0.6;">Total sales:1000000000</span>


                            </div>

                        </div>
                        <div class="sale-price-right">
                            <div class="sale-price-icon">
                                <img src="{{ asset('images/cart.png') }}" alt="">
                            </div>
                            <span style="opacity: 0.6;">USD</span>
                        </div>


                    </div>

                </div>
                <div class="total-sale-order-right">
                    <div class="sale-price">
                        <div class="sale-price-left">
                            <h3>1000000</h3>
                            <span>Total Orders</span>
                            <div class="total-sale">
                                <span style="opacity: 0.6;">Total orders:1000000</span>
                            </div>
                        </div>
                        <div class="sale-price-right">
                            <div class="sale-price-icon" style="background-color:#90a4ae;">
                                <img src="{{ asset('images/order.png') }}" alt="">
                            </div>
                            <span style="opacity: 0.6;">orders</span>
                        </div>

                    </div>


                </div>
            </div>
            <!-- monthly sale -->
            <div class="monthly-sale">
                <div class="monthly-sale-chart">
                    <div class="monthly-sale-title">
                        <h3>Monthly Sale</h3>
                        <span class="monthly-sale-subtitle">Last 6 months</span>
                    </div>
                    <canvas id="myChart"></canvas>
                    <div class="monthly-sale-detail">
                        <div class="monthly-sale-detail-left">
                            <div class="monthly-sale-icon">
                                <i class="fa-solid fa-bag-shopping" style="color:#4AB58E"></i>

                            </div>

                            <div class="monthly-sale-profit">
                                <span>Invest</span>
                                <span style="opacity: 0.6;">Monthly</span>



                            </div>


                        </div>

                        <div class="monthly-sale-detail-right">
                            <div class="monthly-sale-icon" style="background-color: #FFF4DE;">
                                <i class="fa-solid fa-ticket" style="color: #FFA800;"></i>

                            </div>


                            <div class="monthly-sale-profit">
                                <span>Invest</span>
                                <span style="opacity: 0.6;">Monthly</span>



                            </div>

                        </div>
                    </div>



                </div>


            </div>
            <!-- customer orders -->
            <div class="monthly-sale">
                <div class="monthly-sale-chart">
                    <div class="monthly-sale-title">
                        <h3>Monthly Sale</h3>
                        <span class="monthly-sale-subtitle">Last 6 months</span>
                    </div>

                    <canvas id="lineChart"></canvas>
                    <div class="monthly-sale-detail">
                        <div class="monthly-sale-detail-left">
                            <div class="monthly-order-img">
                                <img src="{{ asset('images/slider1.png') }}" alt="">
                            </div>

                            <div class="monthly-sale-profit">
                                <span style="opacity: 0.6;">Last Month</span>
                                <span>89</span>



                            </div>


                        </div>

                        <div class="monthly-sale-detail-right">
                            <div class="monthly-order-img">
                                <img src="{{ asset('images/slider2.png') }}" alt="">
                            </div>


                            <div class="monthly-sale-profit">
                                <span style="opacity: 0.6;">This Month</span>
                                <span>90</span>



                            </div>

                        </div>
                    </div>


                </div>

            </div>



        </div>

        <div class="chart-right">
            <!-- total sale and  orders-->
            <div class="total-sale-order">
                <div class="total-sale-order-left">
                    <div class="sale-price">
                        <div class="sale-price-left">
                            <h3>1000000000</h3>
                            <span>Total Profit</span>
                            <div class="total-sale">
                                <span style="opacity: 0.6;">Total profits:1000000000</span>


                            </div>

                        </div>
                        <div class="sale-price-right">
                            <div class="sale-price-icon" style="background-color: #8D6E63;">
                                <img src="{{ asset('images/profit.png') }}" alt="">
                            </div>
                            <span style="opacity: 0.6;">USD</span>
                        </div>


                    </div>

                </div>
                <div class="total-sale-order-right">
                    <div class="sale-price">
                        <div class="sale-price-left">
                            <h3>1000000</h3>
                            <span>Sign Up</span>
                            <div class="total-sale">
                                <span style="opacity: 0.6;">Total signup:1000000</span>
                            </div>
                        </div>
                        <div class="sale-price-right">
                            <div class="sale-price-icon" style="background-color:#009688;">
                                <img src="{{ asset('images/cup.png') }}" alt="">
                            </div>
                            <span style="opacity: 0.6;">accounts</span>
                        </div>

                    </div>


                </div>
            </div>

            <!-- browser type -->



            <div class="browser-type">
                <div class="browser-type-chart-left">
                    <div class="browser-type-title">
                        <h3>Browser Type</h3>
                        <span class="browser-type-subtitle">Last 6 months</span>
                    </div>
                    <canvas id="browserTypeChart"></canvas>
                </div>

                <div class="browser-type-chart-right">
                    <div class="browser-type-title">
                        <h3>Browser Type</h3>
                        <span class="browser-type-subtitle">Last 6 months</span>
                    </div>
                    <canvas id="mobileTypeChart"></canvas>


                </div>

            </div>


            <!-- popular products -->
            <div class="popular-product">
                <div class="popular-product-border">


                    <div class="popular-product-title">
                        <h3>Popular Products</h3>

                    </div>


                    <div class="top-product-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Popularity</th>
                                    <th>Sales</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Product 1</td>
                                    <td>
                                        <div class="popularity-bar">
                                            <div class="popularity-bar-inner" style="width: 80%"></div>
                                        </div>
                                    </td>
                                    <td>1000</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>






        </div>





        <script>
            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });


            //line
            const line = document.getElementById('lineChart');

            new Chart(line, {
                type: 'line',
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            //browser
            const browser = document.getElementById('browserTypeChart');

            new Chart(browser, {
                type: 'doughnut',
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            //mobile
            const mobile = document.getElementById('mobileTypeChart');

            new Chart(mobile, {
                type: 'doughnut',
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });







        </script>





@endsection