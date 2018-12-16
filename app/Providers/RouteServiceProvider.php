<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::domain(config('app.domain'))
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));

        Route::domain('owner.' . config('app.domain'))
            ->namespace($this->namespace)
            ->middleware('web')
            ->group((base_path('routes/owner.php')));

        Route::domain('owner.' . config('app.domain'))
            ->prefix('api')
            ->namespace($this->namespace)
            ->middleware('web')
            ->group((base_path('routes/owner_api.php')));

        Route::domain(config('app.domain'))
            ->prefix('api')
            ->namespace($this->namespace)
            ->middleware('web')
            ->group((base_path('routes/client_api.php')));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
