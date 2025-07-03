<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function cartItems()
    {
        $cart = session()->get('cart', []);

        $output = '<ul id="cartItems">';
        if (count($cart)) {
            foreach ($cart as $item) {
                $output .= '<li>'
                    . '<img src="' . asset('storage/' . $item['image']) . '" alt="' . $item['name'] . '" width="40" height="40" style="border-radius:4px;">'
                    . '<span>' . $item['name'] . '</span>'
                    . '<span>x' . $item['quantity'] . '</span>'
                    . '<span>MMK ' . number_format($item['price']) . '</span>'
                    . '</li>';
            }
        } else {
            $output .= '<li>Your cart is empty.</li>';
        }
        $output .= '</ul>';

        return response()->json(['html' => $output]);
    }
}
