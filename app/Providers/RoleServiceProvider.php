<?php
/**
 *
 * RoleServiceProvider, dice a cuáles vistas se manda el menú de cada perfil
 * Autor
 * Fecha de creación
 * Última actualización
 * Versión de la clase
 *
 */
namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class RoleServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
      View::composer('*', 'App\Http\ViewComposers\RoleComposer');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }
}
