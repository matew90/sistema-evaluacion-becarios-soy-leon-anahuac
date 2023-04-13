<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', 'login');
Route::get('mail', 'App\Http\Controllers\ReservaEspacios\MailController@index');


Route::get('administrativos', 'App\Http\Controllers\Import\ImportController@index');
Route::post('administrativos/import', 'App\Http\Controllers\Import\ImportController@import');


Route::group(['middleware' => ['web', 'guest'], 'namespace' => 'App\Http\Controllers\Auth'], function () {
    Route::get('login', 'AuthController@login')->name('login');
    Route::get('connect', 'AuthController@connect')->name('connect');
});

Route::group(['middleware' => ['web', 'MsGraphAuthenticated'], 'namespace' => 'App\Http\Controllers'], function () {
    Route::get('/', 'PagesController@app')->name('app');
    Route::get('/inicio', 'General\DashboardController@init')->name('main-dashboard');
    Route::get('logout', 'Auth\AuthController@logout')->name('logout');

    Route::prefix('administrador')->name('admin.')->group(function () {
        // Menu
        Route::controller(General\MenuController::class)->prefix('menu')->name('menu.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/crear', 'create')->name('create');
            Route::post('/crear', 'store')->name('store');
            Route::get('/mostrar/{id}', 'show')->name('show');
        });

        // Submenu
        Route::controller(General\SubmenuController::class)->prefix('submenu')->name('submenu.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/crear', 'create')->name('create');
            Route::post('/crear', 'store')->name('store');
            Route::get('/mostrar/{id}', 'show')->name('show');
            Route::get('/editar/{id}', 'edit')->name('edit');
            Route::post('/editar/{id}', 'update')->name('update');
        });

        // Roles
        Route::controller(General\RolesController::class)->prefix('roles')->name('role.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/crear', 'create')->name('create');
            Route::post('/crear', 'store')->name('store');
        });
    });
    // Reserva Espacios
    Route::prefix('reserva-espacios')->name('reserva-espacios.')->group(function () {
        // Reservas
        Route::controller(ReservaEspacios\ReservaController::class)->prefix('reserva')->name('reserva.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/crear', 'create')->name('create');
            Route::post('/preview', 'preview')->name('preview');
            Route::get('/mostrar/{spa_uID}', 'show')->name('show');
            Route::post('/crear', 'store')->name('store');
            Route::post('/editar', 'update')->name('update');
        });

        // Reservaciones
        Route::controller(ReservaEspacios\ReservacionesController::class)->prefix('reservaciones')->name('reservaciones.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/mostrar', 'show')->name('show');
            Route::post('/mostrar/{res_uID}', 'view')->name('view');
        });

        // Espacios
        Route::controller(ReservaEspacios\SpacesController::class)->prefix('espacios')->name('espacios.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/mostrar', 'show')->name('show');
            Route::get('/crear', 'create')->name('create');
            Route::post('/crear', 'store')->name('store');
            Route::post('/mostrar/{spa_uID}', 'view')->name('view');
            Route::post('/eliminar/{spa_uID}', 'delete')->name('delete');
            Route::post('/editar', 'edit')->name('edit');
        });

        // Inventario
        Route::controller(ReservaEspacios\InventoryController::class)->prefix('inventario')->name('inventario.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/mostrar', 'show')->name('show');
            Route::get('/crear', 'create')->name('create');
            Route::post('/crear', 'store')->name('store');
            Route::post('/mostrar/{inv_uID}', 'view')->name('view');
            Route::post('/eliminar/{inv_uID}', 'delete')->name('delete');
            Route::post('/editar', 'edit')->name('edit');
        });

        // Calendario Mensual
        Route::controller(ReservaEspacios\MesController::class)->prefix('mensual')->name('mensual.')->group(function () {
            Route::get('/', 'show')->name('show');
            Route::get('/mensual/{start}', 'view')->name('view');
        });

        // Calendario Semanal
        Route::controller(ReservaEspacios\SemanalController::class)->prefix('semanal')->name('semanal.')->group(function () {
            Route::get('/', 'show')->name('show');
            Route::get('/semanal/{res_uID}', 'view')->name('view');
            Route::post('/eliminar/{res_uID}', 'delete')->name('delete');
            Route::get('/editar/{res_uID}', 'edit')->name('edit');
        });

        // Calendario Día
        Route::controller(ReservaEspacios\DiaController::class)->prefix('dia')->name('dia.')->group(function () {
            Route::get('/', 'show')->name('show');
            Route::get('/dia/{res_uID}', 'view')->name('view');
            Route::post('/eliminar/{res_uID}', 'delete')->name('delete');
            Route::get('/editar/{res_uID}', 'edit')->name('edit');
        });

    });
    // Evaluación becarios
    Route::prefix('evaluacion-becarios')->name('evaluacion-becarios.')->group(function () {
      // Rutas convocatorias
      Route::controller(scholarshipEvaluation\administrator\ConvocatoriaController::class)->prefix('convocatoria')->name('convocatoria-becarios.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/crear', 'create')->name('create');
        Route::post('/crear', 'store')->name('store');
        Route::post('/export', 'export')->name('export');
        Route::post('store_evaluation', 'store_evaluation')->name('store_evaluation');
        Route::post('/historial/asignar', 'asignar')->name('asignar');
        Route::get('/evaluations1/{assig_uID}', 'evaluations1')->name('evaluations1');
        Route::get('/evaluations/{assig_uID}', 'evaluations')->name('evaluations');
        Route::get('/editar/{conv}/edit', 'edit')->name('edit');
        Route::put('/update/{conv}', 'update')->name('update');
        Route::post('/eliminar/{assig_uID}', 'delete')->name('delete');
        Route::post('/borrar/{conv}', 'delete_conv')->name('delete_conv');
        Route::get('/evaluaciones/{conv?}', 'evaluaciones')->name('evaluaciones');
        Route::get('/asignaciones/{conv}', 'asignaciones')->name('asignaciones');
        Route::get('/mostrar/{conv}', 'student')->name('student');
        Route::get('/historial/{conv}/{assig?}', 'show')->name('show');
      });

      // Rutas Coordinador/Evaluador
      Route::controller(scholarshipEvaluation\administrator\CoordinadorEvaluadorController::class)->prefix('coordinador-evaluador')->name('coordinador-evaluador.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/crear', 'create')->name('create');
        Route::post('/evaluador', 'evaluador')->name('evaluador');
        Route::post('/crear', 'store')->name('store');
        Route::get('/mostrar', 'show')->name('show');
        Route::post('/import', 'import')->name('import');
        Route::post('/eliminar/{coord_uID}/{conv?}', 'delete')->name('delete');
        Route::get('/editar/{us_uID}/{conv?}', 'edit')->name('edit');
        Route::post('/update/{user}/{conv?}', 'update')->name('update');

      });

      //Rutas Becarios
      Route::controller(scholarshipEvaluation\administrator\BecariosController::class)->prefix('becarios')->name('becarios.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/crear', 'create')->name('create');
        Route::post('/crear', 'store')->name('store');
        Route::get('/mostrar/{conv}', 'show')->name('show');
        Route::post('/import', 'import')->name('import');
        Route::post('/eliminar/{us_uID}/{conv?}', 'delete')->name('delete');
        Route::get('/editar/{user}/{conv?}', 'edit')->name('edit');
        Route::post('/update/{user}/{conv?}', 'update')->name('update');
      });
    });
});
