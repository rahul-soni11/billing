<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!--Later on it will be removed ><link href="{{ asset('css/app.css') }}" rel="stylesheet"-->
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href id="sale01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sale</a>
            <div class="dropdown-menu" aria-labelledby="sale01">
              <a class="dropdown-item" href="#">Sale Gold/Silver</a>
              <a class="dropdown-item" href="#">Sale Diamond jewellery</a>
              <a class="dropdown-item" href="#">Sale Gems and stone</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href id="purchase01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Purchase</a>
            <div class="dropdown-menu" aria-labelledby="purchase01">
              <a class="dropdown-item" href="#">Purchase Gold/Silver</a>
              <a class="dropdown-item" href="#">Purchase Diamond jewellery</a>
              <a class="dropdown-item" href="#">Purchase Gems and stone</a>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Expense</a>
          </li>

        </ul><!--Keep-->
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>


<main role="main" class="container">
    @yield('content')
</main><!-- /.container -->
        
    

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ asset('js/jquery-3.2.1.slim.min.js') }}" ></script>
    <!-- If all work well this should be removed --><script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  </body>
</body>
</html>
