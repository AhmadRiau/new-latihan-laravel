<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BasicRoutingTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRoute()
    {
        $this->get('/test')
            ->assertStatus(200)
            ->assertSeeText('Good bye world');
    }

    public function testRedirect()
    {
        $this->get('/redirect')
            ->assertRedirect('/test');
    }

    public function testFallback() {
        $this->get('/*')
            ->assertSeeText('404 nothing here');
    }

    public function testView() {
        $this->get('/hello')
            ->assertSeeText('Hello and Good bye');
        
        $this->get('/hello-again')
            ->assertSeeText('Hello and Good bye');
    }
}
