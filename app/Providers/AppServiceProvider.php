<?php

namespace App\Providers;
use Faker\Factory;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\ParameterBag;
use Yajra\DataTables\Html\Builder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Builder::useVite();

        $this->app->bind(Factory::class,static fn () =>(new Factory())->withOptions(['verify'=>false]));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        $request =  request();
        $debug              =   !empty($request['debug'])?$request['debug']:0;
        if ($debug){
            config(['app.debug'=>true]);
        }
    }
}
