<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;


class CartController extends Controller
{
    //
    public function cartItems()
    {
        $cart = session()->get('cart', []);
        $subTotal = 0;

        $output = '<div class="cart-modal" style="display: block;">';
        $output .= '<div class="cart-content">';
        $output .= '<div class="cart-content-header">
            <h2>Shopping Cart</h2>
            <span style="cursor:pointer;float:right;font-size:24px;" onclick="document.querySelector(\'.cart-modal\').style.display=\'none\'">&times;</span>
        </div>
        <hr style="width:80%; margin: 0 auto;">';

        $output .= '<ul id="cartItems">';
        if (count($cart)) {
            foreach ($cart as $item) {
                $itemSubtotal = $item['price'] * $item['quantity'];
                $subTotal += $itemSubtotal;
                $output .= '<li class="cart_list">'
                    . '<div class="cart-left">'
                    . '<img src="' . asset('storage/' . $item['image']) . '" alt="' . $item['name'] . '" width="100%" height="100%" style="border-radius:4px;">'
                    . '</div>'
                    . '<div class="cart-center">'
                    . '<span>' . $item['name'] . '</span>'
                    . '<div class="card-price">'
                    . '<span>' . $item['quantity'] . '&nbsp;x&nbsp;</span>'
                    . '<span>MMK&nbsp;' . number_format($item['price']) . '</span>'
                    . '</div>'
                    . '</div>'
                    . '<div class="cart-right">'
                    . '<span class="remove-cart-items" data-id="' . $item['id'] . '" style="cursor:pointer;">&times;</span>'
                    . '</div>'
                    . '</li>';
            }
        } else {
            $output .= '<div class="no_cart_list">'
                . '<img src="' . asset('images/nocart.png') . '" alt="No items in cart">'
                . '<h2><strong>Your Cart is Empty</strong></h2>'
                . '</div>';
        }
        $output .= '</ul>';

        // Cart total
        $output .= '<div class="cart-total">';
        if (count($cart)) {
            $output .= '<span>Subtotal</span>'
                . '<strong>MMK.' . number_format($subTotal) . ' <span id="cartTotal"></span></strong>';
        } else {
            $output .= '<p style="text-align: center;">Add somethings to make happy.....!</p>';
        }
        $output .= '</div>';

        // Cart payment buttons
        $output .= '<div class="cart-payment">';

        if (count($cart)) {

            $output .= '<button id="checkoutBtn" class="btn" onclick="location.href=\'' . route('cart.list') . '\'" >PROCEED TO BAG</button>';
            $output .= '<button id="continueShoppingBtn" class="btn" onclick="location.href=\'' . route('customer.product') . '\'">CONTINUE SHOPPING</button>';
        } else {
            $output .= '<button id="continueShoppingBtn" class="btn" onclick="location.href=\'' . route('customer.product') . '\'">CONTINUE SHOPPING</button>';
        }

        $output .= '</div>';

        $output .= '</div></div>';

        return response()->json(['html' => $output]);
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);
        $itemId = $request->input('id');
        foreach ($cart as $key => $item) {
            if ($item['id'] == $itemId) {
                unset($cart[$key]);
                break;
            }
        }
        session()->put('cart', $cart);

        if (!request()->ajax()) {
            return redirect()->route('cart.list');
        }

        $cartCount = array_sum(array_column($cart, 'quantity'));
        return response()->json(['cart_count' => $cartCount]);

    }
    public function cartList()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('customer.product')->with('error', 'Your cart is empty.');
        }
        return view('customer.cart', compact('cart'));
    }


    //Built in form

    // public function payment()
    // {
    //     $cart = session()->get('cart', []);
    //     if (empty($cart)) {
    //         return redirect()->route('cart.list')->with('error', 'Your cart is empty.');
    //     }


    //     $mmkToUsd = 2100;

    //     $total = 0;
    //     foreach ($cart as $item) {
    //         $total += $item['price'] * $item['quantity'];
    //     }

    //     if (($total / $mmkToUsd) < 1) {
    //         return redirect()->route('cart.list')->with('error', 'Minimum order amount is $1.');
    //     }

    //     \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

    //     $cart = array_values($cart); // Ensure sequential keys

    //     $lineItems = array_map(function ($item) use ($mmkToUsd) {
    //         $usdPrice = $item['price'] / $mmkToUsd;
    //         return [
    //             'price_data' => [
    //                 'currency' => 'usd',
    //                 'product_data' => [
    //                     'name' => $item['name'],
    //                 ],
    //                 'unit_amount' => (int) round($usdPrice * 100), // USD in cents
    //             ],
    //             'quantity' => $item['quantity'],
    //         ];
    //     }, $cart);

    //     $session = \Stripe\Checkout\Session::create([
    //         'payment_method_types' => ['card'],
    //         'line_items' => $lineItems,
    //         'mode' => 'payment',
    //         'success_url' => route('cart.success'),
    //         'cancel_url' => route('cart.list'),
    //     ]);

    //     return redirect()->away($session->url);
    // }

    public function success()
    {



        session()->forget('cart');
        return view('customer.success');
    }



    public function processPayment(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        $cart = session()->get('cart', []);
        $mmkToUsd = 2100;
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        $usdAmount = round($total / $mmkToUsd, 2);

        try {
            \Stripe\Charge::create(params: [
                'amount' => $usdAmount * 100, // USD in cents
                'currency' => 'usd',
                'description' => auth()->user()->name . ' - Order Payment',
                'source' => $request->stripeToken,
            ]);

            $orderId = session('order_id');

            $order = Order::where('id', $orderId)
                ->where('status', 'pending')
                ->where('customer_id', auth()->id())
                ->first();


            if ($order) {
                $order->status = 'approved';
                $order->save();
                session()->forget('order_id');
            }

            session()->forget('cart');
            return redirect()->route('cart.success')->with('success', 'Payment successful!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function updateQuantity(Request $request)
    {
        $id = $request->input('product_id');

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $quantity = $request->input('quantity', 1);
            if ($quantity < 1) {
                $quantity = 1;
            }
            if ($quantity > 11) {
                $quantity = 10;
            }
            $cart[$id]['quantity'] = $quantity;
            session()->put('cart', $cart);


            $Total_price = 0;
            foreach ($cart as $item) {
                $Total_price += $item['price'] * $item['quantity'];
            }






            $output = '<div class="content-right">
            <div class="checkout">
                <div class="checkout-title">
                    <h1>Carts Total</h1>
                </div>';

            if (count($cart) > 0) {
                $output .= '<div class="cart-subtotal">';
                foreach ($cart as $item) {
                    $output .= '<p style="color:white">Subtotal: MMK ' . number_format($item['price'] * $item['quantity']) . '</p>';
                }
                $output .= '</div>
                <span class="total_price">Total: MMK ' . number_format($Total_price) . '</span>';
            }

            $output .= '<div class="checkout-button">
                <form action="' . route('customer.addOrders') . '" method="POST">
                    ' . csrf_field() . '
                    <button type="submit" class="checkoutbtn btn btn-success">Check Out</button>
                </form>
            </div>
        </div>
    </div>';

            return response()->json(['success' => true, 'html' => $output]);
        }
        return response()->json(['success' => false, 'message' => 'Item not found in cart.']);
    }


}
