<?php

namespace Hitman\Elasticsearch;

use Illuminate\Support\ServiceProvider;

class EsLogServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([ __DIR__ . '/../config/eslog.php' => config_path('eslog.php') ]);
    }

    public function register()
    {
        $this->app->singleton('eslog', function($app){
            return new EsLog();
        });
    }
}
