<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{ URL::to('src/css/bootstrap.min.css') }}" media="screen" title="no title" charset="utf-8">
        <link rel="stylesheet" href="{{ URL::to('src/css/main.css') }}" media="screen" title="no title" charset="utf-8">
        <link rel="stylesheet" href="{{ URL::to('src/css/style.css') }}" media="screen" title="no title" charset="utf-8">

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
