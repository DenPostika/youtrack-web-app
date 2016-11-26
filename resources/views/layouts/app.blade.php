<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="public/css/app.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/public/css/bootstrap-material-design.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/public/css/ripples.min.css') }}">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
  <div class="container-fluid">
    <div id="app">

        @yield('side_menu')
        @yield('content')
    </div>
    </div>

    <!-- Scripts -->

  <script src="{{ asset('/public/js/app.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/public/js/material.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/public/js/ripples.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/public/js/main.js') }}"></script>
  <script type="text/javascript">
    $.material.init()
  </script>
</body>
</html>
