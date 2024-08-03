<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('admin')->group(function(){
    Route::middleware('isAdmin')->group(function(){
        Route::get('/',[App\Http\Controllers\Admin\DashboardConroller::class,'index']);
        Route::controller(App\Http\Controllers\Admin\AdminController::class)->group(function(){
            Route::get('admins/view','index');
            Route::get('admins/create','create');
            Route::post('admins/store','store')->name('admin.create');
            Route::get('admins/edit/{admin_id}','edit');
            Route::post('admins/update/{admin_id}','update');
            Route::get('admins/delete/{admin_id}','delete');
        });
        Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function(){
            Route::get('product/create','create');
            Route::post('product/store','store');
            Route::get('product','index');
            Route::get('product/{id}/edit','edit');
            Route::put('/product/{id}/update','update');
            Route::get('/product/{product}/delete','destory');
            Route::get('/product-image/{product_image_id}/delete','destoryImage');
            Route::post('/product-color/{prod_color_id}','updateProdColorQty');
            Route::post('/product-color/{prod_color_id}/delete','deleteProdColor');
          });
        Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function(){
            Route::get('category/create','create');
            Route::post('category/store','store');
            Route::get('category','index');
            Route::get('category/{id}/edit','edit');
            Route::post('category/{id}/update','update');
            Route::get('category/{id}/delete','destory');
          
          });  
          Route::controller(App\Http\Controllers\Admin\ColorController::class)->group(function(){
            Route::get('color/create','create');
            Route::post('colors/store','store');
            Route::get('color','index');
            Route::get('color/{id}/edit','edit');
            Route::post('color/update/{id}','update');
            Route::get('color/{id}/delete','destory');
          
          }); 
          Route::controller(App\Http\Controllers\Admin\OrderController::class)->group(function(){
          
            Route::get('orders/view/{order_id}/{user_id}','view')->name('order.view');
            Route::get('/orders/index','index')->name('order.index');
            Route::get('/order/{order_id}/delete','destory');
            Route::put('orders/update/{order_id}','UpdateStatusOrder');
            Route::get('/invoice/{order_id}/view','ViewInvoice');
            Route::get('/invoice/{order_id}/print','PrintInvoice');
            Route::get('/invoice/generate/{order_id}','DownloadInvoice');
            Route::get('/invoice/send-by-email/{order_id}/{user_id}','SendInvoiceByEmail');
         
          
          });
          Route::controller(App\Http\Controllers\Admin\UserController::class)->group(function(){
          
       
            Route::get('/users/index','index');
            Route::get('users/{user_id}/delete','destory');
            Route::get('users/discount/form/{user_id}','edit')->name('discount.form');
            Route::post('store/discount/user/{user_id}','AddDiscountUser');
            Route::get('users/discount-code/delete/{user_id}','DeleteDiscountCode');
       
           
         
          
          });  
          Route::controller(App\Http\Controllers\Admin\SettingsController::class)->group(function(){
          
       
            Route::get('/settings','index');
            Route::post('/settings','store');
       
           
         
          
          }); 


    });
    require __DIR__.'/admin_auth.php';

});


