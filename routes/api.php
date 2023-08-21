<?php

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\API\postApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



    Route::match(['get','post'],'/home',[postApiController::class,'showAllPost']);
    Route::match(['get','post'],'/home/popular',[postApiController::class,'showpopularPost']);
    Route::match(['get','post'],'/categoryPost/{category}',[postApiController::class,'categoryPost']);
    Route::match(['get','post'],'/home/recent',[postApiController::class,'recentArtical']);
    Route::match(['get','post'],'/home/allrecent',[postApiController::class,'allrecentArtical']);
    Route::match(['get','post'],'/home/allpost',[postApiController::class,'allArtical']);
    Route::match(['get','post'],'/home/allpopular',[postApiController::class,'allpopularArtical']);
    Route::get('/home/slider',[postApiController::class,'slider']);
    Route::match(['get','post'],'/home/category',[postApiController::class,'Allcategory']);
    Route::match(['get','post'],'/viewAllpost/{status}',[postApiController::class,'viewAll']);
    Route::match(['get','post'],'/viewAllpost',[postApiController::class,'filterData']);

    Route::match(['get','post'],'/search',[postApiController::class,'search']);

    Route::match(['get','post'],'/search-result/{search}',[postApiController::class,'search_page']);

    Route::get('/post/edit',[PostController::class,'edit']);
    Route::match(['get','post'],'/blog/{category}/{id}',[postApiController::class,'showpost']);

