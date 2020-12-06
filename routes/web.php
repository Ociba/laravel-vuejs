<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', function () {
    return view('post');
});
Route::post('/student',[App\Http\Controllers\StudentController::class, 'save_student']);
Route::get('/all_students',[App\Http\Controllers\StudentController::class, 'all_students']);
Route::get('/edit_student/{id}',[App\Http\Controllers\StudentController::class, 'edit_student']);
Route::put('/update_student',[App\Http\Controllers\StudentController::class, 'update_student']);
Route::delete('/delete_student/{id}',[App\Http\Controllers\StudentController::class, 'delete_student']);
Route::get('/students', function () { return view('students');});

Route::get('/product', [App\Http\Controllers\ProductController::class, 'getProductPage'])->name('Product');
Route::post('/save_product', [App\Http\Controllers\ProductController::class, 'save_product'])->name('Product Form');
Route::get('/all_products', [App\Http\Controllers\ProductController::class, 'getProduct'])->name('Product Table');
Route::get('/edit_product/{id}', [App\Http\Controllers\ProductController::class, 'editProduct'])->name('Product Editing');
Route::put('/update_product', [App\Http\Controllers\ProductController::class, 'updateProduct']);
Route::delete('/delete_product/{id}', [App\Http\Controllers\ProductController::class, 'deleteProduct']);

Route::get('/breed', [App\Http\Controllers\BreedController::class, 'getBreedPage'])->name('Breed');
Route::post('/save-breed', [App\Http\Controllers\BreedController::class, 'createBreed'])->name('Breed Form');
Route::get('/get-breed', [App\Http\Controllers\BreedController::class, 'getBreed'])->name('Breed');
Route::get('/edit-breed/{id}', [App\Http\Controllers\BreedController::class, 'editBreed']);
Route::put('/update-breed', [App\Http\Controllers\BreedController::class, 'updateBreed'])->name('Breed');
Route::delete('/delete_breed/{id}', [App\Http\Controllers\BreedController::class, 'deleteBreed'])->name('Breed');


Route::get('/category', [App\Http\Controllers\CategoryController::class, 'getCategoryPage'])->name('Category');
Route::post('/save-category', [App\Http\Controllers\CategoryController::class, 'createCategory'])->name('Category Form');
Route::get('/get-category', [App\Http\Controllers\CategoryController::class, 'getCategory'])->name('Category');
Route::get('/edit-category/{id}', [App\Http\Controllers\CategoryController::class, 'editCategory']);
Route::put('/update-category', [App\Http\Controllers\CategoryController::class, 'updateCategory'])->name('Category');
Route::delete('/delete_category/{id}', [App\Http\Controllers\CategoryController::class, 'deleteCategory'])->name('Category');

Auth::routes(); 

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
