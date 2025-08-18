<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="content">
        <h1>Order History</h1>

        <div class="order-nav">
            <li>ALl Orders</li>
            <li>Completed</li>
        </div>




        <table class="order-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                        <td>MMK {{ number_format($order->total_amount) }}</td>
                        <td>{{ $order->status }}</td>
                    </tr>
                @endforeach
            </tbody>

    </div>
</body>
</html>
