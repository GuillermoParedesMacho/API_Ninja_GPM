<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NinjaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MisionController;

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

Route::prefix('Ninjas')->group(function(){
	Route::post('/crear',[NinjaController::class,"crear"]);
	Route::post('/modificar/{id}',[NinjaController::class,"modificar"]);
	Route::get('/lista',[NinjaController::class,"lista"]);
});

Route::prefix('Clientes')->group(function(){
	Route::post('/crear',[ClienteController::class,"crear"]);
	Route::post('/modificar/{id}',[ClienteController::class,"modificar"]);
	Route::get('/lista',[ClienteController::class,"lista"]);
});

Route::prefix('Misiones')->group(function(){
	Route::post('/crear',[MisionController::class,"crear"]);
	Route::post('/modificar/{id}',[MisionController::class,"modificar"]);
	Route::post('/asignarNinjas',[MisionController::class,"asignarNinjas"]);
	Route::post('/completar/{id}',[MisionController::class,"completar"]);
});