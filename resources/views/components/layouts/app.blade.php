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

    {{-- <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

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

    {{-- <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script> --}}
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

    <script>
        // Livewire Events
        document.addEventListener('livewire:init', () => {
            // close modal when user created
            Livewire.on('created', (event) => {
                $('#createModal').modal('hide');
            });
            // close modal when user updated
            Livewire.on('updated', (event) => {
                $('#updateModal').modal('hide');
            });
            // close mdal when user not found
            Livewire.on('not-found', (event) => {
                $('#createModal').modal('hide');
                $('#updateModal').modal('hide');
            });
            // close modal when user is delete
            Livewire.on('deleted', (event) => {
                $('#deleteModal').modal('hide');
            });
            // show confirm modal
            Livewire.on('showDeleteConfirmation', (event) => {
                $('#deleteModal').modal('show');
            });
            // show cancel deletion action modal
            Livewire.on('hideDeleteConfirmation', (event) => {
                $('#deleteModal').modal('hide');
            });

            // Sweet Alert
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            // Show success message
            Livewire.on('success', (message) => {
                // toastr.success(message);
                Toast.fire({
                    icon: 'success',
                    title: message
                })
            });

            // Show error message
            Livewire.on('error', (message) => {
                // toastr.error(message);
                Toast.fire({
                    icon: 'error',
                    title: message
                })
            });

            // Show warning message
            Livewire.on('warning', (message) => {
                // toastr.warning(message);
                Toast.fire({
                    icon: 'warning',
                    title: message
                })
            });

            // Show info message
            Livewire.on('info', (message) => {
                // toastr.info(message);
                Toast.fire({
                    icon: 'info',
                    title: message
                })
            });
        });
    </script>

</body>

</html>
