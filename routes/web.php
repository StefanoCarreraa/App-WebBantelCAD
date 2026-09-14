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
        Route::resource('centros', AdminCenterController::class)
            ->parameters(['centros' => 'center']);
        Route::resource('actividades', AdminActivityController::class)
            ->parameters(['actividades' => 'activity']);
        Route::resource('noticias', AdminNewsController::class)
            ->parameters(['noticias' => 'news']);
        Route::resource('recursos', AdminResourceController::class)->except(['show'])
            ->parameters(['recursos' => 'resource']);
        Route::resource('enlaces-externos', ExternalLinkController::class)->except(['create', 'edit', 'show']);
        Route::resource('usuarios', UserController::class);

        // Módulos Especiales de Gestión y Evidencias
        Route::get('estadisticas', [StatsController::class, 'index'])->name('estadisticas.index');
        Route::delete('actividades/evidencias/{evidence}', [AdminActivityController::class, 'destroyEvidence'])->name('actividades.evidencias.destroy');
    });

// --------------------------------------------------------------------------
// 2. RUTAS PÚBLICAS Y ANALÍTICA (Filtros por Región: Pasco y Huánuco)
// --------------------------------------------------------------------------
Route::middleware(['web', TrackVisitStats::class])
    ->prefix('{region}')
    ->where(['region' => 'pasco|huanuco'])
    ->group(function () {

        // Inicio y Secciones Institucionales
        Route::get('/', [HomeController::class, 'index'])->name('inicio');
        Route::get('/que-es-un-cad', [HomeController::class, 'aboutCad'])->name('sobre.cad');
        Route::get('/prevencion-sismos', [HomeController::class, 'sismos'])->name('sismos');

        // Directorios CAD y CAU
        Route::get('/centros', [CadController::class, 'index'])->name('centros.index');
        Route::get('/centros/{code}', [CadController::class, 'show'])->name('centros.detalle');
        Route::get('/cau', [CadController::class, 'cauIndex'])->name('cau.index');

        // Módulos Dinámicos Informativos
        Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');
        Route::get('/noticias', [PublicNewsController::class, 'index'])->name('noticias.index');
        Route::get('/noticias/{slug}', [PublicNewsController::class, 'show'])->name('noticias.detalle');
        Route::get('/recursos-digitales', [PublicResourceController::class, 'index'])->name('recursos.index');
    });

// --------------------------------------------------------------------------
// 3. RUTAS DE AUTENTICACIÓN (Laravel Auth)
// --------------------------------------------------------------------------
Auth::routes();