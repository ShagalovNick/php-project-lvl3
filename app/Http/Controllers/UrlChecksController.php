<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;
use DiDom\Document;

class UrlChecksController extends Controller
{
      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request  $request)
    {
        $pathArray = explode('/', $request->path());
        $urlId = $pathArray[1];
        $name = DB::table('urls')->where('id', $urlId)->value('name');
        try {
            $response = Http::timeout(8)->get(trim($name));
        } catch (ConnectionException $exception) {
            flash($exception->getMessage())->error();
            return back()->withError($exception->getMessage())->withInput();
        }
        $document = new Document(trim($name), true);
        if ($document->has('h1')) {
        $h1 = $document->find('h1')[0]->text();
        } else {
            $h1 = '';
        }

        if ($document->has('title')) {
            $title = $document->find('title')[0]->text();
            } else {
                $title = '';
            }
            
        if ($document->has('meta[name="description"]')){
            $description = $document->find('meta[name="description"]')[0]
                                ->getAttribute('content');
        } else {
            $description = '';
        }            

        $status = $response->status();
        $timeNow = Carbon::now()->toDateTimeString();
        DB::table('url_checks')->insertGetId(
            ['url_id' => $urlId,
            'status_code' => $status,
            'h1' => $h1,
            'title' => $title,
            'description' => $description,
            'created_at' => $timeNow]
        );
        flash('Страница успешно проверена');
        //return Redirect::route('main');
        return Redirect::route('urls_show', ['id' => $urlId]);
        //return view('urls.show', ['id' => $urlId, 'name' => $name, 'created_at' => '']);
    }

}
