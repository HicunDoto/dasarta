<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\SalesController;

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



Route::get('/login',[LoginController::class,'home'])->name('login');
Route::post('/login',[LoginController::class,'login'])->name('post.login');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');

// Route::get('/program',[MarketingController::class,'program'])->name('program');
// Route::post('/program',[MarketingController::class,'saveProgram'])->name('saveProgram');
Route::get('/program',[MarketingController::class,'program'])->name('program');
Route::get('/addprogram',[MarketingController::class,'formProgram'])->name('addProgram');
Route::get('/editprogram/{id}',[MarketingController::class,'formProgram'])->name('editProgram');

Route::group(['middleware'=>['marketing']], function(){
    Route::get('/', function () {
        return view('index');
    });
});

Route::group(['middleware'=>['sales']], function(){

});