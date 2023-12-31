<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\SalesController;

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

Route::get('/getProgram',[MarketingController::class,'getProgram'])->name('getProgram');
Route::post('/program',[MarketingController::class,'saveProgram'])->name('saveProgram');
Route::post('/saveStatus',[MarketingController::class,'saveStatus'])->name('saveStatus');
Route::post('/sales',[MarketingController::class,'saveSales'])->name('saveSales');
Route::get('/getSales',[MarketingController::class,'getSales'])->name('getSales');

Route::post('/login',[LoginController::class,'login'])->name('postLogin');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');

Route::post('/saveCustomer',[SalesController::class,'saveCustomer'])->name('saveCustomer');
Route::post('/savePassword',[SalesController::class,'savePassword'])->name('savePassword');
Route::get('/deleteCustomer',[SalesController::class,'deleteCustomer'])->name('deleteCustomer');
Route::get('/getCustomer',[SalesController::class,'getCustomer'])->name('getCustomer');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
