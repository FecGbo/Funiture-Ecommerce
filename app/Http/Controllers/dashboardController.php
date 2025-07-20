<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    //

    public function dashboard()
    {
        $totalSales = DB::table('orders_details')
            ->sum('price');

        $totalOrders = DB::table('orders')
            ->where('status', 'approved')
            ->count();

        $totalSignups = DB::table('users')
            ->where('role', 'customer')
            ->count();

        $totalProfits = DB::table('orders_details')
            ->sum('price') - DB::table('products')
                ->sum('sale_price');


        $browserStats = DB::table('users')
            ->select('browser', DB::raw('count(*) as total'))
            ->whereNotNull('browser')
            ->groupBy('browser')
            ->get();


        $deviceStats = DB::table('users')
            ->select('device', DB::raw('count(*) as total'))
            ->whereNotNull('device')
            ->groupBy('device')
            ->get();


        $topProducts = DB::table(table: 'orders_details')
            ->join('products', 'orders_details.product_id', '=', 'products.id')
            ->select(
                'products.name',
                DB::raw('SUM(orders_details.quantity) as total_quantity')
            )
            ->groupBy('products.name')
            ->orderBy('total_quantity', 'desc')
            ->limit(4)
            ->get();

        return view('AdminWelcome', compact('totalSales', 'totalOrders', 'totalSignups', 'totalProfits', 'browserStats', 'deviceStats', 'topProducts'));

    }


    public function dynamicChart()
    {

        $salesData = DB::table('orders_details')
            ->join('orders', 'orders_details.order_id', '=', 'orders.id')
            ->select(
                DB::raw('DATE(orders.created_at) as date'),
                DB::raw('SUM(orders_details.price * orders_details.quantity) as total_sales')
            )
            ->where('orders.status', 'approved')
            ->groupBy(DB::raw('DATE(orders.created_at)'))
            ->orderBy('date')
            ->get();


        $invest = DB::table('orders_details')
            ->join('orders', 'orders_details.order_id', '=', 'orders.id')
            ->join('products', 'orders_details.product_id', '=', 'products.id')
            ->select(
                DB::raw('DATE(orders.created_at) as date'),
                DB::raw('SUM(products.purchase_price * orders_details.quantity) as total_investment')
            )
            ->where('orders.status', 'approved')
            ->groupBy(DB::raw('DATE(orders.created_at)'))
            ->orderBy('date')
            ->get();

        return response()->json([
            'sales' => $salesData,
            'investment' => $invest
        ]);

    }
    public function monthlyCustomerOrders()
    {
        $monthlyOrders = DB::table('orders')
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
                DB::raw("COUNT(*) as total")
            )
            ->where('status', 'approved')
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->orderBy('month', 'desc')
            ->limit(2) // show last 2 months 
            ->get();

        return response()->json($monthlyOrders);
    }



}
