<?php

use App\Http\Controllers\API\ProductCategoryController;
use App\Http\Controllers\API\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Product
Route::get('assets', [ProductController::class, 'all']);

//Product Category
Route::post('categories', [ProductCategoryController::class, 'create']);
Route::get('categories', [ProductCategoryController::class, 'all']);
