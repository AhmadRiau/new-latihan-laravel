<?php

namespace App\Services;

class HelloServiceImplement implements HelloService
{
   public function hello(string $name): string
   {
      return 'Hello ' . $name;
   }
}