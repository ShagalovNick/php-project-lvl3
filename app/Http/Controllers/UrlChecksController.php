<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;

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
            $response = Http::timeout(8)->get("$name");
        } catch (ConnectionException $exception) {
            flash($exception->getMessage())->error();
            return back()->withError($exception->getMessage())->withInput();
        }
        
        $status = $response->status();
        $timeNow = Carbon::now()->toDateTimeString();
        DB::table('url_checks')->insertGetId(
            ['url_id' => $urlId,
            'status_code' => $status,
            'h1' => '',
            'title' => '',
            'description' => '',
            'created_at' => $timeNow]
        );
        flash('Страница успешно проверена');
        //return Redirect::route('main');
        return Redirect::route('urls_show', ['id' => $urlId]);
        //return view('urls.show', ['id' => $urlId, 'name' => $name, 'created_at' => '']);
    }

}
