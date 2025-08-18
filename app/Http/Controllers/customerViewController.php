<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use DB;
use Illuminate\Http\Request;

class CustomerViewController extends Controller
{

    public function productView(Request $request)
    {
        $categories = Category::all();
        $sortBy = $request->input('sort', 'id');
        $sortDir = $request->input('dir', 'asc');
        $allowedSorts = ['id', 'sale_price'];
        $allowedDirs = ['asc', 'desc'];

        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'id';
        }
        if (!in_array($sortDir, $allowedDirs)) {
            $sortDir = 'asc';
        }

        $products = Product::orderBy($sortBy, $sortDir)->paginate(6);

        if ($request->ajax()) {
            $output = '<div class="products-container" id="all-data">';
            foreach ($products as $product) {
                $output .= '
                <div class="product-card">
                    <a href="' . route('customerProduct.detail', $product->id) . '">
                        <div class="product-image">
                            <img src="' . asset('storage/' . $product->image) . '" alt="' . $product->name . '">
                        </div>
                        <div class="product-info">
                            <h3 class="product-name">' . $product->name . '</h3>
                            <p class="product-description">' . $product->description . '</p>
                            <div class="product-price">MMK ' . number_format($product->sale_price) . '</div>
                        </div>
                    </a>
                    <button class="addToCart-btn" data-product-id="' . $product->id . '">Add to Cart</button>
                </div>';
            }
            if ($products->isEmpty()) {
                $output .= '<div class="no-results">No products found.</div>';
            }
            $output .= '</div>';

            return response()->json(['html' => $output]);
        }

        return view('customer.product', compact('products', 'categories'));
    }
    public function customerSearch(Request $request)
    {


        $output = '';
        $search = $request->input('customer-search');
        $min = $request->input('min-price');
        $max = $request->input('max-price');
        $checkedCategories = $request->input('category', []);





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
        if (!empty($checkedCategories)) {
            $query->whereIn('category_id', $checkedCategories);
        }

        $products = $query->get();

        $output .= '<div class="product-flex"><div class="products-container">';

        if ($products->isEmpty()) {
            $output .= '<div class="no-results">No products found.</div>';
        } else {
            foreach ($products as $product) {
                $output .= '
                <div class="product-card">
                    <a href="' . route('customerProduct.detail', $product->id) . '">
                        <div class="product-image">
                            <img src="' . asset('storage/' . $product->image) . '" alt="' . $product->name . '">
                        </div>
                        <div class="product-info">
                            <h3 class="product-name">' . $product->name . '</h3>
                            <p class="product-description">' . $product->description . '</p>
                            <div class="product-price">MMK ' . number_format($product->sale_price, 2) . '</div>
                        </div>
                    </a>
                    <button class="addToCart-btn" data-product-id="' . $product->id . '">Add to Cart</button>
                </div>';
            }
        }

        $output .= '</div></div>';

        return response()->json(['html' => $output]);
    }


    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);
        $product = Product::find($productId);


        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
            if ($cart[$productId]['quantity'] > 10) {
                $cart[$productId]['quantity'] = 10;
            }
        } else {
            $cart[$productId] = [
                "id" => $product->id,
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->sale_price,
                "image" => $product->image,
                "stock" => $product->stock
            ];
        }
        session()->put('cart', $cart);
        $cartCount = 0;
        foreach ($cart as $item) {
            $cartCount += $item['quantity'];
        }
        if ($product->stock < $cart[$productId]['quantity']) {
            return response()->json(['message' => 'Insufficient stock for this product.', 'cart_count' => $cartCount]);
        }
        return response()
            ->json(['message' => 'success', 'cart_count' => $cartCount, 'cart_items' => $cart]);
    }

    public function latestFuniture()
    {
        $products = Product::orderBy('created_at', 'desc')->take(4)->get();


        $bestSelling = DB::table('orders_details')
            ->join('products', 'orders_details.product_id', '=', 'products.id')
            ->select(
                'products.id',
                'products.name',
                'products.image',
                'products.sale_price',
                'products.description',
                DB::raw('SUM(orders_details.quantity) as total_quantity')
            )
            ->groupBy(
                'products.id',
                'products.name',
                'products.image',
                'products.sale_price',
                'products.description'
            )
            ->orderByDesc('total_quantity')
            ->limit(8)
            ->get();


        return view('welcome', compact('products', 'bestSelling'));
    }




}
