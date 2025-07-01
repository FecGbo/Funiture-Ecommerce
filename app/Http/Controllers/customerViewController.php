<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class customerViewController extends Controller
{

    public function productView()
    {
        $products = Product::paginate(6);
        return view('customer.product', compact('products'));
    }
    public function customerSearch(Request $request)
    {
        $output = '';
        $search = $request->input('customer-search');
        $min = $request->input('min-price');
        $max = $request->input('max-price');

        $query = Product::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('description', 'LIKE', '%' . $search . '%')
                    ->orWhere('product_code', 'LIKE', '%' . $search . '%')
                    ->orWhere('sale_price', 'LIKE', '%' . $search . '%');
            });
        }
        if ($min !== null && $min !== '') {
            $query->where('sale_price', '>=', $min);
        }
        if ($max !== null && $max !== '') {
            $query->where('sale_price', '<=', $max);
        }

        $products = $query->get();

        $output .= '<div class="product-flex"><div class="products-container">';

        if ($products->isEmpty()) {
            $output .= '<div class="no-results">No products found.</div>';
        } else {
            foreach ($products as $product) {
                $output .= '
                <div class="product-card">
                    <div class="product-image">
                        <img src="' . asset('storage/' . $product->image) . '" alt="' . $product->name . '">
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">' . $product->name . '</h3>
                        <p class="product-description">' . $product->description . '</p>
                        <div class="product-price">MMK ' . number_format($product->sale_price, 2) . '</div>
                    </div>
                </div>';
            }
        }

        $output .= '</div></div>';

        return response()->json(['html' => $output]);
    }
}
