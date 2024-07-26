<?php

use Illuminate\Support\Facades\Route; // Ensure you are using this facade
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\productsController;
use App\Http\Controllers\Dashboard\ProfileController;

Route::group([


   'middleware' => ['auth'], // Add the 'auth' and 'verified' middleware to this group
],function(){
    Route::get('profile', [ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class,'edit'])->name('profile.edit');

    Route::resource('dashboard/categories', CategoriesController::class)->middleware('auth');
    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');
    Route::put('categories/{category}/restore',[CategoriesController::class,'restore'])->name('categories,restore');

    Route::resource('dashboard/products', productsController::class);
    Route::get('categories/trash', [CategoriesController::class, 'trash'])->name('categories.trash');
    Route::delete('categories/{category}/force-delete',[CategoriesController::class,'forceDelete'])->name('categories,force-Delete');

    Route::resource('/categories', CategoriesController::class);
    Route::resource('/products', productsController::class);


});
