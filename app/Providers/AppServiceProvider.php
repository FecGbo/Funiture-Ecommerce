<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap(); // Use Bootstrap pagination views

        View::composer('layouts.customer', function ($view) {
        $ordersHistory = [];
        if (Auth::check()) {
            $ordersHistory = DB::table('orders')
                ->join('orders_details', 'orders.id', '=', 'orders_details.order_id')
                ->join('products', 'orders_details.product_id', '=', 'products.id')
                ->where('orders.customer_id', Auth::id())
                ->select(
                    'orders.*',
                    'products.name as product_name',
                    'products.image as product_image',
                    'orders_details.quantity',
                    'orders_details.price'
                )
                ->orderBy('orders.order_date', 'desc')
                ->get();
        }
        $view->with('ordersHistory', $ordersHistory);
    });
    }
}
