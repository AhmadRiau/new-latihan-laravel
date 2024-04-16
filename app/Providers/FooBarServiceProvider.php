<?php

namespace App\Providers;

use App\Data\Bar;
use App\Data\Foo;
use App\Services\HelloService;
use App\Services\HelloServiceImplement;
use Illuminate\Support\ServiceProvider;

class FooBarServiceProvider extends ServiceProvider
{

    public array $singletons = [
        HelloService::class => HelloServiceImplement::class
    ];

    public function register()
    {
        $this->app->singleton(Foo::class, function($app){
            return new Foo();
        });
        $this->app->singleton(Bar::class, function($app){
            return new Bar($app->make(Foo::class));
        });
    }
    
    public function boot()
    {
        
    }
}
