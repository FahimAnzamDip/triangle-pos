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
    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #D8DBE0;
        border-radius: 4px;
    }
    .select2-container--default .select2-selection--multiple {
        background-color: #fff;
        border: 1px solid #D8DBE0;
        border-radius: 4px;
    }
    .select2-container .select2-selection--multiple {
        height: 35px;
    }
    .select2-container .select2-selection--single {
        height: 35px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 33px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        margin-top: 2px;
    }
</style>
