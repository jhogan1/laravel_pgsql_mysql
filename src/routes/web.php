<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloWorldController;
use App\Http\Controllers\FavoriteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(HelloWorldController::class)->group(
    function () {
        Route::get('/hello-world', 'index')->name('hello-world');
    }
);

Route::controller(FavoriteController::class)->group(
    function () {
        Route::get('/create', 'create')->name('create');
    }
);

Route::get('/', function () {
    return view('welcome');
});

