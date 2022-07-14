<!-- resources/views/urls/create.blade.php -->
<?php

// Вывод формы добавления сайта
?>

@extends('layouts.app')

@section('content')

  <!-- Bootstrap шаблон... -->

    <!-- Отображение ошибок проверки ввода -->
  @include('common.errors')
    <!-- Форма добавления сайта -->
    <main class="flex-grow-1">
    <div class="container-lg mt-3">
      <div class="row">
        <div class="col-12 col-md-10 col-lg-8 mx-auto border rounded-3 bg-light p-5">
          <h1 class="display-3">Анализатор страниц</h1>
          <p class="lead">Бесплатно проверяйте сайты на SEO пригодность</p>
          
          <form class="d-flex justify-content-center" action="/urls" method="POST" class="form-horizontal">
          @csrf
           
      {{ csrf_field() }}
      <!-- Имя сайта -->
            <input class="form-control form-control-lg" type="text" 
            name="url[name]" placeholder="https://www.example.com">
             
      <!-- Кнопка добавления сайта -->
            <input class="btn btn-primary btn-lg ms-3 px-5 text-uppercase mx-3" type="submit" value="Проверить">
          </form>
        </div>
      </div>
    </div>
  </main>  

  <!-- TODO: Добавленные сайты -->
@endsection