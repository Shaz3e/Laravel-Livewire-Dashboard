<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }} | {{ config('app.name') }}</title>
    
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    @stack('styles')

    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition sidebar-mini">

    <!-- Site wrapper -->
    <div class="wrapper">
        <x-header />

        <x-sidebar />

        {{ $slot }}

        <x-footer />
    </div>
    <!-- ./wrapper -->

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    
    @stack('scripts')

    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>

</html>
