<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;


//Auth group
Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});


Route::group(['middleware' => ['auth:sanctum']], function (){

    //secured Auth group
    Route::delete('/logout', [AuthController::class, 'logout']);

//    //websites group
    Route::prefix('websites')->group(function () {
        Route::post('/websites', [WebsiteController::class, 'storeWebsite']);
        Route::post('/vote', [WebsiteController::class, 'vote']);
        Route::get('/search', [WebsiteController::class, 'searchWebsite']);
    });

    Route::prefix('admin')->group(function () {
        Route::delete('/delete-website', [AdminController::class, 'deleteWebsite']);
    });

});

Route::prefix('websites')->group(function () {
    Route::get('/categories', [WebsiteController::class, 'getAllCategories']);
});
