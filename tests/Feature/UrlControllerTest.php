<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use App\Http\Controllers\UrlController;

class UrlControllerTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    /**
     * @expectedException PHPUnit\Framework\Error\Error
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
        $response->assertStatus(302);
    }

    public function testStoreUrlController3()
    {
        $exData = ['url' => ['name' => "https://yaNAS.ru/urls?page=2"]];
        $response = $this->followingRedirects()->post('/urls', $exData);
        $body = $response->getContent() ?? '';
        $this->assertStringContainsString(" Страница успешно добавлена", $body);
        $response->assertStatus(200);

        $exData2 = ['url' => ['name' => "https://yaNAS.ru/urls?page=3"]];
        $response = $this->followingRedirects()->post('/urls', $exData2);
        $body = $response->getContent() ?? '';
        $this->assertStringContainsString("Страница уже существует", $body);
        $response->assertStatus(200);

        $exData3 = ['url' => ['name' => ""]];
        $response = $this->followingRedirects()->post('/urls', $exData3);
        $body = $response->getContent() ?? '';
        $this->assertStringContainsString("Некорректный URL", $body);
        $response->assertStatus(200);

        $exData4 = ['url' => ['name' => "hjgfdjskjsdakjsdvkjbsdvkjdsvkjsdvkjbdsvkjbbd
        skjbdskjbsdvkjbsdvkjbdsvkjbdsvkjbdsvkjbdvskjbsdvkjbsdvkjdvbskjsdvbsdkvjbsdvkjbh
        jgfdjskjsdakjsdvkjbsdvkjdsvkjsdvkjbdsvkjbbdskjbdskjbsdvkjbsdvkjbdsvkjbdsvkjbdsv
        kjbdvskjbsdvkjbsdvkjdvbskjsdvbsdkvjbsdvkjbdffdnfnfmgfgm"]];
        $response = $this->followingRedirects()->post('/urls', $exData4);
        $body = $response->getContent() ?? '';
        $this->assertStringContainsString("Некорректный URL", $body);
        $response->assertStatus(200);
    }

    public function testShowUrlController()
    {
        $exData = ['url' => ['name' => "https://yaNAS.ru/urls?page=3"]];
        $response = $this->followingRedirects()->post('/urls', $exData);
        $body = $response->getContent() ?? '';
        $this->assertStringContainsString("https://yanas.ru", $body);
        $response->assertStatus(200);

        $response = $this->get('urls/1', [UrlController::class, 'show']);
        $body = $response->getContent() ?? '';
        $this->assertStringContainsString("https://yanas.ru", $body);
        $response->assertStatus(200);

        $response = $this->get('urls/12', [UrlController::class, 'show']);
        $response->assertStatus(404);
    }
}
