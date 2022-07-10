<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;

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
        $timeNow = Carbon::now()->toDateTimeString();
        DB::table('url_checks')->insertGetId(
            ['url_id' => $urlId,
            'status_code' => 200,
            'h1' => '',
            'title' => '',
            'description' => '',
            'created_at' => $timeNow]
        );
        flash('Страница успешно проверена');
        $name = DB::table('urls')->where('id', $urlId)->value('name');
        //return Redirect::route('main');
        return Redirect::route('urls_show', ['id' => $urlId]);
        //return view('urls.show', ['id' => $urlId, 'name' => $name, 'created_at' => '']);
    }

}
