<?php

namespace Modules\DreamPaladin\Providers;

use Dotenv\Dotenv;
use Illuminate\Support\Env;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Arr;

class DreamPaladinServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        $this->registerEnv();
        $this->registerConfig();
        $this->registerViews();
        $this->registerAssets();
        $this->registerTranslations();
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }

    protected function registerEnv(): void
    {
        $data = trim(file_get_contents(module_path(".env")));
        $env = Dotenv::parse($data);
        $repo = Env::getRepository();
        foreach ($env as $key => $value) {
            $repo->set($key, $value);
        }
    }

    protected function registerConfig(): void
    {
        $this->publishes([
            module_path('Config/config.php') => config_path(module_name_lower() . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Config/config.php'), module_name_lower()
        );
        $config = $this->app['config']->get('logging', []);
        $this->app['config']->set('logging', $this->mergeConfig($config, require module_path('Config/logging.php')));
    }

    protected function mergeConfig(array $original, array $merging): array
    {
        $array = array_merge($original, $merging);
        foreach ($original as $key => $value) {
            if (! is_array($value)) {
                continue;
            }
            if (! Arr::exists($merging, $key)) {
                continue;
            }
            if (is_numeric($key)) {
                continue;
            }
            $array[$key] = $this->mergeConfig($value, $merging[$key]);
        }
        return $array;
    }

    public function registerTranslations(): void
    {
        $this->loadTranslationsFrom(module_path('Resources/lang'), module_name_lower());
    }

    public function registerViews(): void
    {
        $viewPath = resource_path('views/modules/' . module_name_lower());

        $sourcePath = module_path('Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', module_name_lower() . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), module_name_lower());
    }

    public function registerAssets(): void
    {
        $viewPath = public_path(module_name_lower());

        $sourcePath = module_path('Resources/assets');

        $this->publishes([
            $sourcePath => $viewPath
        ], "assets");
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (config('view.paths') as $path) {
            if (is_dir($path . '/modules/' . module_name_lower())) {
                $paths[] = $path . '/modules/' . module_name_lower();
            }
        }
        return $paths;
    }

}
