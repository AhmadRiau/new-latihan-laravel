<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class DependencyInjectionTest extends TestCase
{
    public function testDependInjection(){
        $this->app->singleton(Foo::class, function($app) {
            return new Foo();
        });
        $this->app->singleton(Bar::class, function($app) {
            $foo = $app->make(Foo::class);
            return new Bar($foo);
        });
        
        $foo = $this->app->make(Foo::class); 
        $bar1 = $this->app->make(Bar::class); 
        $bar2 = $this->app->make(Bar::class);
        
        self::assertEquals("foo and bar", $bar1->bar());
        self::assertSame($foo, $bar1->foo); 
        self::assertSame($bar1, $bar2); 
    }
}
