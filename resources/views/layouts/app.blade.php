<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @include('template.css')
    @stack('css')

</head>
<body>
    @include('template.header')
    @include('template.sidebar')
    <main id="main" class="main">
        <section class="section dashboard">
            @yield('content')
        </section>
    </main>

@include('template.js')
@stack('js')
</body>
</html>
