<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();
Route::group(['middleware' => 'admin'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
Route::get('/logout',[App\Http\Controllers\Auth\LoginController::class,'logout'])->name('logout');


Route::group(['prefix' => 'admin'], function () {
    Route::resource('categories', App\Http\Controllers\Admin\CategorieController::class, ["as" => 'admin']);
});
Route::get('/', [App\Http\Controllers\Admin\CategorieController::class, 'welcomeIndex']);