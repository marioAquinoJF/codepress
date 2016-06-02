<?php

namespace CodePress\CodeUser\Providers;

use Illuminate\Support\ServiceProvider;
use CodePress\CodeUser\Routing\Router;
class CodeUserServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/auth.php' => base_path('config/auth.php')
                ], 'config');
        $this->publishes(
                [__DIR__ . '/../../config/auth.php' => base_path('config/auth.php')
                ], 'config');
        $this->publishes([
            __DIR__ . '/../../resources/views/auth' => base_path('resources/views/auth')
                ], 'auth');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views/codeuser', 'codeuser');
        require __DIR__ . '/../../routes.php';
    }

    public function register()
    {
        $this->app->bind(\CodePress\CodeUser\Repositories\UserRepositoryInterface::class, \CodePress\CodeUser\Repositories\UserRepositoryEloquent::class);
        $this->app->singleton("codepress_user_route", function() {
            return new Router();
        });
    }

}
