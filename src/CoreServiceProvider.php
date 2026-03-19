<?php

namespace Systha\Core;

use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/core.php', 'systha_core');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/core.php' => config_path('systha-core.php'),
        ], 'systha-core-config');

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->commands($this->discoverCommands());
        }
    }

    private function discoverCommands(): array
    {
        $commands = [];
        $namespace = __NAMESPACE__ . '\\Commands\\';

        foreach (glob(__DIR__ . '/Commands/*Command.php') as $file) {
            $class = $namespace . pathinfo($file, PATHINFO_FILENAME);

            if (class_exists($class)) {
                $commands[] = $class;
            }
        }

        return $commands;
    }
}
