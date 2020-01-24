<?php

namespace WebDelivery\Providers;

use Illuminate\Support\ServiceProvider;
use Faker\Generator as FakerGenerator;
use Faker\Factory as FakerFactory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Dmitrovskiy\IonicPush\PushProcessor', function (){
            return new \Dmitrovskiy\IonicPush\PushProcessor(env('IONIC_PROFILE'), env('IONIC_JWT_TOKEN'));
        });

        $this->app->singleton(FakerGenerator::class, function () {
            return FakerFactory::create('pt_BR');
        });
    }
}
