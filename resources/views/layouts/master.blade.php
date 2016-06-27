<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ URL::to('src/css/main.css') }}" media="screen" title="no title" charset="utf-8">
    </head>
    <body>
      @include('includes.header')
        <div class="container">
            @yield('content')
        </div>

        <script src="{{ URL::to('src/js/jquery-1.12.4.min.js') }}"></script>
        <script src="{{ URL::to('src/js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::to('src/js/app.js') }}"></script>
    </body>

</html>
