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
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
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
//        Route::prefix('api')
//             ->middleware('api')
//             ->namespace($this->namespace . '\API')
//             ->group(base_path('routes/api.php'));


        Route::group([
            'middleware' => ['api'],
        ], function () {

            // 鉴权
            Route::group([
                'namespace' => $this->namespace . '\API',
                'prefix' => 'api'
            ], function($router) {
                require  base_path('routes/api.auth.php');
            });


            // 此分组下的路由皆会被权限管理
            Route::group([
                'middleware' => 'auth:api'
            ], function () {
                // 这个分组比较屌，属于根分组，应该是放一些没有具体类型的功能
                Route::group([
                    'namespace' => $this->namespace . '\API',
                    'prefix' => 'api'
                ], function ($router) {
                    require base_path('routes/api.php');
                });



            });

        });

    }
}
