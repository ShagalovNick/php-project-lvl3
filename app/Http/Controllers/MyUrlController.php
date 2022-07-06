<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UrlController extends Controller
{
    /**
 * Отображение списка всех сайтов.
 *
 * @param  Request  $request
 * @return Response
 */
public function create(Request $request)
{
  return view('urls.index');
}

/**
 * Добавление сайта.
 *
 * @param  Request  $request
 * @return Response
 */
public function store(Request $request)
{
  echo 'this is request';
  dump($request);
  $validated = $request->validate([
    'url.name' => 'required',
    '*.name' => 'bail|unique:urls|max:255',
    //'name' => 'required|unique:urls|max:255',
  ]);
  dump($validated);

  // Создание записи...
}

}

