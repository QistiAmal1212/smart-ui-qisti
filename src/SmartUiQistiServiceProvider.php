<?php

namespace Qisti\SmartUi;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;


class SmartUiQistiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/smartuiqisti.php', 'smartuiqisti');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'smartuiqisti');

        // only if just blade thing
        // Blade::anonymousComponentPath(__DIR__ . '/../resources/views/components', 'smartuiqisti');

        Blade::componentNamespace(__NAMESPACE__ . '\\Components', 'smartuiqisti');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/smartuiqisti.php' => config_path('smartuiqisti.php'),
            ], 'smartuiqisti-config');

            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/smartuiqisti'),
            ], 'smartuiqisti-views');

            $this->publishes([
                __DIR__ . '/../resources/css/app.css' => resource_path('css/smartuiqisti/app.css'),
            ], 'smartuiqisti-assets');
        }
    }
}
