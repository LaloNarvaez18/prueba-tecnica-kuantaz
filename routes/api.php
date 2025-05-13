<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\BeneficiosController;
use App\Http\Middleware\AlwaysAcceptJson;

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

Route::get('/v1/beneficios/anuales', [BeneficiosController::class, 'get_beneficios_anuales'])
    ->name('api.beneficios.anuales')
    ->middleware(AlwaysAcceptJson::class);
