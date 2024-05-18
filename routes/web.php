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
use App\Http\Controllers\AuthController;
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





Route::prefix('/admin')->group(function () {
    Route::middleware('auth','role:admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name("dashboard");
        Route::get('/mystore', [DashboardController::class, 'mystore'])->name("mystore");

        // Category management routes
        Route::prefix('/management/categories')->name('categories.')->group(function () {
            Route::get('/', [CategoriesController::class, 'index'])->name("index");
            Route::get('/create', [CategoriesController::class, 'create'])->name("create");
            Route::post('/', [CategoriesController::class, 'store'])->name("store");
            Route::get('/{id}', [CategoriesController::class, 'destroy'])->name("delete");
            Route::get('/{category}/edit', [CategoriesController::class, 'edit'])->name('edit');
            Route::put('/{id}', [CategoriesController::class, 'update'])->name("update");
        });

        // Product management routes
        Route::prefix('/management/product')->name('products.')->group(function () {
            Route::get('/', [ManageProductController::class, 'index'])->name("index");
            Route::get('/{id}/toggle-hide', [ManageProductController::class, 'toggleHide'])->name('toggleHide');
            Route::get('/create', [ManageProductController::class, 'create'])->name("create");
            Route::post('/store', [ManageProductController::class, 'store'])->name("store");
            Route::get('/edit/{product}', [ManageProductController::class, 'edit'])->name("edit");
            Route::put('/{id}', [ManageProductController::class, 'update'])->name("update");
            Route::delete('/{product}', [ManageProductController::class, 'destroy'])->name("delete");
        });

    });
});

