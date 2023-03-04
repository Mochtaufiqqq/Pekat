<head>
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="icon" href="/images/lapekat2.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('/user/css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('/user/css/laporan.css') }}">

    <title>LAPEKAT | @yield('title')</title>
</head>