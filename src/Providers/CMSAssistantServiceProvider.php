<?php

namespace Rahweb\CmsAssistant\Providers;

use Illuminate\Support\ServiceProvider;

class CMSAssistantServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom((dirname(__DIR__) . '/Routes/web.php'));
        $this->loadViewsFrom((dirname(__DIR__, 2) . '/views'), '');
    }

    public function register()
    {
        $this->publishFiles();
    }

    private function publishFiles(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                (dirname(__DIR__,2) . '/config/cms-assistant.php') => app_path('config'),
            ]);
        }
    }
}
