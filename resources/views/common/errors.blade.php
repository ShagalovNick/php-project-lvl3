<!-- resources/views/common/errors.blade.php -->

@if (count($errors) > 0)
  <!-- Список ошибок формы -->
  <div class="alert alert-danger" role="alert">
    
    @foreach ($errors->all() as $error)
      {{ $error }}
    @endforeach
  
  </div>
@endif