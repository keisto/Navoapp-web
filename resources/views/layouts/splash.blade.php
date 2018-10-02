<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Navo') }}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700|Roboto:100,100i,400,400i,700,700i,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,400i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist/calendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/semantic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script defer src="fonts/js/fontawesome-all.js"></script>
</head>
<body>

 @yield('content')

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('dist/semantic.js') }}"></script>
<script src="{{ asset('dist/calendar.min.js') }}"></script>
@yield('scripts')
</body>
</html>
