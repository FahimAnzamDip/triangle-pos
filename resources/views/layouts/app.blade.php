<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') || {{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- Dropezone CSS -->
    <link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
    <!-- CoreUI CSS -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    @yield('third_party_stylesheets')

    @livewireStyles

    @stack('page_css')

    <style>
        div.dataTables_wrapper div.dataTables_length select {
            width: 65px;
            display: inline-block;
        }
    </style>
</head>

<body class="c-app">
    @include('layouts.sidebar')

    <div class="c-wrapper">
        <header class="c-header c-header-light c-header-fixed">
            @include('layouts.header')
            <div class="c-subheader justify-content-between px-3">
                @yield('breadcrumb')
            </div>
        </header>

        <div class="c-body">
            <main class="c-main">
                @yield('content')
            </main>
        </div>

        @include('layouts.footer')
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.4.0/perfect-scrollbar.js"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

    @include('sweetalert::alert')

    @yield('third_party_scripts')

    @livewireScripts

    @stack('page_scripts')

</body>
</html>
