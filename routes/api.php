<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AgendaApiController;

Route::post('/login', [AgendaApiController::class, 'login']);

Route::get('/dentista/{dentista}/agenda', [AgendaApiController::class, 'agendaDentista']);

Route::post('/citas', [AgendaApiController::class, 'store']);
Route::put('/citas/{id}', [AgendaApiController::class, 'update']);
Route::delete('/citas/{id}', [AgendaApiController::class, 'destroy']);
