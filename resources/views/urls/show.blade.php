<!-- resources/views/urls/show.blade.php -->

@extends('layouts.app')

@section('content')

  <!-- Bootstrap шаблон... -->

    <!-- Отображение ошибок проверки ввода -->
  @include('common.errors')
  
    @include('flash::message')
    <!-- Форма добавления сайта -->
  <main class="flex-grow-1">
    <!--<div class="alert alert-info" role="alert">
    </div>-->
    <div class="container-lg">
        <h1 class="mt-5 mb-3">Сайт: {{ $name }} </h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-nowrap">
                <tbody>
                    <tr>
                        <td>ID</td>
                        <td>{{ $id }}</td>
                    </tr>
                    <tr>
                        <td>Имя</td>
                        <td> {{ $name }}</td>
                    </tr>
                    <tr>
                        <td>Дата создания</td>
                        <td>{{ $created_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <h2 class="mt-5 mb-3">Проверки</h2>
        <form action="/urls/{{ $id }}/checks" method="post">
        @csrf <!-- {{ csrf_field() }} -->
          <input class="btn btn-primary" type="submit" value="Запустить проверку">
        </form>
        <table class="table table-bordered table-hover text-nowrap">
          <tbody>
            <tr>
              <th>ID</th>
              <th>Код ответа</th>
              <th>h1</th>
              <th>title</th>
              <th>description</th>
              <th>Дата создания</th>
            </tr>
            <?php
              foreach ($checks as $check) : ?>
                <tr>
                  <td><?= $check->id ?></td>
                  <td><?= $check->status_code ?></td>
                  <td><?= $check->h1 ?></td>
                  <td><?= $check->title ?></td>
                  <td><?= $check->description ?></td>
                  <td><?= $check->created_at ?></td>
                </tr>
              <?php endforeach ?>
          </tbody>
        </table>
    </div>
  </main>  

  <!-- TODO: Добавленные сайты -->
@endsection