<?php

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManageProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//home
// Route::get('/', function () {
//     return view('home.home');
// })->name('home');
Route::get('/', [HomeController::class, 'index'])->name("home");

Route::get('/about', [HomeController::class, 'about'])->name("about");

// Sử dụng MenuController để xử lý route menu
Route::get('/menu', [HomeController::class, 'menu'])->name("menu");

Route::get('/blog', function () {
    return view('home.blog');
})->name("blog");

Route::get('/gallery', [HomeController::class, 'gallery'])->name("gallery");
//login
Route::get('/login', function () {
    return view('login.login'); 
})->name("login");

Route::get('/singup', function () {
    return view('login.singup');
})->name("singup");
Route::get('/admin/manegement/product', [ManageProductController::class,'index'])->name("manageProduct");
// Hiển thị form thêm sản phẩm
Route::get('/admin/management/product/create', [ManageProductController::class, 'create'])->name("createProduct");

// Lưu sản phẩm mới
Route::post('/admin/management/product/store', [ManageProductController::class, 'store'])->name("storeProduct");

// Hiển thị form chỉnh sửa sản phẩm
Route::get('/admin/management/product/edit/{product}', [ManageProductController::class, 'edit'])->name("editProduct");

// Cập nhật sản phẩm
Route::put('/admin/management/product/{id}', [ManageProductController::class, 'update'])->name("updateProduct");

// Xóa sản phẩm
Route::delete('/admin/management/product/{product}', [ManageProductController::class, 'destroy'])->name("deleteProduct");

// signin and login
Route::post('/singup', [AccountController::class, 'signup']);
Route::post('/login', [AccountController::class, 'postLogin']);
//logout
Route::get('/logout', [AccountController::class, 'logout'])->name('logout');
//profile 
Route::get('/profile', [UserController::class, 'profile'])->name('profile')->middleware('auth');;

Route::post('/check-credentials', [AccountController::class, 'checkCredentials'])->name('check-credentials');