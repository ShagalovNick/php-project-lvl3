<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Http\Client\HttpClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;
use DiDom\Document;

class UrlChecksController extends Controller
{
    public function store(int $id)
    {
        $url = DB::table('urls')->find($id);
        abort_unless($url, 404);

        try {
            $response = Http::get($url->name);
            $document = new Document($response->body());
            $h1 = optional($document->first('h1'))->text();
            $title = optional($document->first('title'))->text();
            $description = optional($document->first('meta[name=description]'))->getAttribute('content');

            DB::table('url_checks')->insert([
                'url_id' => $id,
                'created_at' => Carbon::now(),
                'status_code' => $response->status(),
                'h1' => $h1,
                'title' => $title,
                'description' => $description,
                ]);
            flash('Страница успешно проверена')->success();
        } catch (RequestException | HttpClientException | ConnectionException $exception) {
            flash(message: $exception->getMessage())->error();
        }
        return Redirect::route('urls_show', ['id' => $id]);
    }
}
