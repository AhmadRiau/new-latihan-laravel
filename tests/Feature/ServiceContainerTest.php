<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceImplement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{  
  public function testBind(){
    $this->app->bind(Person::class, function($app){
      return new Person("John", "Doe");
    });
    
    $person1 = $this->app->make(Person::class); // call line 22-25
    $person2 = $this->app->make(Person::class);

    self::assertEquals("John", $person1->firstName);
    self::assertEquals("John", $person2->firstName);; 
    self::assertNotSame($person1, $person2); // bukan objek yang sama
  }

  public function testSingleton() {
    $this->app->singleton(Person::class, function($app) {
        return new Person('john', 'doe');
    });
    $person1 = $this->app->make(Person::class); // buat objek jika tidak ada
    $person2 = $this->app->make(Person::class); // panggil objek yang sama dengan yang pertama dibuat

    self::assertEquals("john", $person1->firstName);
    self::assertEquals("john", $person2->firstName);; 
    self::assertSame($person1, $person2); // objek yang sama digunakan
  }

  public function testInstance() {
      $person = new Person('john', 'doe');
      $this->app->instance(Person::class, $person);

      $person1 = $this->app->make(Person::class);
      $person2 = $this->app->make(Person::class);

      self::assertEquals("john", $person1->firstName);
      self::assertEquals("john", $person2->firstName);
      self::assertSame($person, $person1);
      self::assertSame($person1, $person2);
  }

  public function testInterfaceToClass() {
    $this->app->singleton(HelloService::class, HelloServiceImplement::class);
    
    $hello = $this->app->make(HelloService::class);

    self::assertEquals("Hello john", $hello->hello('john'));
  }
}
