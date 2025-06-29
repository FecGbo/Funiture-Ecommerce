<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

//Search



Route::get('/admin-dashboard', function () {
    return view('layouts.admin');
})->name('admin.dashboard');


Route::get('/register-category', function () {
    return view('categories.register');
})->name('category.register');
 
// categories
Route::get('/list-categories', [CategoryController::class, 'listCategories'])->name('category.list');

Route::post('/add-category', [CategoryController::class, 'addCategory'])->name('category.add');
Route::post('/categories/{id}/inline-update', [CategoryController::class, 'inlineUpdate']);
Route::get('/category/{id}/detail', [CategoryController::class, 'detail'])->name('category.detail');
Route::put('/category/{id}/update', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/{id}/delete', [CategoryController::class, 'delete'])->name('category.delete');
Route::get('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('admin.search');


// products
Route::get('/register-product', [App\Http\Controllers\ProductController::class, 'CategoryDrop'])->name('product.register');
Route::post('/add-product', [App\Http\Controllers\ProductController::class, 'addProduct'])->name('product.add');
Route::get('/list-products', [App\Http\Controllers\ProductController::class, 'listProducts'])->name('product.list');

Route::post('/products/{id}/inline-update', [App\Http\Controllers\ProductController::class, 'inlineUpdate']);
Route::get('/product/{id}/detail', [App\Http\Controllers\ProductController::class, 'detail'])->name('product.detail');
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