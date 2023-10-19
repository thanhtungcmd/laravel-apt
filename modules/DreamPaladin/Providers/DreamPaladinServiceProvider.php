<?php

namespace Modules\DreamPaladin\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Arr;

class DreamPaladinServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'DreamPaladin';

    public function boot(): void
    {
        $this->registerConfig();
        $this->registerViews();
        $this->registerAssets();
        $this->registerTranslations();
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }

    protected function registerConfig(): void
    {
        $this->publishes([
            module_path('Config/config.php') => config_path(strtolower($this->moduleName) . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Config/config.php'), strtolower($this->moduleName)
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
        $this->loadTranslationsFrom(module_path('Resources/lang'), strtolower($this->moduleName));
    }

    public function registerViews(): void
    {
        $viewPath = resource_path('views/modules/' . strtolower($this->moduleName));

        $sourcePath = module_path('Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', strtolower($this->moduleName) . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), strtolower($this->moduleName));
    }

    public function registerAssets(): void
    {
        $viewPath = public_path(strtolower($this->moduleName));

        $sourcePath = module_path('Resources/assets');

        $this->publishes([
            $sourcePath => $viewPath
        ], "assets");
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (config('view.paths') as $path) {
            if (is_dir($path . '/modules/' . strtolower($this->moduleName))) {
                $paths[] = $path . '/modules/' . strtolower($this->moduleName);
            }
        }
        return $paths;
    }

}
