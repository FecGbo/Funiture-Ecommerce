<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
                    . '<span>' . $item['quantity'] . ' x</span>'
                    . '<span>MMK ' . number_format($item['price']) . '</span>'
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
            
            $output .= '<button id="checkoutBtn" class="btn">PROCEED TO BAG</button>';
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
        $cartCount = array_sum(array_column($cart, 'quantity'));
        return response()->json(['cart_count' => $cartCount]);

    }
    public function cartList(){
        $cart=session()->get('cart', []);
    }
}
