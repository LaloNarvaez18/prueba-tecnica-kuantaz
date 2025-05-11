<?php

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
Route::get('/v1/beneficios', [\App\Http\Controllers\BeneficiosController::class, 'index']);

Route::get('/v1/beneficios/anuales', [
    \App\Http\Controllers\BeneficiosController::class,
    'get_beneficios_by_year'
]);
