<?php

use App\Http\Controllers\Frontend\OnlinePayment;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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



Route::get('/test',[App\Http\Controllers\TestController::class,'test1']);
Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class,'index'])->name('home');
Route::get('/category_products/{id}',[App\Http\Controllers\Frontend\FrontendController::class,'ProductsCategory']);
Route::get('/productview/{product_id}',[App\Http\Controllers\Frontend\FrontendController::class,'productview']);
Route::get('/productsview',[App\Http\Controllers\Frontend\FrontendController::class,'products']);
Route::get('/tranding-products',[App\Http\Controllers\Frontend\FrontendController::class,'trandingproducts']);
Route::get('/offers',[App\Http\Controllers\Frontend\FrontendController::class,'viewoffers']);
Route::get('/search',[App\Http\Controllers\Frontend\FrontendController::class,'searchproducts'])->name('search');

Route::middleware('auth')->group(function(){
    Route::get('/wishlistview',[App\Http\Controllers\Frontend\WishlistController::class,'index']);
    Route::get('/payment-online-view',[App\Http\Controllers\Frontend\OnlinePayment::class,'PaymentFormView']);
    Route::post('/pay',[App\Http\Controllers\Frontend\OnlinePayment::class,'PayOrder']);
    Route::get('/cartview',[App\Http\Controllers\Frontend\CartController::class,'index']);
    Route::get('/checkout',[App\Http\Controllers\Frontend\CheckoutController::class,'index']);
    Route::get('/thank-you',[App\Http\Controllers\Frontend\FrontendController::class,'thankyou']);
    Route::get('/userprofile',[App\Http\Controllers\Frontend\UserController::class,'index']);
    Route::get('/userprofile/change-password/{user_id}',[App\Http\Controllers\Frontend\UserController::class,'ChangePassword']);
    Route::get('/userprofile/update-data/{user_id}',[App\Http\Controllers\Frontend\UserController::class,'UpdateData']);
    Route::get('/user-orders-view',[App\Http\Controllers\Frontend\OrderController::class,'view']);
    Route::get('/frontend/orders/view/items/{order_id}',[App\Http\Controllers\Frontend\OrderController::class,'ViewOrderItems']);

    
});
Route::get('/error-pay',function(){
    return 'error';
});
Route::get('/callback',[OnlinePayment::class,'PaymentCallback']);

Route::get('/frontend/addtowishlist/{product_id}',[App\Http\Controllers\Frontend\WishlistController::class,'create']);
Route::post('/frontend/addtocart/{product_id}',[App\Http\Controllers\Frontend\CartController::class,'AddToCart']);
Route::get('/frontend/wishlistitem/delete/{product_id}',[App\Http\Controllers\Frontend\WishlistController::class,'destory']);



// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
