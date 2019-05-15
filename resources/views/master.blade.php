<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <title>@yield('title')</title>
        <!-- Latest compiled and minified CSS & JS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
            <span class="navbar-brand">FlightClub</span>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="">Pagina Principal</a></li>
            <li><a href="{{route('socios.index')}}">Sócios</a></li>
            <li><a href="{{route('aeronaves.index')}}">Aeronaves</a></li>
            <li><a href="{{route('movimentos.index')}}">Movimentos</a></li>
        </ul>
      </div>
    </nav>
    <div class="container">
        <div class="jumbotron">
            <h1>@yield('title')</h1>
            @if(Auth::check())
                @include('shared.menu')
            @endif
        </div>
        @if (session('sucesso'))
            @include('shared.sucesso')
        @endif
        @yield('content')
    </div>
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>
