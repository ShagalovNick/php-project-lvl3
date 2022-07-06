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
        <h2 class="mt-5 mb-3"></h2>
        <form action=""></form>
    </div>
  </main>  

  <!-- TODO: Добавленные сайты -->
@endsection