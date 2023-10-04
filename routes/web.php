<?php

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\TempImageController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServicesController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[HomeController::class, 'index']);
Route::get('/about',[HomeController::class, 'about']);
Route::get('/services',[ServicesController::class, 'index']);
Route::get('/faq',[FaqController::class,'index']);
Route::get('/blogs',[BlogController::class,'index']);
Route::get('/contact',[ContactController::class,'index']);




Route::group(['prefix' => 'admin'], function () {

    Route::group(['middleware' => 'admin.guest'], function () {

        // Here We will define Guest Route

        Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('/login', [AdminLoginController::class, 'authenticate'])->name('admin.auth');
    });

    Route::group(['middleware' => 'admin.auth'], function () {

        // Here We will define  Password Protected  Routes
        Route::get('/dashboard' ,[DashboardController::class, 'index'])-> name('admin.dashboard');
        Route::get('/logout' ,[AdminLoginController::class, 'logout'])-> name('admin.logout');

        Route::get('/services/create',[ServiceController::class, 'create'])->name('service.create.form');
        Route::post('/services/create',[ServiceController::class, 'save'])->name('service.create');
        Route::get('/services',[ServiceController::class, 'index'])->name('servicelist');
        Route::get('/services/edit/{id}',[ServiceController::class, 'edit'])->name('service.edit');
        Route::post('/services/edit/{id}',[ServiceController::class, 'update'])->name('service.edit.update');



        Route::post('/temp/upload',[TempImageController::class, 'upload'])->name('tempUpload');




    });
});
