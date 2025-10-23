<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * El espacio de nombres que se asigna a las rutas.
     *
     * @var string
     */
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * Cargar las rutas para la aplicación.
     *
     * @return void
     */
    public function map()
    {
        $this->mapWebRoutes();
        $this->mapApiRoutes();
    }

    /**
     * Define las rutas para la sección web de la aplicación.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define las rutas para la sección de API de la aplicación.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')   // El prefijo 'api' será agregado a todas las rutas API
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
