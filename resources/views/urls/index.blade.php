<!-- resources/views/urls/index.blade.php -->

@extends('layouts.app')

@section('content')

  <!-- Bootstrap шаблон... -->

    <!-- Отображение ошибок проверки ввода -->
  @include('common.errors')
    <!-- Форма добавления сайта -->
  <main class="flex-grow-1">
    <div class="container-lg">
        <h1 class="mt-5 mb-3">Сайты</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-nowrap">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Последняя проверка</th>
                        <th>Код ответа</th>
                    </tr>

                    <?php
                    
                    $count = count($urls);
                    foreach ($urls as $url) : ?>
                        <tr>
                            <td><?= $url->id ?></td>
                            <td><a href="/urls/<?= $url->id ?>"><?= $url->name ?></a></td>
                            <td><?= $url->last_url_check ?></td>
                            <td><?= $url->status_code ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <nav class="d-flex justify-items-center justify-content-between">

            </nav>
        </div>
    </div>
  </main>  

  <!-- TODO: Добавленные сайты -->
@endsection