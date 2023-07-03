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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
