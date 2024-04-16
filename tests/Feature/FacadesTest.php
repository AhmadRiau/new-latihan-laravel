<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FacadesTest extends TestCase
{
    public function testFacadesConfig()
    {
        $firstname1 = config('contoh.author.first');
        $firstname2 = Config::get('contoh.author.first');

        self::assertEquals($firstname1, $firstname2);
    }

    public function testConfigMock()
    {
        Config::shouldReceive('get')
            ->with('contoh.author.first')
            ->andReturn('John');
        
        $firstname =  Config::get('contoh.author.first');
        self::assertEquals($firstname, 'John');

    }
}
