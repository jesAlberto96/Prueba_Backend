<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/auth', [App\Http\Controllers\Api\V1\LoginController::class, 'login']);

//Candidatos
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/leads', [App\Http\Controllers\Api\V1\CandidatosController::class, 'index']);
    Route::post('/lead', [App\Http\Controllers\Api\V1\CandidatosController::class, 'store'])->middleware(['can:candidatos.create']);
    Route::get('/lead/{candidato}', [App\Http\Controllers\Api\V1\CandidatosController::class, 'show'])->middleware(['can:candidatos.edit']);
});
