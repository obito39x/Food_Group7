<?php

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManageProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AccountController;

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

Route::get('/about', function () {
    return view('home.about');
})->name("about");

// Sử dụng MenuController để xử lý route menu
Route::get('/menu', [MenuController::class, 'index'])->name("menu");

Route::get('/blog', function () {
    return view('home.blog');
})->name("blog");

Route::get('/gallery', [GalleryController::class, 'index'])->name("gallery");
//login
Route::get('/login', function () {
    return view('login.login'); 
})->name("login");

Route::get('/singup', function () {
    return view('login.singup');
})->name("singup");
Route::get('/admin/manegement/product', [ManageProductController::class,'index'])->name("manageProduct");

// signin and login
Route::post('/singup', [AccountController::class, 'signup']);
Route::post('/login', [AccountController::class, 'postLogin']);