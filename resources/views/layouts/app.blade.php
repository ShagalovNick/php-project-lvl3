<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Анализатор страниц</title>

    <!-- CSS и JavaScript -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

  </head>

  <body class="min-vh-100 d-flex flex-column">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark px-3">
        <!-- Содержимое Navbar -->
      <a class="navbar-brand" href="/">
        Анализатор страниц</a>
        <div id="navbarNav" class="collapse navbar-collapse">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href="/">
                Главная</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="/urls">
              Сайты</a>
            </li>
          </ul>
        </div>
    </nav>

    @yield('content')
    <footer class="border-top py-3 mt-5 flex-shrink-0">
      <div class="container-lg">
        <div class="text-center">
          <a href="https://hexlet.io/pages/about" target="_blank">Hexlet</a>
        </div>
      </div>
    </footer>
  </body>
</html>