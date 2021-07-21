<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SmallCategoryController; 
use App\Http\Controllers\ProductController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('category')->group(function (){

    Route::post('/created', [CategoryController::class, 'Created']);
    Route::post('/delete', [CategoryController::class, 'delete']);
    Route::post('/update', [CategoryController::class, 'update']);
    Route::get('/', [CategoryController::class, 'getAll']);
    Route::get('/withsmallcategory', [CategoryController::class, 'getAllWithSmallCategory']);

});

Route::prefix('smallcategory')->group(function (){
    Route::post('/created', [SmallCategoryController::class, 'Created']);
    Route::post('/delete', [SmallCategoryController::class, 'delete']);
    Route::post('/update', [SmallCategoryController::class, 'update']);
    Route::get('findbyid/{id}', [SmallCategoryController::class, 'findById']);
});

Route::prefix('product')->group(function (){
    Route::post('/created', [ProductController::class, 'created']);
    Route::post('/delete',[ProductController::class, 'delete']);
    Route::post('/update', [ProductController::class, 'update']);
    Route::get('/', [ProductController::class, 'getAll']);



});


