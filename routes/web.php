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


Route::get('/',[LoginController::class,'home'])->name('login');

// Route::get('/program',[MarketingController::class,'program'])->name('program');
// Route::post('/program',[MarketingController::class,'saveProgram'])->name('saveProgram');

Route::group(['middleware'=>['marketing']], function(){
    Route::get('/program',[MarketingController::class,'program'])->name('program');
    Route::get('/addprogram',[MarketingController::class,'formProgram'])->name('addProgram');
    Route::get('/editprogram/{id}',[MarketingController::class,'formProgram'])->name('editProgram');
    Route::get('/addsales',[MarketingController::class,'formSales'])->name('addSales');
    Route::get('/sales',[MarketingController::class,'sales'])->name('sales');
    Route::get('/exportPDF',[MarketingController::class,'exportPDF'])->name('exportPDF');
});

Route::group(['middleware'=>['sales']], function(){
    Route::get('/customer',[SalesController::class,'customer'])->name('customer');
    Route::get('/addcustomer',[SalesController::class,'formCustomer'])->name('addCustomer');
    Route::get('/editcustomer/{id}',[SalesController::class,'formCustomer'])->name('editCustomer');
    Route::get('/updatepassword/{id}',[SalesController::class,'updatePassword'])->name('updatePassword');
});