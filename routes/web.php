<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin-dashboard', function () {
    return view('layouts.admin');
})->name('admin.dashboard');


Route::get('/register-category', function () {
    return view('categories.register');
})->name('category.register');
// Route::get('/list-categories', function () {
//     return view('categories.list');
// })->name('category.list');

Route::get('/list-categories', [CategoryController::class, 'listCategories'])->name('category.list');

Route::post('/add-category', [CategoryController::class, 'addCategory'])->name('category.add');
Route::post('/categories/{id}/inline-update', [CategoryController::class, 'inlineUpdate']);
Route::get('/category/{id}/detail', [CategoryController::class, 'detail'])->name('category.detail');
Route::put('/category/{id}/update', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/{id}/delete', [CategoryController::class, 'delete'])->name('category.delete');


