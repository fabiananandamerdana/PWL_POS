<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use Database\Seeders\PenjualanDetailSeeder;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'postregister']);

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware(['auth'])->group(function(){
    Route::get('/', [WelcomeController::class,'index']);
    Route::post('/list', [WelcomeController::class,'list']);
    Route::middleware(['authorize:ADM,MNG'])->group(function(){

        Route::group(['prefix' => 'barang'], function (){
            Route::get('/',[BarangController::class, 'index']);
            Route::post('/list',[BarangController::class, 'list']);
            Route::get('/create',[BarangController::class, 'create']);
            Route::post('/ajax',[UserController::class, 'store_ajax']);
            Route::get('/create_ajax',[UserController::class, 'create_ajax']);
            Route::post('/',[BarangController::class, 'store']);
            Route::get('/export_excel',[BarangController::class, 'export_excel']);
            Route::get('/export_pdf',[BarangController::class, 'export_pdf']);
            Route::get('/import',[BarangController::class, 'import']);
            Route::post('/import_ajax',[BarangController::class, 'import_ajax']);
            Route::get('/{id}',[BarangController::class, 'show']);
            Route::get('/{id}/edit',[BarangController::class, 'edit']);
            Route::put('/{id}',[BarangController::class, 'update']);
            Route::get('/{id}/edit_ajax',[BarangController::class, 'edit_ajax']);
            Route::put('/{id}/update_ajax',[BarangController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax',[BarangController::class, 'confirm_ajax']);
            Route::delete('/{id}/delete_ajax',[BarangController::class, 'delete_ajax']);
            // Route::delete('/{id}',[BarangController::class, 'destroy']);

        });

        Route::group(['prefix' => 'user'], function (){
            Route::get('/',[UserController::class, 'index']);
            Route::post('/list',[UserController::class, 'list']);
            Route::get('/create',[UserController::class, 'create']);
            Route::post('/',[UserController::class, 'store']);
            Route::get('/create_ajax',[UserController::class, 'create_ajax']);
            Route::post('/ajax',[UserController::class, 'store_ajax']);
            Route::get('/export_excel',[UserController::class, 'export_excel']);
            Route::get('/export_pdf',[UserController::class, 'export_pdf']);
            Route::get('/import',[UserController::class, 'import']);
            Route::post('/import_ajax',[UserController::class, 'import_ajax']);
            Route::get('/{id}',[UserController::class, 'show']);
            Route::get('/{id}/edit',[UserController::class, 'edit']);
            Route::put('/{id}',[UserController::class, 'update']);
            Route::get('/{id}/edit_ajax',[UserController::class, 'edit_ajax']);
            Route::put('/{id}/update_ajax',[UserController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax',[UserController::class, 'confirm_ajax']);
            Route::delete('/{id}/delete_ajax',[UserController::class, 'delete_ajax']);
            Route::delete('/{id}',[UserController::class, 'destroy']);
        });


        Route::group(['prefix' => 'level'], function (){
            Route::get('/',[LevelController::class, 'index']);
            Route::post('/list',[LevelController::class, 'list']);
            Route::get('/create',[LevelController::class, 'create']);
            Route::post('/',[LevelController::class, 'store']);
            Route::get('/create_ajax',[LevelController::class, 'create_ajax']);
            Route::get('/export_excel',[LevelController::class, 'export_excel']);
            Route::get('/export_pdf',[LevelController::class, 'export_pdf']);
            Route::get('/import',[LevelController::class, 'import']);
            Route::post('/import_ajax',[LevelController::class, 'import_ajax']);
            Route::get('/{id}',[LevelController::class, 'show']);
            Route::get('/{id}/edit',[LevelController::class, 'edit']);
            Route::put('/{id}',[LevelController::class, 'update']);
            Route::post('/ajax',[LevelController::class, 'store_ajax']);
            Route::get('/{id}/edit_ajax',[LevelController::class, 'edit_ajax']);
            Route::put('/{id}/update_ajax',[LevelController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax',[LevelController::class, 'confirm_ajax']);
            Route::delete('/{id}/delete_ajax',[LevelController::class, 'delete_ajax']);
            Route::delete('/{id}',[LevelController::class, 'destroy']);
        });

        Route::group(['prefix' => 'kategori'], function (){
            Route::get('/',[CategoryController::class, 'index']);
            Route::post('/list',[CategoryController::class, 'list']);
            Route::get('/create',[CategoryController::class, 'create']);
            Route::post('/',[CategoryController::class, 'store']);
            Route::get('/create_ajax',[CategoryController::class, 'create_ajax']);
            Route::get('/export_excel',[CategoryController::class, 'export_excel']);
            Route::get('/export_pdf',[CategoryController::class, 'export_pdf']);
            Route::get('/import',[CategoryController::class, 'import']);
            Route::post('/import_ajax',[CategoryController::class, 'import_ajax']);
            Route::get('/{id}',[CategoryController::class, 'show']);
            Route::get('/{id}/edit',[CategoryController::class, 'edit']);
            Route::put('/{id}',[CategoryController::class, 'update']);
            Route::post('/ajax',[CategoryController::class, 'store_ajax']);
            Route::get('/{id}/edit_ajax',[CategoryController::class, 'edit_ajax']);
            Route::put('/{id}/update_ajax',[CategoryController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax',[CategoryController::class, 'confirm_ajax']);
            Route::delete('/{id}/delete_ajax',[CategoryController::class, 'delete_ajax']);
            Route::delete('/{id}',[CategoryController::class, 'destroy']);
        });

        Route::group(['prefix' => 'supplier'], function (){
            Route::get('/',[SupplierController::class, 'index']);
            Route::post('/list',[SupplierController::class, 'list']);
            Route::get('/create',[SupplierController::class, 'create']);
            Route::post('/',[SupplierController::class, 'store']);
            Route::get('/create_ajax',[SupplierController::class, 'create_ajax']);
            Route::get('/export_excel',[SupplierController::class, 'export_excel']);
            Route::get('/export_pdf',[SupplierController::class, 'export_pdf']);
            Route::get('/import',[SupplierController::class, 'import']);
            Route::post('/import_ajax',[SupplierController::class, 'import_ajax']);
            Route::get('/{id}',[SupplierController::class, 'show']);
            Route::get('/{id}/edit',[SupplierController::class, 'edit']);
            Route::put('/{id}',[SupplierController::class, 'update']);
            Route::post('/ajax',[SupplierController::class, 'store_ajax']);
            Route::get('/{id}/edit_ajax',[SupplierController::class, 'edit_ajax']);
            Route::put('/{id}/update_ajax',[SupplierController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax',[SupplierController::class, 'confirm_ajax']);
            Route::delete('/{id}/delete_ajax',[SupplierController::class, 'delete_ajax']);
            Route::delete('/{id}',[SupplierController::class, 'destroy']);
        });
        Route::group(['prefix' => 'penjualan'], function (){
            Route::get('/',[PenjualanController::class, 'index']);
            Route::get('/create',[PenjualanController::class, 'create']);
            Route::post('/store',[PenjualanController::class, 'store']);
            Route::post('/list',[PenjualanController::class, 'list']);
            Route::get('/{id}/detail',[PenjualanController::class, 'detail']);
            Route::get('/excel',[PenjualanController::class, 'export_excel']);
        });
        Route::group(['prefix' => 'stok'], function (){
            Route::get('/',[StokController::class, 'index']);
            Route::post('/list',[StokController::class, 'list']);
            Route::get('/excel',[StokController::class, 'export_excel']);
            Route::get('/{id}/detail',[StokController::class, 'detail']);
            Route::get('/{id}/confirm',[StokController::class, 'confirm']);
            Route::delete('/{id}/delete',[StokController::class, 'delete']);
            Route::get('/create',[StokController::class, 'create']);
            Route::post('/store',[StokController::class, 'store']);

        });
    });
    Route::middleware(['authorize:ADM,MNG,STF'])->group(function(){
        Route::group(['prefix' => 'profile'], function(){
            Route::get('/{id}/edit',[UserController::class, 'edit_ajax']);
        });
        Route::group(['prefix' => 'user'], function (){
            Route::put('/{id}/update_ajax',[UserController::class, 'update_ajax']);
        });
    });

    Route::get('/test/count', function () {
        $activeMenu = 'dashboard';
        $breadcrumb = (object) [
            'title' => 'Ruang Test',
            'list' => ['Home','Test']
        ];

        $page = (object)[
            'title' => 'Ini adalah ruang test'
        ];
        return view('components.count', [
            'breadcrumb' => $breadcrumb,
            'title' => 'Ruang Test',
            'activeMenu' => $activeMenu,
        ]);
    });

});









