<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CkeditorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
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

Route::get('/welcome',[DashboardController::class,'welcome'])->name('welcome');



Route::get('/dashboard',[DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin',[AuthenticatedSessionController::class,'create'])->name('admin.login');
// Route::get('/admin/register',[RegisteredUserController::class,'create'])->name('admin.register');
Route::post('/logout',[AuthenticatedSessionController::class,'destroy'])->name('logout');

require __DIR__.'/auth.php';


// admin routes
Route::prefix('admin')->group(function(){
    Route::get('/category',[CategoryController::class,'index'])->name('admin.category');
    Route::get('/category/create',[CategoryController::class,'create'])->name('admin.category.create');
    Route::post('/category/store',[CategoryController::class,'store'])->name('admin.category.store');
    Route::get('/category/edit/{id}',[CategoryController::class,'edit'])->name('admin.category.edit');
    Route::post('/category/update/{id}',[CategoryController::class,'update'])->name('admin.category.update');
    // Route::get('/category/delete/{id}',[CategoryController::class,'destroy'])->name('admin.category.delete');
    Route::post('/category/delete',[CategoryController::class,'destroy'])->name('admin.category.delete');
});

Route::prefix('admin')->group(function(){
    Route::get('/post',[PostController::class,'index'])->name('admin.post');
    Route::get('/post/create',[PostController::class,'create'])->name('admin.post.create');
    Route::post('/post/store',[PostController::class,'store'])->name('admin.post.store');
    Route::post('/ckeditor/upload',[PostController::class,'upload'])->name('ckeditor.upload');
    Route::get('/post/edit/{id}',[PostController::class,'edit'])->name('admin.post.edit');
    Route::post('/post/update/{id}',[PostController::class,'update'])->name('admin.post.update');
    Route::get('/post/delete/{id}',[PostController::class,'destroy'])->name('admin.post.delete');
    Route::get('/post/search',[PostController::class,'search'])->name('admin.search');
    Route::get('/post/filter',[PostController::class,'filter'])->name('admin.filter');
    Route::get('/post/view/{id}',[PostController::class,'show'])->name('admin.post.view');
});


// User routes

Route::get('/',[HomeController::class,'index'])->name('user.home');
// Route::get('/home',[HomeController::class,'showAllPost']);
Route::get('/category',[HomeController::class,'category'])->name('user.category');
Route::get('/blog',[HomeController::class,'showpost'])->middleware(['auth', 'verified'])->name('user.blog');
Route::get('/viewAll',[HomeController::class,'viewAll'])->name('user.viewAll');

Route::get('/search/{search}',function(){
   return view('search'); 
});
