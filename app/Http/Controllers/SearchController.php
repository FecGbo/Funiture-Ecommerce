<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //

    public function search(Request $request)
    {
        $type = $request->input('type');
        $query = $request->input('search');

        switch ($type) {
            case 'categories':
                $output = '';
                $results = Category::where('name', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('description', 'like', '%' . $request->input('search') . '%')
                    ->get();
                foreach ($results as $category) {
                    $output .= '<tr class="table-row" data-category-id="' . $category->id . '" data-url="' . route('category.detail', $category->id) . '">';

                    $output .= '<td class="table-cell" data-label="Category"><div class="category-info">';

                    if ($category->image) {
                        $output .= '<img src="' . asset('storage/' . $category->image) . '" alt="' . e($category->name) . '" class="category-img">';
                    } else {
                        $output .= '<div class="category-icon sofa">' . strtoupper(substr($category->name, 0, 2)) . '</div>';
                    }
                    $output .= '<span class="category-name editable" data-field="name">' . e($category->name) . '</span>';
                    $output .= '</div></td>';
                    $output .= '<td class="table-cell" data-label="Description"><p class="category-description editable" data-field="description">' . e($category->description) . '</p></td>';
                    $output .= '<td class="table-cell" data-label="Action"><div class="action-menu">';

                    $output .= '</div></td>';


                    $output .= '</tr>';
                }
                return response()->json(['html' => $output]);

            case 'products':
                $search = $request->input('search');
                $results = Product::where('name', 'like', "%$search%")
                    ->orWhere('product_code', 'like', "%$search%")
                    ->orWhere('stock', 'like', "%$search%")
                    ->orWhere('purchase_price', 'like', "%$search%")
                    ->orWhere('sale_price', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%")
                    ->get();

                $output = '';
                foreach ($results as $product) {
                    $output .= '<tr class="table-row" data-category-id="' . ($product->category->id ?? '') . '" data-product-id="' . $product->id . '" data-url="' . route('product.detail', $product->id) . '">';
                    // Category column
                    $output .= '<td class="table-cell" data-label="Category"><div class="category-info">';
                    if ($product->category && $product->category->image) {
                        $output .= '<img src="' . asset('storage/' . $product->category->image) . '" alt="' . e($product->category->name) . '" class="category-img">';
                    } else {
                        $output .= '<div class="category-icon sofa">' . strtoupper(substr($product->category->name ?? 'NA', 0, 2)) . '</div>';
                    }
                    $output .= '<span class="category-name">' . ($product->category->name ?? 'No Category') . '</span>';
                    $output .= '</div></td>';
                    // Product column
                    $output .= '<td class="table-cell" data-label="Product"><div class="category-info">';
                    if ($product->image) {
                        $output .= '<img src="' . asset('storage/' . $product->image) . '" alt="' . e($product->name) . '" class="category-img">';
                    } else {
                        $output .= '<div class="category-icon sofa">' . strtoupper(substr($product->name, 0, 2)) . '</div>';
                    }
                    $output .= '<span class="product-name editable" data-field="name">' . e($product->name) . '</span>';
                    $output .= '</div></td>';
                    // Purchase Price
                    $output .= '<td class="table-cell" data-label="Purchase Price"><span class="purchase-price editable" data-field="purchase_price">' . e($product->purchase_price) . '</span>&nbsp;MMK</td>';
                    // Sale Price
                    $output .= '<td class="table-cell" data-label="Sale Price"><span class="sale-price editable" data-field="sale_price">' . e($product->sale_price) . '</span>&nbsp;MMK</td>';
                    // Stock
                    $output .= '<td class="table-cell" data-label="Stock"><span class="stock editable" data-field="stock">' . e($product->stock) . '</span></td>';
                    // Action
                    $output .= '<td class="table-cell" data-label="Action"><div class="action-menu">';

                    $output .= '</div></td>';
                    $output .= '</tr>';
                }
                return response()->json(['html' => $output]);



            case 'users':
                $search = $request->input('search');
                $results = \App\Models\User::where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('role', 'like', "%$search%")
                    ->orWhere('address', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%")
                    ->get();
                $output = '';
                foreach ($results as $user) {
                    $output .= '<tr class="table-row" data-user-id="' . $user->id . '">';
                    $output .= '<td class="table-cell" data-label="Category">';
                    $output .= '<div class="user-info">';
                    if ($user->image) {
                        $output .= '<img src="' . asset('storage/' . $user->image) . '" alt="' . e($user->name) . '" class="user-img" data-url="' . route('user.detail', $user->id) . '">';
                    } else {
                        $output .= '<div class="user-icon sofa">' . strtoupper(substr($user->name, 0, 2)) . '</div>';
                    }
                    $output .= '<span class="user-name editable" data-field="name">' . e($user->name) . '</span>';
                    $output .= '</div></td>';
                    $output .= '<td class="table-cell" data-label="Email"><p class="user-email editable" data-field="email">' . e($user->email) . '</p></td>';
                    $output .= '<td class="table-cell" data-label="Role"><p class="user-role editable" data-field="role">' . e($user->role) . '</p></td>';
                    $output .= '<td class="table-cell" data-label="Address"><p class="user-address editable" data-field="address">' . e($user->address) . '</p></td>';
                    $output .= '<td class="table-cell" data-label="Phone"><p class="user-phone editable" data-field="phone">' . e($user->phone) . '</p></td>';
                    $output .= '<td class="table-cell" data-label="Action"><div class="action-menu">';

                    $output .= '</div></td>';
                    $output .= '</tr>';
                }
                if ($output === '') {
                    $output = '<tr><td colspan="6" style="text-align:center;color:#888;">No results found.</td></tr>';
                }
                return response()->json(['html' => $output]);


            case 'customers':
                $search = $request->input('search');
                $results = \App\Models\User::where('role', 'customer')
                    ->where(function ($q) use ($search) {
                        $q->where('name', 'like', "%$search%")
                            ->orWhere('email', 'like', "%$search%")
                            ->orWhere('role', 'like', "%$search%")
                            ->orWhere('address', 'like', "%$search%")
                            ->orWhere('phone', 'like', "%$search%")
                        ;
                    })
                    ->get();
                $output = '';
                foreach ($results as $user) {
                    $output .= '<tr class="table-row" data-user-id="' . $user->id . '" data-url="' . route('user.detail', $user->id) . '">';
                    $output .= '<td class="table-cell" data-label="Category">';
                    $output .= '<div class="user-info">';
                    if ($user->image) {
                        $output .= '<img src="' . asset('storage/' . $user->image) . '" alt="' . e($user->name) . '" class="user-img">';
                    } else {
                        $output .= '<div class="user-icon sofa">' . strtoupper(substr($user->name, 0, 2)) . '</div>';
                    }
                    $output .= '<span class="user-name editable" data-field="name">' . e($user->name) . '</span>';
                    $output .= '</div></td>';
                    $output .= '<td class="table-cell" data-label="Email"><p class="user-email editable" data-field="email">' . e($user->email) . '</p></td>';
                    $output .= '<td class="table-cell" data-label="Role"><p class="user-role editable" data-field="role">' . e($user->role) . '</p></td>';
                    $output .= '<td class="table-cell" data-label="Address"><p class="user-address editable" data-field="address">' . e($user->address) . '</p></td>';
                    $output .= '<td class="table-cell" data-label="Phone"><p class="user-phone editable" data-field="phone">' . e($user->phone) . '</p></td>';
                    $output .= '<td class="table-cell" data-label="Action"><div class="action-menu">';

                    $output .= '</div></td>';
                    $output .= '</tr>';
                }
                if ($output === '') {
                    $output = '<tr><td colspan="6" style="text-align:center;color:#888;">No results found.</td></tr>';
                }
                return response()->json(['html' => $output]);

            case 'orders':
                $search = $request->input('search');
                $results = \DB::table('orders_details')
                    ->join('orders', 'orders_details.order_id', '=', 'orders.id')
                    ->join('products', 'orders_details.product_id', '=', 'products.id')
                    ->join('users', 'orders.customer_id', '=', 'users.id')
                    ->where(function ($q) use ($search) {
                        $q->where('orders.id', 'like', "%$search%")
                            ->orWhere('users.name', 'like', "%$search%")
                            ->orWhere('products.name', 'like', "%$search%")
                            ->orWhere('orders.status', 'like', "%$search%")
                            ->orWhere('orders.order_date', 'like', "%$search%");
                    })
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
                    ->get();

                $output = '';
                foreach ($results as $order) {
                    $output .= '<tr class="table-row">';
                    $output .= '<td class="table-cell" data-label="Category"><span>' . $order->order_id . '</span></td>';
                    $output .= '<td class="table-cell" data-label="Customer"><div class="category-info">';
                    $output .= '<img class="category-img" src="' . asset('storage/' . $order->customer_image) . '" alt="">';
                    $output .= '<span>' . e($order->customer_name) . '</span>';
                    $output .= '</div></td>';
                    $output .= '<td class="table-cell" data-label="Product"><div class="category-info">';
                    $output .= '<img src="' . asset('storage/' . $order->product_image) . '" alt="Product Image" class="category-img">';
                    $output .= '<span>' . e($order->product_name) . '</span>';
                    $output .= '</div></td>';
                    $output .= '<td class="table-cell" data-label="Quantity"><span>' . $order->quantity . '</span></td>';
                    $output .= '<td class="table-cell" data-label="Total"><span>' . number_format($order->price * $order->quantity) . '</span></td>';
                    $output .= '<td class="table-cell" data-label="Date"><span>' . $order->order_date . '</span></td>';
                    $output .= '<td class="table-cell" data-label="Status"><span>' . ucfirst($order->status) . '</span></td>';
                    $output .= '</tr>';
                }
                if ($output === '') {
                    $output = '<tr><td colspan="7" style="text-align:center;color:#888;">No results found.</td></tr>';
                }
                return response()->json(['html' => $output]);

            default:
                return response()->json(['html' => '']);
        }
    }
}
