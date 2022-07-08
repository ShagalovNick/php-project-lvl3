<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;

class UrlControllerTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndexUrlController()
    {
    
        $response = $this->get('/urls');

        $response->assertStatus(200);
    }

    public function testCreateUrlController()
    {
        $response = $this->get('/');
        $response->assertOk();
    }

    public function testStoreUrlController1()
    {
        $exData = ['url' => ['name' => "https://yaNAS.ru/urls?page=2"]];
        $response = $this->post('/urls', $exData);
        $response->assertRedirect(route('urls_show', ['id' => 1]));
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('urls', ['name' => "https://yanas.ru"]);
    }

    public function testStoreUrlController2()
    {
        $exData = ['url' => ['name' => "htt://ya.ru"]];
        $response = $this->post('/urls', $exData);
        $this->assertDatabaseMissing('urls', $exData['url']);
    }
    
}
