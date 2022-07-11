<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;


class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $page = $request->get('page') ?? 0;
        $skip = ($page - 1) * 15;

        $latestCheck = DB::table('url_checks')
        ->select('url_id', 'status_code', DB::raw('MAX(created_at) as last_url_check'))
        ->groupBy('url_id');

        $urls = DB::table('urls')
        ->leftJoinSub($latestCheck, 'latest_check', function ($join) {
        $join->on('urls.id', '=', 'latest_check.url_id');
        })->skip($skip)->take(15)->get();

        return view('urls.index', ['page' => $page, 'urls' => $urls]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('urls.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'url.name' => 'required|max:255|starts_with:http',
        ]);

        $url = $request->input('url');
        $parsedUrl = parse_url($url['name']);
        $name = $parsedUrl['scheme'] . "://" . strtolower($parsedUrl['host']);

        $validatorUniq = Validator::make(['name' => $name], [
            'name' => 'bail|unique:urls',
        ]);

        if (!$validatorUniq->fails()) {
            $timeNow = Carbon::now()->toDateTimeString();
        DB::table('urls')->insertGetId(
            ['name' => $name, 'created_at' => $timeNow]
        );
        flash('Страница успешно добавлена');
        } else {
            flash('Страница уже существует');
        }
         
        $id = DB::table('urls')->where('name', $name)->value('id');
        return Redirect::route('urls_show', ['id' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $name = DB::table('urls')->where('id', $id)->value('name');
        if (!$name) {
            abort(404);
        }
        $date = DB::table('urls')->where('id', $id)->value('created_at');
        $checks = DB::table('url_checks')->where('url_id', $id)->skip(0)->take(10)->get();
        return view('urls.show', ['id' => $id, 'name' => $name, 'created_at' => $date, 'checks' => $checks]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
