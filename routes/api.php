<?php

use App\Http\Controllers\Api\Admin\KategoriController;
use App\Http\Controllers\Api\User\LoginController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [LoginController::class, 'login'])->name('user.login');
Route::post('/register', [LoginController::class, 'register'])->name('user.register');
Route::get('/logout', [LoginController::class, 'logout'])->name('user.logout');

// KATEGORI - ADMIN
Route::middleware('jwt')->group(function(){
    Route::prefix('kategori')->name('kategori.')->group(function(){
        Route::get('/',[KategoriController::class, 'index'])->name('index');
        Route::post('/create',[KategoriController::class, 'store'])->name('store');
        Route::post('/edit/{id}',[KategoriController::class, 'update'])->name('update');
        Route::post('/delete/{id}',[KategoriController::class, 'delete'])->name('delete');
    });
});


