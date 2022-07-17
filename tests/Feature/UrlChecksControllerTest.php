<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class UrlChecksControllerTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    /**
     * Tests UrlChecksController.
     *
     * @return void
     */
    public function testStoreUrlChecksController()
    {

        DB::table('urls')->insertGetId(
            ['name' => 'https://ya.ru', 'created_at' => '1908-01-01']
        );

        $pathToHtml = __DIR__ . '/../fixtures/page.html';
        $fakeHtml = file_get_contents($pathToHtml);

        Http::fake([
            'https://ya.ru' => Http::response($fakeHtml, 200, ['Headers' => '']),
        ]);

        $response = $this->followingRedirects()->post('/urls/1/checks');
        $body = $response->getContent();
        $this->assertStringContainsString("Заголовок", $body);
        $this->assertStringContainsString("Заголовок страницы", $body);
        $this->assertStringContainsString("Описание", $body);
        $this->assertDatabaseHas('url_checks', ['h1' => "Заголовок"]);
        $response->assertStatus(200);
    }
}
