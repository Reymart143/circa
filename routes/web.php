<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SystemConfigurationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FoodCartController;

    //view Login Page
    Route::get('/', function () {
        if (Auth::check()) {
            return redirect()->route('Dashboard');
        }
        return view('auth.login');
    });
    Route::get('/login', function () {
        if (Auth::check()) {
            return redirect()->route('Dashboard');
        }
        return view('auth.login');
    })->name('login');
    //Register
    Route::get('/register', [LoginController::class, 'RegisterView'])->name('register');
    Route::post('/register.store', [LoginController::class, 'RegisterStore'])->name('register.store');

    //Authentication
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    //Dashboard for users
    Route::get('/Dashboard', [DashboardController::class, 'Dashboard'])->name('Dashboard');
    Route::get('/monthly-sales-data', [DashboardController::class, 'getMonthlySalesData']);
    //Profile
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'userUpdate'])->name('profile/update');
    Route::put('user/upload/update', [ProfileController::class, 'imageUpdate'])->name('user/upload/update');
    //For Admin Routes
    Route::middleware('isAdmin')->group(function(){ 
        //users crud
        Route::get('/users/index', [UserController::class, 'index'])->name('users/index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users/create');
        Route::post('users.store', [UserController::class, 'store'])->name('users.store');
        Route::get('users.edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::get('/users.details/{id}', [UserController::class, 'show'])->name('users.details');
        Route::put('/users.update', [UserController::class, 'update'])->name('users.update');
        Route::delete('user.delete/{id}', [UserController::class, 'hardDelete'])->name('users.delete');
        //Category settings
        Route::get('/settings/category', [CategoryController::class, 'index'])->name('settings/category');
        Route::post('/add_category', [CategoryController::class, 'add_category']);
        Route::get('/category/edit/{id}', [CategoryController::class, 'edit_category']);
        Route::post('/category/update', [CategoryController::class, 'update_category'])->name('category/update');
        Route::delete('category.delete/{id}', [CategoryController::class, 'softDelete'])->name('category.delete');
        //product Details 
        Route::get('/product/index', [ProductController::class, 'index'])->name('product/index');
        Route::post('/product.store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/product/edit/{id}', [ProductController::class, 'edit_product'])->name('product/edit');
        Route::post('/product/update', [ProductController::class, 'updateproduct'])->name('product/update');
        Route::delete('product.delete/{id}', [ProductController::class, 'softDelete'])->name('product.delete');
        Route::post('/product/update-status', [ProductController::class, 'updateStatus'])->name('product.updateStatus');

    });
    //Order 
    Route::get('/orders/orders', [OrderController::class, 'orders'])->name('orders/orders');
    Route::get('/order/index', [OrderController::class, 'index'])->name('order/index');
    Route::get('/product/info/{id}', [OrderController::class, 'getInfo'])->name('product/info');
    Route::get('/get-products-by-category/{category}', [OrderController::class, 'getProductsByCategory']);

    Route::post('/orders.store', [OrderController::class, 'store'])->name('orders.store');
    Route::delete('orders.delete/{id}', [OrderController::class, 'softDelete'])->name('orders.delete');
    
    //System Configuration // For all users
    Route::get('/settings/system-configuration', [SystemConfigurationController::class, 'index'])->name('settings/system-configuration');
    Route::post('/appearance/update', [SystemConfigurationController::class, 'appearanceupdate'])->name('appearance/update');

    //cashier
    // Route::get('/cashier', [CashierController::class, 'index'])->name('cashier');
    Route::get('/cashier', [CashierController::class, 'index'])->name('cashier');
    Route::get('/fetch-orders', [CashierController::class, 'fetchOrders']);
    Route::get('/payorders', [CashierController::class, 'payorders'])->name('payorders');
    // Route::get('/cashier/filter', [CashierController::class, 'filter'])->name('cashier.filter');
   Route::post('/finalize-order', [CashierController::class, 'finalizeOrder'])->name('finalize.order');

    //kitchen
    Route::get('/kitchen', [KitchenController::class, 'index'])->name('kitchen');
    Route::get('/kitchen/orders', [KitchenController::class, 'fetchOrders']);
    Route::post('/kitchen/update-status', [KitchenController::class, 'updateStatus']);
    Route::post('/kitchen/set-timer', [KitchenController::class, 'setTimer']);
    //Customer View
    Route::get('/circa',[CustomerController::class,'homepage']);
    Route::get('/menu',[CustomerController::class,'menu'])->name('menu');
    Route::get('/products-by-category/{categoryId}', [CustomerController::class, 'getProductsByCategory']);
    Route::get('/userProfile',[CustomerController::class,'userProfile']); 
    Route::post('/add-to-cart', [FoodCartController::class, 'addToCart'])->name('cart.add');
    Route::get('/yourorders/{order_no}/{table_no}', [FoodCartController::class, 'customerorder'])->name('yourorders');
    Route::post('/submit-order', [FoodCartController::class, 'submitOrder']);
    Route::get('/ordertime',[CustomerController::class,'timeorder'])->name('ordertime');
    Route::get('/kitchen/orders-json', [CustomerController::class, 'getGroupedOrders'])->name('orders.json');
