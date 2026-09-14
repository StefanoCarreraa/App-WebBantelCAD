<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CenterApiController;
use App\Http\Controllers\Api\ActivityApiController;
use App\Http\Controllers\Api\NewsApiController;

Route::prefix('v1')->group(function () {
    // Endpoints para CADs y CAUs (Pasco y Huánuco)
    Route::get('/regions/{regionSlug}/centers', [CenterApiController::class, 'index']);
    Route::get('/centers/{code}', [CenterApiController::class, 'show']);

    // Endpoints para Agenda y Actividades
    Route::get('/regions/{regionSlug}/activities', [ActivityApiController::class, 'index']);
    Route::get('/activities/{id}', [ActivityApiController::class, 'show']);

    // Endpoints para Noticias y Experiencias
    Route::get('/regions/{regionSlug}/news', [NewsApiController::class, 'index']);
});