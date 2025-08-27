<?php

use App\Http\Controllers\CuadroController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ParticipanteController;
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
Route::apiResource('cuadros',CuadroController::class);
Route::apiResource('payments',PaymentController::class);

Route::apiResource('participantes',ParticipanteController::class);
Route::get( 'participantes/cuadro/{cuadro_id}', [App\Http\Controllers\ParticipanteController::class, 'getByCuadro']);

