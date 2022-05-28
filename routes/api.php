<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\LoginController;
use App\Http\Controllers\Api\Admin\KategoriController;
use App\Http\Controllers\Api\Admin\AdminLoginController;
use App\Http\Controllers\Api\Admin\PaketJasaController;
use App\Http\Controllers\Api\Admin\SkillController;

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

// USER
Route::name('user.')->group(function(){
    // Login and redirected miss-uRL
    Route::middleware(['guest:api'])->group(function(){
        Route::post('/login', [LoginController::class, 'login'])->name('login');
        Route::post('/register', [LoginController::class, 'register'])->name('user.register');
    });

    Route::middleware(['auth:api','jwt'])->group(function(){
        Route::get('/logout', [LoginController::class, 'logout'])->name('user.logout');

    });
});





// ADMIN
Route::prefix('admin')->name('admin.')->group(function(){
    // Login and redirected miss-uRL
    Route::middleware(['guest:admin'])->group(function(){
        Route::post('/login', [AdminLoginController::class, 'login'])->name('login');
        Route::post('/register', [AdminLoginController::class, 'register'])->name('register');
    });

    Route::middleware(['auth:admin','jwt'])->group(function(){
        // KATEGORI - ADMIN
        Route::prefix('kategori')->name('kategori.')->group(function(){
            Route::get('/',[KategoriController::class, 'index'])->name('index');
            Route::post('/create',[KategoriController::class, 'store'])->name('store');
            Route::post('/edit/{id}',[KategoriController::class, 'update'])->name('update');
            Route::post('/delete/{id}',[KategoriController::class, 'delete'])->name('delete');
        });

        Route::prefix('skill')->name('skill.')->group(function(){
            Route::get('/',[SkillController::class, 'index'])->name('index');
            Route::post('/create',[SkillController::class, 'store'])->name('store');
            Route::post('/edit/{id}',[SkillController::class, 'update'])->name('update');
            Route::post('/delete/{id}',[SkillController::class, 'delete'])->name('delete');
        });

        Route::prefix('paketjasa')->name('paketjasa.')->group(function(){
            Route::get('/',[PaketJasaController::class, 'index'])->name('index');
            Route::post('/create',[PaketJasaController::class, 'store'])->name('store');
            Route::post('/edit/{id}',[PaketJasaController::class, 'update'])->name('update');
            Route::post('/delete/{id}',[PaketJasaController::class, 'delete'])->name('delete');
        });

    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('user.logout');

    });
});


