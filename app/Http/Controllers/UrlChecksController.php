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
      /**
     * Store a newly created check in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*public function store(int $urlId)
    {
        //$url = DB::table('urls')->find($urlId);
        $name = DB::table('urls')->where('id', $urlId)->value('name');
        abort_unless($name, 404);
        //$pathArray = explode('/', $request->path());
        //$urlId = $pathArray[1];
        //$name = DB::table('urls')->where('id', $urlId)->value('name');
        try {
            $response = Http::timeout(8)->get(trim($name));
        } catch (ConnectionException $exception) {
            flash($exception->getMessage())->error();
            return back()->withError($exception->getMessage())->withInput();
        }
        $document = new Document(trim($name), true);
        //if ($document->has('h1')) {
        $h1 = optional($document->find('h1')[0])->text();
        //} else {
        //    $h1 = '';
        //}

        //if ($document->has('title')) {
        $title = optional($document->find('title')[0])->text();
        //} else {
        //    $title = '';
        //}

        //if ($document->has('meta[name="description"]')) {
        $description = optional($document->find('meta[name="description"]')[0])
                                ->getAttribute('content');
        //} else {
        //    $description = '';
        //}

        $status = $response->status();
        //$timeNow = Carbon::now()->toDateTimeString();
        $timeNow = Carbon::now();
        //DB::table('url_checks')->insertGetId(
        DB::table('url_checks')->insert(
            ['url_id' => $urlId,
            'status_code' => $status,
            'h1' => trim($h1),
            'title' => trim($title),
            'description' => trim($description),
            'created_at' => $timeNow]
        );
        flash('Страница успешно проверена');
        return Redirect::route('urls_show', ['id' => $urlId]);
    }*/
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
