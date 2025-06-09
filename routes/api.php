<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


 Route::get('categories', [CategoryController::class,'index'])->name('api.v1.categories.index');
 Route::post('categories', [CategoryController::class,'store'])->name('api.v1.categories.store');
 Route::get('categories/{category}', [CategoryController::class,'show'])->name('api.v1.categories.show');

// Route::resource('categories',CategoryController::class);
