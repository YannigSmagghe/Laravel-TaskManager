<?php

namespace Tests\Feature;


use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BasicTest extends DuskTestCase
{
    static $browse;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/login');
        $response->assertSeeText('Register');
        $response->assertStatus(200);
    }
}
