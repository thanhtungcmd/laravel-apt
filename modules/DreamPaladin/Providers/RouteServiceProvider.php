<?php

namespace Modules\DreamPaladin\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Modules\DreamPaladin\Http\Middleware\Auth;

class RouteServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        try {
            parent::boot();
            $router = $this->app->make(Router::class);
            $router->aliasMiddleware('auth', Auth::class);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function map(): void
    {
        $this->mapWebRoutes();
    }

    protected function mapWebRoutes(): void
    {
        Route::middleware('web')
            ->namespace(module_namespace())
            ->group(module_path('/Routes/web.php'));
    }
}
