<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManageProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\OderController;
use App\Models\Categorie;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
// Route::get('/menu/search', [HomeController::class, 'menu'])->name('menu.search');

Route::get('/gallery', [HomeController::class, 'gallery'])->name("gallery");
//login
Route::get('/login', function () {
    return view('login.login'); 
})->name("login");

Route::get('/singup', function () {
    return view('login.singup');
})->name("singup");

//Dashboard
Route::get('/admin/mystore', [DashboardController::class, 'mystore'])->name("mystore");
Route::get('/admin', [DashboardController::class, 'index'])->name("dashboard");



Route::get('/admin/management/categories', [CategoriesController::class, 'index'])->name("categories");
Route::get('/admin/management/categories/create', [CategoriesController::class, 'create'])->name("categories.create");
Route::post('/admin/management/categories', [CategoriesController::class, 'store'])->name("categories.store");
Route::get('/admin/management/categories/{id}', [CategoriesController::class, 'destroy'])->name("categories.delete");
Route::get('/admin/management/categories/{category}/edit', [CategoriesController::class, 'edit'])->name('categories.edit');
Route::put('/admin/management/categories/{id}', [CategoriesController::class, 'update'])->name("categories.update");

Route::get('/admin/manegement/product', [ManageProductController::class,'index'])->name("manageProduct");
// Hiển thị form thêm sản phẩm
Route::get('/admin/management/product', [ManageProductController::class, 'create'])->name("createProduct");

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
Route::get('/profile', [UserController::class, 'profile'])->name('profile')->middleware('auth');
//update profile
Route::post('/profile/update/{id}', [UserController::class, 'updateProfile'])->name('profile.update')->middleware('auth');
//change password
Route::get('/changePassword', function(){
    return view('login.changePassword');
})->name('formChangePassword');
Route::post('/changePassword', [AccountController::class, 'changePassword'])->name('changePassword');
 
Route::post('/check-credentials', [AccountController::class, 'checkCredentials'])->name('check-credentials');

//cart
Route::get('/cart', [CartController::class, 'index'])->name("cart");
Route::post('/add', [HomeController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/cart/checkout/process', [CartController::class, 'saveorder'])->name('checkout.process');



//BLOG
Route::get('/blog', function () {
    return view('home.blog');
})->name("blog");
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/create', [BlogController::class, 'view_profile'])->name('create_blog')->middleware('auth');
//create blog
Route::post('/blog/add', [BlogController::class, 'create_blog'])->name('blog.add');
//show blog
Route::get('/blog/{id}', [BlogController::class, 'showBlog'])->name('blog.show');
// delete blog
Route::delete('/blog/{id}', [BlogController::class, 'deleteBlog'])->name('blogs.delete');
// edit blog
Route::put('/blog/{id}', [BlogController::class, 'updateContent'])->name('blog.updateContent');
// like blog
Route::post('/blog/toggle-like/{id}', [BlogController::class, 'toggleLike'])->name('blog.toggle-like');
// view blog
Route::get('/blog/view/{id}', [BlogController::class, 'incrementView'])->name('blog.view');
// comment blog
Route::post('/comments/{id_blog}', [BlogController::class, 'addComment']);
Route::get('/comments/{id_blog}', [BlogController::class, 'getComments']);
// edit comment
Route::put('/comments/{id}', [BlogController::class, 'updateComment'])->name('comments.update');
// delete comment
Route::delete('/comments/{id}', [BlogController::class, 'deleteComment'])->name('comments.delete');
// follow
Route::post('/user/toggle-follow/{id}', [UserController::class, 'toggleFollow'])->name('user.toggle-follow');

//oder
Route::get('/admin/order/{id}/confirm', [OderController::class, 'comfirm'])->name("order.comfirm");
Route::get('/admin/order', [OderController::class, 'index'])->name("dashboard.order");
Route::get('/order-history', [OderController::class, 'history'])->name('order.history');
Route::post('/order-history/{id}', [OderController::class, 'success'])->name("order.success");
Route::get('/order-history/{id}/cancel', [OderController::class, 'cancel'])->name("order.cancel");

//detail
Route::get('/menu/detail/{id}',[DetailController::class, 'index'])->name("detail");
Route::post('/menu/detail/add', [DetailController::class, 'add'])->name('detail.add');

