<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UrlChecksControllerTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testStoreUrlController()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
