<?php

use App\Http\Controllers\customerViewController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Auth;



//Search
Route::get('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('admin.search');





// Auth
Route::get('/login', function () {
    return view('auth.loginForm');
})->name('login');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login')->with('success', 'Logged out successfully');
})->name('logout');

Route::get('/register', function () {
    return view('auth.registerForm');
})->name('register');

Route::post('/register-customer', [App\Http\Controllers\AuthController::class, 'customerRegister'])->name('auth.register');

Route::post('/auth', [App\Http\Controllers\AuthController::class, 'checkAuth'])->name('auth.login');




Route::middleware(['auth', 'admin'])->group(function () {
    // Admin-only routes

    Route::get('/admin-dashboard', function () {
        return view('AdminWelcome');
    })->name('admin.dashboard');


    // categories

    Route::get('/register-category', function () {
        return view('categories.register');
    })->name('category.register');

    Route::get('/list-categories', [CategoryController::class, 'listCategories'])->name('category.list');

    Route::post('/add-category', [CategoryController::class, 'addCategory'])->name('category.add');
    Route::post('/categories/{id}/inline-update', [CategoryController::class, 'inlineUpdate']);
    Route::get('/category/{id}/detail', [CategoryController::class, 'detail'])->name('category.detail');
    Route::put('/category/{id}/update', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{id}/delete', [CategoryController::class, 'delete'])->name('category.delete');



    // products
    Route::get('/register-product', [App\Http\Controllers\ProductController::class, 'CategoryDrop'])->name('product.register');
    Route::post('/add-product', [App\Http\Controllers\ProductController::class, 'addProduct'])->name('product.add');
    Route::get('/list-products', [App\Http\Controllers\ProductController::class, 'listProducts'])->name('product.list');

    Route::post('/products/{id}/inline-update', [App\Http\Controllers\ProductController::class, 'inlineUpdate']);
    Route::get('/admin/product/{id}/detail', [App\Http\Controllers\ProductController::class, 'detail'])->name('product.detail');
    Route::post('/product/{id}/update', [App\Http\Controllers\ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{id}/delete', [App\Http\Controllers\ProductController::class, 'delete'])->name('product.delete');

    //add user
    Route::get('/register-user', function () {
        return view('add_user.register');
    })->name('user.register');
    Route::get('/list-users', [App\Http\Controllers\AddUserController::class, 'listUsers'])->name('user.list');
    Route::post('/register-user', [App\Http\Controllers\AddUserController::class, 'addUser'])->name('user.register');
    Route::post('/users/{id}/inline-update', [App\Http\Controllers\AddUserController::class, 'inlineUpdate']);
    Route::get('/user/{id}/detail', [App\Http\Controllers\AddUserController::class, 'detail'])->name('user.detail');
    Route::post('/user/{id}/update', [App\Http\Controllers\AddUserController::class, 'update'])->name('user.update');

    Route::delete('/user/{id}/delete', [App\Http\Controllers\AddUserController::class, 'delete'])->name('user.delete');


    Route::get('/list-customers', [App\Http\Controllers\AddUserController::class, 'getCustomer'])->name('customer.list');


    //orders
    Route::get('/list-orders', [App\Http\Controllers\OrderController::class, 'listOrders'])->name('order.list');


});



Route::middleware(['auth', 'customer'])->group(function () {




    Route::get('/checkout', function () {
        return view('customer.checkout');
    })->name('customer.checkout');

    Route::post('/add-orders', [App\Http\Controllers\OrderController::class, 'addOrders'])->name('customer.addOrders');



});
Route::post('/cart/process-payment', [App\Http\Controllers\CartController::class, 'processPayment'])->name('cart.process-payment');





// customer view


// Route::get('/customer-dashboard', function () {
//     return view('welcome');
// })->name('welcome');

Route::get('/customer-content', function () {
    return view('customer.content');
})->name('customer.content');
Route::get('/customer-about', function () {
    return view('customer.about');
})->name('customer.about');

// Route::get('/customer-product', function () {
//     return view('customer.product');
// })->name('customer.product');




// customer view
Route::get('/customer-product', [App\Http\Controllers\customerViewController::class, 'productView'])->name('customer.product');
Route::get('/customer-search', [App\Http\Controllers\customerViewController::class, 'customerSearch'])->name('customer.search');

Route::post('/add-to-cart', [App\Http\Controllers\customerViewController::class, 'addToCart'])->name('cart.add');

Route::get('/product/{id}/detail', function ($id) {
    $product = Product::findOrFail($id);
    return view('customer.product_detail', compact('product'));
})->name('customerProduct.detail');

Route::get('/cart/items', [App\Http\Controllers\CartController::class, 'cartItems'])->name('cart.items');
Route::post('/cart/remove', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');

Route::get('/clear-cart', function () {
    session()->forget('cart');
    return 'Cart cleared!';
});

// Route::get('/cart', function () {
//     return view('customer.cart');
// })->name('customer.cart');

Route::get('/cart', [App\Http\Controllers\CartController::class, 'cartList'])->name('cart.list');


use App\Http\Controllers\CartController;



Route::get('/cart/payment', [CartController::class, 'payment'])->name('cart.payment');
Route::get('/cart/success', [CartController::class, 'success'])->name('cart.success');








//index page

Route::get('/', [customerViewController::class, 'latestFuniture'])->name('customer.latestFuniture');

Route::post('/cart-update-quantity', [CartController::class, 'updateQuantity'])->name('cart.update');