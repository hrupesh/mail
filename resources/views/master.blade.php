<html lang="{{ app()->getLocale() }}">
    <head>
        <style>
            canvas:focus {
            outline: none;
        }
        
        canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            box-shadow: 0px 0px 0px #151
        }
        body {
            margin: 0px;
            font-size: 75%;
            background: #222;
            font-family: arial;
            padding: 0px 0 0 0px
        }
        </style>
        <title>@yield('title')</title>
        <link rel="icon" href="sclogo.jpg">
        <link rel="stylesheet" href="{{ URL::to('css/main.css') }}">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Oleo+Script' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Lobster+Two' rel='stylesheet' type='text/css'>        
    </head>
    <body >
        @include('includes.header')
        <br>
        <br>
        <hr>
        @yield('content')
        @include('includes.footer')
    </body>
</html>
