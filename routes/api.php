<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\JasaController;
use App\Http\Controllers\Api\Admin\RoleController;
use App\Http\Controllers\Api\User\LoginController;
use App\Http\Controllers\Api\Admin\SkillController;
use App\Http\Controllers\Api\Admin\KategoriController;
use App\Http\Controllers\Api\Admin\MaterialController;
use App\Http\Controllers\Api\Admin\PaketJasaController;
use App\Http\Controllers\Api\Admin\AdminLoginController;
use App\Http\Controllers\Api\Admin\DetailRoleController;
use App\Http\Controllers\Api\User\TransactionController;
use App\Http\Controllers\Api\Admin\MappingGrupController;
use App\Http\Controllers\Api\Admin\RincianJasaController;
use App\Http\Controllers\Api\Admin\MappingSubGrupController;
use App\Http\Controllers\Api\Admin\TransactionAdminController;
use App\Http\Controllers\Api\Admin\DetailJasaPegawaiController;
use App\Http\Controllers\Api\Admin\MappingSubProjectController;

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
        
        Route::prefix('transaksi')->name('transaksi.')->group(function(){
            Route::get('/',[TransactionController::class, 'index'])->name('index');
            Route::get('/{id}',[TransactionController::class, 'detail'])->name('detail');
            Route::post('/buktipembayaran/{id}',[TransactionController::class, 'buktiPembayaran'])->name('buktipembayaran');
            Route::post('/create',[TransactionController::class, 'create'])->name('create');
            
        });
        
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
            Route::get('/edit/{id}',[KategoriController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}',[KategoriController::class, 'update'])->name('update');
            Route::post('/delete/{id}',[KategoriController::class, 'delete'])->name('delete');
        });

        Route::prefix('skill')->name('skill.')->group(function(){
            Route::get('/',[SkillController::class, 'index'])->name('index');
            Route::post('/create',[SkillController::class, 'store'])->name('store');
            Route::get('/edit/{id}',[SkillController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}',[SkillController::class, 'update'])->name('update');
            Route::post('/delete/{id}',[SkillController::class, 'delete'])->name('delete');
        });

        Route::prefix('paketjasa')->name('paketjasa.')->group(function(){
            Route::get('/',[PaketJasaController::class, 'index'])->name('index');
            Route::post('/create',[PaketJasaController::class, 'store'])->name('store');
            Route::get('/edit/{id}',[PaketJasaController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}',[PaketJasaController::class, 'update'])->name('update');
            Route::post('/delete/{id}',[PaketJasaController::class, 'delete'])->name('delete');
        });
        
        Route::prefix('jasa')->name('jasa.')->group(function(){
            Route::get('/',[JasaController::class, 'index'])->name('index');
            Route::post('/create',[JasaController::class, 'store'])->name('store');
            Route::get('/edit/{id}',[JasaController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}',[JasaController::class, 'update'])->name('update');
            Route::post('/delete/{id}',[JasaController::class, 'delete'])->name('delete');
        });

        Route::prefix('role')->name('role.')->group(function(){
            Route::get('/',[RoleController::class, 'index'])->name('index');
            Route::post('/create',[RoleController::class, 'store'])->name('store');
            Route::get('/edit/{id}',[RoleController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}',[RoleController::class, 'update'])->name('update');
            Route::post('/delete/{id}',[RoleController::class, 'delete'])->name('delete');
        });

        Route::prefix('detailrole')->name('detailrole.')->group(function(){
            Route::get('/',[DetailRoleController::class, 'index'])->name('index');
            Route::post('/create',[DetailRoleController::class, 'store'])->name('store');
            Route::get('/edit/{id}',[DetailRoleController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}',[DetailRoleController::class, 'update'])->name('update');
            Route::post('/delete/{id}',[DetailRoleController::class, 'delete'])->name('delete');
        });

        Route::prefix('rincianjasa')->name('rincianjasa.')->group(function(){
            Route::get('/',[RincianJasaController::class, 'index'])->name('index');
            Route::post('/create',[RincianJasaController::class, 'store'])->name('store');
            Route::get('/edit/{id}',[RincianJasaController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}',[RincianJasaController::class, 'update'])->name('update');
            Route::post('/delete/{id}',[RincianJasaController::class, 'delete'])->name('delete');
        });

        Route::prefix('material')->name('material.')->group(function(){
            Route::get('/',[MaterialController::class, 'index'])->name('index');
            Route::post('/create',[MaterialController::class, 'store'])->name('store');
            Route::get('/edit/{id}',[MaterialController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}',[MaterialController::class, 'update'])->name('update');
            Route::post('/delete/{id}',[MaterialController::class, 'delete'])->name('delete');
        });

        Route::prefix('transaksiadmin')->name('transaksiadmin.')->group(function(){
            Route::get('/',[TransactionAdminController::class, 'index'])->name('index');
            // Route::post('/create',[TransactionAdminController::class, 'store'])->name('store');
            // Route::get('/edit/{id}',[TransactionAdminController::class, 'edit'])->name('edit');
            // Route::post('/edit/{id}',[TransactionAdminController::class, 'update'])->name('update');
            Route::post('/status/progress/{id}',[TransactionAdminController::class, 'statusProgress'])->name('status.progress');
            Route::post('/status/finish/{id}',[TransactionAdminController::class, 'statusFinish'])->name('status.finish');
            Route::post('/delete/{id}',[TransactionAdminController::class, 'delete'])->name('delete');
        });

        Route::prefix('detailjasapegawai')->name('detailjasapegawai.')->group(function(){
            Route::get('/',[DetailJasaPegawaiController::class, 'rincianjasaindex'])->name('rincianjasa.index');
            Route::get('/detail/{id}',[DetailJasaPegawaiController::class, 'index'])->name('index');
            Route::post('/create',[DetailJasaPegawaiController::class, 'store'])->name('store');
            Route::post('/edit/{id}',[DetailJasaPegawaiController::class, 'update'])->name('update');
            Route::post('/delete/{id}',[DetailJasaPegawaiController::class, 'delete'])->name('delete');
        });

        Route::prefix('mapping')->name('mapping.')->group(function(){
            Route::get('/',[MappingGrupController::class, 'index'])->name('index');
            Route::get('/detail/{id}',[MappingGrupController::class, 'detail'])->name('detail'); //id mapping
            Route::post('/create/{id}',[MappingGrupController::class, 'store'])->name('store'); //id mapping
            Route::post('/edit/{id}',[MappingGrupController::class, 'update'])->name('update'); //id mapping sub
            Route::post('/delete/{id}',[MappingGrupController::class, 'delete'])->name('delete'); //id mapping sub
        });

        Route::prefix('mappingsubgrup')->name('mappingsubgrup.')->group(function(){
            Route::get('/{id}',[MappingSubGrupController::class, 'index'])->name('index');
            Route::get('/detail/{id}',[MappingSubGrupController::class, 'detail'])->name('detail'); //id mapping
            Route::post('/create/{id}',[MappingSubGrupController::class, 'store'])->name('store'); //id mapping
            Route::post('/edit/{id}',[MappingSubGrupController::class, 'update'])->name('update'); //id mapping sub
            Route::post('/delete/{id}',[MappingSubGrupController::class, 'delete'])->name('delete'); //id mapping sub
        });

        Route::prefix('mappingsubproject')->name('mappingsubproject.')->group(function(){
            Route::get('/{id}',[MappingSubProjectController::class, 'index'])->name('index');
            Route::get('/detail/{id}',[MappingSubProjectController::class, 'detail'])->name('detail'); //id mapping
            Route::post('/create/{id}',[MappingSubProjectController::class, 'store'])->name('store'); //id mapping
            Route::post('/edit/{id}',[MappingSubProjectController::class, 'update'])->name('update'); //id mapping sub
            Route::post('/delete/{id}',[MappingSubProjectController::class, 'delete'])->name('delete'); //id mapping sub
        });


    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('user.logout');

    });
});


