<?php

use App\Http\Controllers\admin\AdminBlogController;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\TempImageController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\SettingsController;


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

Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
Route::get('/privacy-policy', [HomeController::class, 'privacy'])->name('privacy');


Route::get('/services', [ServicesController::class, 'index']);
Route::get('/services/detail/{id}', [ServicesController::class, 'detail']);
Route::get('/faq', [FaqController::class, 'index']);
Route::get('/blogs', [BlogController::class, 'index'])->name('blog.front');
Route::get('/blog/{id}', [BlogController::class, 'detail'])->name('blog.detail');
Route::get('/contact', [ContactController::class, 'index']);




Route::group(['prefix' => 'admin'], function () {

    Route::group(['middleware' => 'admin.guest'], function () {

        // Here We will define Guest Route

        Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('/login', [AdminLoginController::class, 'authenticate'])->name('admin.auth');
    });

    Route::group(['middleware' => 'admin.auth'], function () {

        // Here We will define  Password Protected  Routes
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

        Route::get('/services/create', [ServiceController::class, 'create'])->name('service.create.form');
        Route::post('/services/create', [ServiceController::class, 'save'])->name('service.create');
        Route::get('/services', [ServiceController::class, 'index'])->name('servicelist');
        Route::get('/services/edit/{id}', [ServiceController::class, 'edit'])->name('service.edit');
        Route::post('/services/edit/{id}', [ServiceController::class, 'update'])->name('service.edit.update');
        Route::post('/services/delete/{id}', [ServiceController::class, 'delete'])->name('service.delete');


        //Blog Routes 
        Route::get('/blog/create', [AdminBlogController::class, 'create'])->name('blog.create.form');
        Route::post('/blog/create', [AdminBlogController::class, 'save'])->name('blog.save');
        Route::get('/blogs', [AdminBlogController::class, 'index'])->name('bloglist');
        Route::get('/blogs/edit/{id}', [AdminBlogController::class, 'edit'])->name('blog.edit');
        Route::post('/blogs/edit/{id}', [AdminBlogController::class, 'update'])->name('blog.update');
        Route::post('/blogs/delete/{id}', [AdminBlogController::class, 'delete'])->name('blog.delete');

        //FAQ Routes 
       
        Route::get('/faq', [AdminFaqController::class, 'index'])->name('faqlist');  
        Route::get('/faq/create', [AdminFaqController::class, 'create'])->name('faq.create');
        Route::post('/faq/save', [AdminFaqController::class, 'save'])->name('faq.save');
        Route::get('/faq/edit/{id}', [AdminFaqController::class, 'edit'])->name('faq.edit');
        Route::post('/faq/edit/{id}', [AdminFaqController::class, 'update'])->name('faq.update');
        Route::post('/faq/delete/{id}', [AdminFaqController::class, 'delete'])->name('faq.delete');

        //Page Routes 
        Route::get('/page/create',[PageController::class,'create'])->name('page.create.form');
        Route::post('/page/create',[PageController::class,'save'])->name('page.save');
        Route::get('/pages', [PageController::class, 'index'])->name('pagelist');  
        Route::get('/page/edit/{id}', [PageController::class, 'edit'])->name('page.edit');
        Route::post('/page/edit/{id}', [PageController::class, 'update'])->name('page.update');
        Route::post('/page/delete/{id}', [PageController::class, 'delete'])->name('page.delete');
        Route::post('/page/deleteImage}', [PageController::class, 'deleteImage'])->name('page.deleteImage');

       // Settings Route 
             
       Route::get('/settings',[SettingsController::class,'index'])->name('settings.index');
       Route::post('/settings',[SettingsController::class,'save'])->name('settings.save');













         
        Route::post('/temp/upload', [TempImageController::class, 'upload'])->name('tempUpload');
    });
});
