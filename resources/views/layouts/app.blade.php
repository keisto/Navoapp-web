<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
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
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-8967968920199965",
            enable_page_level_ads: true
        });
    </script>

</head>
<body style="display: flex; flex-direction: column">
<div id="app" style="flex-grow: 1">
    @include('layouts.partials.alerts._alerts')
    @yield('content')
</div>
@include('layouts.partials._footer')
@include('layouts.partials._legal')
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('dist/semantic.js') }}"></script>
<script src="{{ asset('dist/calendar.min.js') }}"></script>
<script src="{{ asset('js/tablesorter.js') }}"></script>
@yield('scripts')
</body>
</html>
