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
            foreach ($cart as $item) {


                DB::table('orders_details')->insert([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'] * $item['quantity'],
                    'created_at' => now(),
                    'updated_at' => now(),

                ]);

                $product = new Product();
                $product = Product::find($item['id']);
                if ($product) {
                    if ($product->stock < $item['quantity']) {
                        DB::rollBack();
                        return redirect()->back()->with('error', 'Insufficient stock for product: ' . $product->name);
                    }
                    $product->stock -= $item['quantity'];
                    $product->save();
                }
            }


            DB::commit();


            return redirect()->route('customer.checkout');



        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while processing your order. Please try again.');
        }







    }



}
