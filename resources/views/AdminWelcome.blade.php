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
                            <h3>{{ $totalSales }}</h3>
                            <span>Total Sales</span>
                            <div class="total-sale">
                                <span style="opacity: 0.6;">Total sales:&nbsp;{{ $totalSales }}</span>


                            </div>

                        </div>
                        <div class="sale-price-right">
                            <div class="sale-price-icon">
                                <img src="{{ asset('images/cart.png') }}" alt="">
                            </div>
                            <span style="opacity: 0.6;">MMK</span>
                        </div>


                    </div>

                </div>
                <div class="total-sale-order-right">
                    <div class="sale-price">
                        <div class="sale-price-left">
                            <h3>{{ $totalOrders }}</h3>
                            <span>Total Orders</span>
                            <div class="total-sale">
                                <span style="opacity: 0.6;">Total orders: &nbsp;{{ $totalOrders }}</span>
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
                        <span class="monthly-sale-subtitle"></span>
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
                                <span>Profit</span>
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
                        <h3>Customer Orders</h3>
                        <span class="monthly-sale-subtitle"></span>
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
                            <h3>{{ $totalProfits }}</h3>
                            <span>Total Profit</span>
                            <div class="total-sale">
                                <span style="opacity: 0.6;">Total profits: &nbsp;{{ $totalProfits }}</span>


                            </div>

                        </div>
                        <div class="sale-price-right">
                            <div class="sale-price-icon" style="background-color: #8D6E63;">
                                <img src="{{ asset('images/profit.png') }}" alt="">
                            </div>
                            <span style="opacity: 0.6;">MMK</span>
                        </div>


                    </div>

                </div>
                <div class="total-sale-order-right">
                    <div class="sale-price">
                        <div class="sale-price-left">
                            <h3>{{ $totalSignups }}</h3>
                            <span>Sign Up</span>
                            <div class="total-sale">
                                <span style="opacity: 0.6;">Total signup:&nbsp;{{ $totalSignups }}</span>
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
                        <h5 style="margin-bottom: 0 !important;">Browser Visit</h5>
                        <span class="browser-type-subtitle">Total</span>
                    </div>
                    <div class="browser-ty-chart">
                        <canvas id="browserTypeChart"></canvas>
                    </div>

                </div>

                <div class="browser-type-chart-right">
                    <div class="browser-type-title">
                        <h5 style="margin-bottom: 0 !important;">Device Login</h5>
                        <span class="browser-type-subtitle">Total</span>
                    </div>
                    <div class="browser-ty-chart">
                        <canvas id="mobileTypeChart"></canvas>
                    </div>



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
                                @foreach ($topProducts as $product)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>
                                            <div class="popularity-bar">
                                                <div class="popularity-bar-inner"
                                                    style="width: {{ $product->total_quantity }}%"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="sales">
                                                {{ $product->total_quantity }}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                <!-- <tr>
                                                                                                                                                                                                                                                                <td>1</td>
                                                                                                                                                                                                                                                                <td>Product 1</td>
                                                                                                                                                                                                                                                                <td>
                                                                                                                                                                                                                                                                    <div class="popularity-bar">
                                                                                                                                                                                                                                                                        <div class="popularity-bar-inner" style="width: 80%"></div>
                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                </td>
                                                                                                                                                                                                                                                                <td>
                                                                                                                                                                                                                                                                    <div class="sales">
                                                                                                                                                                                                                                                                        100
                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                </td>
                                                                                                                                                                                                                                                            </tr> -->

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>






        </div>
        <!-- jessenger -->

    </div>



    <script>
        fetch('/daily-sales-chart')
            .then(response => response.json())
            .then(json => {
                const sales = json.investment || [];
                const investment = json.profit || [];


                if (!sales.length || !investment.length) {
                    console.error('No data available for charting');
                    return;
                }

                const investmentMap = {};
                investment.forEach(item => {
                    investmentMap[item.date] = item.total_investment;
                });

                const merged = sales.map(item => {
                    const invest = investmentMap[item.date] || 0;
                    const profit = (item.total_sales || 0) - invest;
                    return {
                        date: item.date,
                        sales: item.total_sales,
                        profit: profit,
                    };
                });

                const labels = merged.map(item => item.date);
                const salesData = merged.map(item => item.sales);
                const profitData = merged.map(item => item.profit);
                const isMobile = window.innerWidth <= 450;
                const fontSize = isMobile ? 10 : 14;

                const ctx = document.getElementById('myChart').getContext('2d');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Sales (MMK)',
                                data: salesData,
                                backgroundColor: '#4AB58E',
                                borderColor: '#4AB58E'
                            },
                            {
                                label: 'Profit (MMK)',
                                data: profitData,
                                backgroundColor: '#FFA800',
                                borderColor: '#FFA800'
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: !isMobile,
                                    text: 'Amount (MMK)',
                                    font: { size: fontSize }
                                },
                                ticks: {
                                    font: { size: fontSize },
                                    callback: function (value) {
                                        if (value >= 1000000) {
                                            return (value / 100000).toFixed(1) + ' Lakh';
                                        } else if (value >= 1000) {
                                            return (value / 1000).toFixed(1) + ' K';
                                        }
                                        return value;
                                    }
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Date',
                                    font: { size: fontSize }
                                },
                                ticks: {
                                    font: { size: fontSize }
                                }
                            }
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: 'Daily Sales and Profit',
                                font: { size: fontSize }
                            },
                            legend: {
                                display: true, // Enabled legend
                                position: 'top',
                                labels: {
                                    font: { size: fontSize }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        let label = context.dataset.label || '';
                                        let value = context.parsed.y;
                                        return `${label}: ${value.toLocaleString()} MMK`;
                                    }
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });

        fetch('/monthly-customer-orders')
            .then(res => res.json())
            .then(data => {

                data.reverse();
                const labels = data.map(item => item.month);  // ['July 2025', 'June 2025']
                const totals = data.map(item => item.total);  // [98, 123]

                const ctx = document.getElementById('lineChart').getContext('2d');
                const isMobile = window.innerWidth <= 450;
                const fontSize = isMobile ? 7 : 14;

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total Orders per Month',
                            data: totals,
                            backgroundColor: 'rgba(75, 192, 192, 0.5)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                            fill: true,
                            tension: 0.3,
                            pointBackgroundColor: totals.map((_, index) =>
                                index % 2 === 0 ? 'rgba(54, 162, 235, 1)' : 'rgba(51, 234, 97, 1)'
                            ), // Alternating colors for points
                            pointBorderColor: totals.map((_, index) =>
                                index % 2 === 0 ? 'rgba(54, 162, 235, 1)' : 'rgba(51, 234, 97, 1)'
                            ), // Border color for points
                            pointRadius: 5,        // Size of the points
                            pointBorderWidth: 2    // Border width of the points
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: !isMobile,
                                    text: 'Total Monthly Orders',

                                    font: {
                                        size: fontSize
                                    }
                                },
                                ticks: {
                                    font: {
                                        size: fontSize
                                    }
                                }


                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Month',
                                    font: {
                                        size: fontSize
                                    }
                                },
                                ticks: {
                                    font: { size: fontSize }
                                }
                            }
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: 'Monthly Orders',
                                font: {
                                    size: fontSize
                                }
                            },
                            legend: {
                                display: false,
                                font: {
                                    size: fontSize
                                }
                            }
                        }
                    }
                });
            })
            .catch(err => console.error('Chart error:', err));

        //browser type


        const browserLabels = @json($browserStats->pluck('browser'));
        const browserData = @json($browserStats->pluck('total'));

        const browser = document.getElementById('browserTypeChart');
        new Chart(browser, {
            type: 'doughnut',
            data: {
                labels: browserLabels,
                datasets: [{
                    label: 'Browser Usage',
                    data: browserData,
                    backgroundColor: [
                        '#4AB58E', '#FFA800', '#1976d2', '#e57373', '#FFD700', '#90a4ae'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: { display: true, position: 'bottom' }
                }
            }
        });




        //device type
        const deviceLabels = @json($deviceStats->pluck('device'));
        const deviceData = @json($deviceStats->pluck('total'));

        const ctx = document.getElementById('mobileTypeChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: deviceLabels,
                    datasets: [{
                        label: 'Device Usage',
                        data: deviceData,
                        backgroundColor: [
                            '#4AB58E', '#FFA800', '#1976d2', '#e57373'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        legend: { display: true, position: 'bottom' }
                    }
                }
            });
        }




    </script>





@endsection