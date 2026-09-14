<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controladores Web (Portal Público Ciudadano)
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\CadController;
use App\Http\Controllers\Web\AgendaController;
use App\Http\Controllers\Web\NewsController as PublicNewsController;
use App\Http\Controllers\Web\ResourceController as PublicResourceController;

// Controladores Admin (Panel de Control Interno)
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CenterController as AdminCenterController;
use App\Http\Controllers\Admin\ActivityController as AdminActivityController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\ResourceController as AdminResourceController;
use App\Http\Controllers\Admin\ExternalLinkController;
use App\Http\Controllers\Admin\StatsController;
use App\Http\Controllers\Admin\UserController;

// Middleware de Rastreo de Visitas
use App\Http\Middleware\TrackVisitStats;

// Redirección de Raíz (Evita parámetros nulos en el middleware de región)
Route::redirect('/', '/pasco');

// --------------------------------------------------------------------------
// 1. RUTAS DE ADMINISTRACIÓN (Panel Interno)
// --------------------------------------------------------------------------
Route::prefix('admin')
    ->middleware(['auth', 'role:ADMIN,CONTENT_MANAGER'])
    ->name('admin.')
    ->group(function () {
        
        // Dashboard Principal
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
        // Módulos CRUD Principales
        Route::resource('centers', AdminCenterController::class);
        Route::resource('activities', AdminActivityController::class);
        Route::resource('news', AdminNewsController::class);
        Route::resource('resources', AdminResourceController::class)->except(['show', 'edit', 'update']);
        Route::resource('external-links', ExternalLinkController::class)->except(['create', 'edit', 'show']);
        Route::resource('users', UserController::class);
        
        // Módulos Especiales de Gestión y Evidencias
        Route::get('stats', [StatsController::class, 'index'])->name('stats.index');
        Route::delete('activities/evidences/{evidence}', [AdminActivityController::class, 'destroyEvidence'])->name('activities.evidences.destroy');
    });

// --------------------------------------------------------------------------
// 2. RUTAS PÚBLICAS Y ANALÍTICA (Filtros por Región: Pasco y Huánuco)
// --------------------------------------------------------------------------
Route::middleware(['web', TrackVisitStats::class])
    ->prefix('{region}')
    ->where(['region' => 'pasco|huanuco'])
    ->group(function () {
        
        // Inicio y Secciones Institucionales
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/que-es-un-cad', [HomeController::class, 'aboutCad'])->name('about.cad');
        Route::get('/prevencion-sismos', [HomeController::class, 'sismos'])->name('sismos');
        
        // Directorios CAD y CAU
        Route::get('/centros', [CadController::class, 'index'])->name('cad.index');
        Route::get('/centros/{code}', [CadController::class, 'show'])->name('cad.show');
        Route::get('/cau', [CadController::class, 'cauIndex'])->name('cau.index');
        
        // Módulos Dinámicos Informativos
        Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');
        Route::get('/noticias', [PublicNewsController::class, 'index'])->name('news.index');
        Route::get('/noticias/{slug}', [PublicNewsController::class, 'show'])->name('news.show');
        Route::get('/recursos-digitales', [PublicResourceController::class, 'index'])->name('resources.index');
    });

// --------------------------------------------------------------------------
// 3. RUTAS DE AUTENTICACIÓN (Laravel Auth)
// --------------------------------------------------------------------------
Auth::routes();