<html>

  <head>
    <title>Login Clothes Shop</title>
    
    <link rel="stylesheet" href="{{ asset('css/login-user.css') }}">
    <!-- Bootstrap core CSS-->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    
  </head>
  
  <body>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    
    
    <div class="container">
      @yield('content')
    </div>
    
  </body>

</html>
