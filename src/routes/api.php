<?php

use App\Http\Controllers\ColorCategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\FavoriteColorController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(FavoriteColorController::class)->group(
   function () {
       Route::get('/favorite-colors', 'index');
       Route::get('/favorite-colors/{id}', 'show');
       Route::delete('/favorite-colors/{id}', 'destroy');
       Route::post('/favorite-colors', 'store');
       Route::patch('/favorite-colors/{id}', 'update');
       Route::get('/favorite-colors/users/{id}', 'getFavoriteColorByUserId');
   }
);

Route::controller(UserController::class)->group(
    function () {
       Route::get('/users/favorite-colors/colors/{id}', 'getUsersByFavoriteColorsColorId');
    }
);

Route::controller(ColorController::class)->group(
    function () {
        Route::get('/colors', 'index');
        Route::get('/colors/{id}', 'show');
        Route::delete('/colors/{id}', 'destroy');
        Route::post('/colors', 'store');
        Route::patch('/colors/{id}', 'update');
        Route::get('/colors/categories/{id}', 'getColorsByCategoryId');
    }
);

Route::controller(ColorCategoryController::class)->group(
   function () {
       Route::get('/color-categories', 'index');
       Route::get('/color-categories/{id}', 'show');
       Route::delete('/color-categories/{id}', 'destroy');
       Route::post('/color-categories', 'store');
       Route::patch('/color-categories/{id}', 'update');
   }
);
