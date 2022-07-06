<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\UrlController;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    if (!Schema::hasTable('urls'))
{
    Schema::create('urls', function ($table) {
        $table->increments('id');
        $table->char('name', 255);
        $table->timestamp('created_at');
    });
}
    //DB::insert('insert into urls (id, name, created_at) values (?, ?, ?)', [1, 'Marc']);
    $urls = DB::table('urls')->get();
    //$urls = DB::getDatabaseName();
    print_r($urls);
    return view('urls.index');
});

Route::get('/urls', function () {
    if (!Schema::hasTable('urls'))
{
    Schema::create('urls', function ($table) {
        $table->increments('id');
        $table->char('name', 255);
        $table->timestamp('created_at');
    });
}
    $urls = DB::table('urls')->get();
    //$urls = DB::getDatabaseName();
    print_r($urls);
    return view('urls.index');
});

Route::post('/urls', function (Request $request) {
    //$url = $request->getParsedBodyParam('url', '');
    //dump($request);
    $url = $request->input('url');
    //if ($url['name'] === 'sa') {
    //    return view('urls.index');
    //}
    //$validated = $request->validate($url, [
    $timeNow = Carbon::now()->toDateTimeString();
    DB::table('urls')->insertGetId(
        ['name' => $url['name'], 'created_at' => $timeNow]
    );
    //dump($url);
    return view('urls.index');
});*/

Route::get('/', [UrlController::class, 'create']);
Route::post('/urls', [UrlController::class, 'store']);
Route::get('urls/{id}', [UrlController::class, 'show'])->name('urls_show');
Route::get('/urls', [UrlController::class, 'index']);