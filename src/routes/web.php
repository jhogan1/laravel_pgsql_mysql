<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloWorldController;

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

Route::get('/', function () {
    return view('welcome');
});

