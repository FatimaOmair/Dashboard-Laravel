<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Dashboard\BannerController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\SliderController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dash',function(){return
     view('dashboard');})->middleware(['auth']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::resource('sliders', SliderController::class);
        Route::resource('banners', BannerController::class);
});

Route::resource('products', 'ProductController');
// Route definition for showing a products
Route::get('products/{products}', [ProductsController::class, 'index'])->name('products');

Route::get('dashboard/products/index', [productsController::class, 'index'])->name('products.index');
Route::put('dashboard/products/{product}', [ProductsController::class, 'update'])->name('products.update');
Route::put('dashboard/products/{product}/edit', [ProductsController::class, 'edit'])->name('products.edit');
Route::put('dashboard/products/store', [ProductsController::class, 'store'])->name('products.store');

// Route to view category and its products
Route::get('categories/{category}', [CategoriesController::class, 'show'])->name('categories.show');

// Route to add a product to the basket
Route::post('basket/add', [BasketController::class, 'add'])->name('basket.add');

// Route to view the basket
Route::get('basket', [BasketController::class, 'view'])->name('basket.view');

Route::post('basket/add/{product}', [BasketController::class, 'add'])->name('basket.add');

Route::get('categories/{category}/products', [CategoriesController::class, 'showProducts'])->name('categories.products');

Route::delete('/basket/remove/{productId}', [BasketController::class, 'remove'])->name('basket.remove');

Route::post('/basket/clear', [BasketController::class, 'clear'])->name('basket.clear');
Route::put('/basket/update/{product}', [BasketController::class, 'update'])->name('basket.update'); 


require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';

