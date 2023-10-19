<?php

namespace Modules\DreamPaladin\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Modules\Homedy\Http\Middleware\Auth;

class RouteServiceProvider extends ServiceProvider
{
    protected string $moduleNamespace = 'Modules\DreamPaladin\Http\Controllers';

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
            ->namespace($this->moduleNamespace)
            ->group(module_path('/Routes/web.php'));
    }
}
