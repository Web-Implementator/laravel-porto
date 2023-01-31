<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}" />
    <title>{{env('APP_NAME')}}</title>
    @vite('resources/sass/app.scss')
</head>
<body>
    @if (Auth::check())
    <script>
        window.Laravel = {!! json_encode([
            'isAuth' => true,
            'user' => Auth::user()
        ]) !!}
    </script>
    @else
    <script>
        window.Laravel = {!! json_encode([
                'isAuth' => false
            ]) !!}
    </script>
    @endif

    <div id="app">
    </div>

    @vite('resources/js/app.js')
</body>
</html>
