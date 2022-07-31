<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChildrenController;
use App\Http\Controllers\ParentController;
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


Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('auth/logout', [AuthController::class, 'logout']);


    //-------------------babies-----------------------------------
    Route::apiResource('/baby',ChildrenController::class);
    //-------------------partners "parents"------------------------
    Route::apiResource('/partner',ParentController::class);

    Route::get('/parent/{partner}/child/{children}',[ParentController::class,'addPartner'])->name('addPartner');
});
