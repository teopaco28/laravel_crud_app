<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::macro('softDeletes', function($name, $controller) {
    Route::get("$name/trashed", [$controller, 'trashed'])->name("$name.trashed");
    Route::patch("$name/{user}/restore", [$controller, 'restore'])->name("$name.restore");
    Route::delete("$name/{user}/delete", [$controller, 'delete'])->name("$name.delete");
});

Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class);

  
    Route::softDeletes('users', UserController::class);
});
