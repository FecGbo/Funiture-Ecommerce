<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use DB;
use Illuminate\Http\Request;
use Laravel\Pail\ValueObjects\Origin\Console;

class OrderController extends Controller
{
    //

    public function addOrders(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }



        DB::beginTransaction();
        try {
            $order = new Order();

            $order->customer_id = auth()->id();
            $order->order_date = now();
            $order->status = 'pending';
            $order->save();
            session(['order_id' => $order->id]);



            foreach ($cart as $item) {
                $product = Product::find($item['id']);
                if (!$product) {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Product not found.');
                }
                if ($product->stock < $item['quantity']) {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Insufficient stock for product: ' . $product->name);
                }
            }


            foreach ($cart as $item) {
                DB::table('orders_details')->insert([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'] * $item['quantity'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                Product::where('id', $item['id'])->decrement('stock', $item['quantity']);
            }


            DB::commit();


            return redirect()->route('customer.checkout')->with('success', 'Order placed! Please proceed to payment.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }







    }

    public function listOrders()
    {

        $orders = DB::table('orders_details')
            ->join('orders', 'orders_details.order_id', '=', 'orders.id')
            ->join('products', 'orders_details.product_id', '=', 'products.id')
            ->join('users', 'orders.customer_id', '=', 'users.id')
            ->select(
                'orders_details.*',
                'products.name as product_name',
                'products.image as product_image',
                'orders.order_date',
                'orders.status',
                'orders.id as order_id',
                'users.name as customer_name',
                'users.image as customer_image'
            )
            ->orderByDesc('orders.order_date')
            ->paginate(6);

        return view('orders.list', compact('orders'));
    }



}
