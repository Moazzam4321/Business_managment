<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminlte/adminlte.css') }}">
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar, sidebar, and content sections go here -->
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/adminlte/adminlte.js') }}"></script>
</body>
</html>