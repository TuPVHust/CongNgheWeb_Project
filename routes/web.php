<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLoginController;
use App\Http\Middleware\CheckAdminLogin;
use App\Http\Middleware\CheckOutCheck;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\proModelsController;
use App\Http\Controllers\ColorsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\ProductDetailsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\HomeController;
use App\Models\ProductDetail;
use App\Models\Product;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group whicha
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/login', [AdminLoginController::class,'getlogin'])->name('admin.getlogin');
Route::post('/admin/login', [AdminLoginController::class,'postlogin'])->name('admin.postlogin');
Route::get('/admin/logout', [AdminLoginController::class,'getlogout'])->name('admin.getlogout');


Route::prefix('admin')->name('admin.')->middleware([CheckAdminLogin::class])->group(function(){
    Route::get('/', [AdminLoginController::class, 'dashboard'])->name('dashboard');


    Route::resources([
        'category' => CategoriesController::class,
        'brand' => BrandsController::class,
        'model' => proModelsController::class,
        'color' => ColorsController::class,
        'order' => OrdersController::class,
        'order_detail' => OrderDetailsController::class,
        'product_detail' => ProductDetailsController::class,
        'product' => ProductsController::class
    ]);
    Route::resource('account', AccountsController::class)->only([
        'index', 'edit', 'update'
    ]);
    Route::get('/file', function () {
        return view('admin.file.index');
    })->name('file');

});
Route::get('/shop', function () {
    return view('site.shop',[
        'products' => ProductDetail::all(),
    ]);
})->name('shop');

Route::get('/shop-detail/{product_detail}', function ($product_detail) {
    $product = ProductDetail::find($product_detail);
    $products = ProductDetail::all();
    $images = json_decode($product->images, true);
    
    return view('site.shop-detail',[
        'product' => $product,
        'images' => $images,
        'products' => $products,
    ]);
})->name('shop-detail');
Auth::routes();
Route::get('/cart', function () {
    return view('site.cart');
})->name('cart');

Route::get('/search', [HomeController::class,'search'])->name('search');
Route::post('/placeOrder', [HomeController::class,'placeOrder'])->name('placeorder')->middleware('auth');

Route::get('/getCheckOut', [HomeController::class,'getCheckOut'])->middleware([CheckOutCheck::class])->name('checkout');
// Route::get('/shop-detail/{product_detail}', ProductDetailSection::class)->name('shop-detail');


