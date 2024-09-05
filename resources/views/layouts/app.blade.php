<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - @yield('title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{asset('backend')}}/img/favicon.png" rel="icon">
    <link href="{{asset('backend')}}/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('backend')}}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('backend')}}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{asset('backend')}}/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="{{asset('backend')}}/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="{{asset('backend')}}/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="{{asset('backend')}}/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="{{asset('backend')}}/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{asset('backend')}}/css/style.css" rel="stylesheet">
    <!-- Sweet alert 2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Include Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
    <!-- Include jQuery (required by Select2) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Include Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    @stack('style')
</head>

<body>


    @include('layouts.header')
    @include('layouts.sidebar')

    <main id="main" class="main" style="height: 100vh;">
        @yield('content')
    </main>
    @include('layouts.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{asset('backend')}}/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="{{asset('backend')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('backend')}}/vendor/chart.js/chart.umd.js"></script>
    <script src="{{asset('backend')}}/vendor/echarts/echarts.min.js"></script>
    <script src="{{asset('backend')}}/vendor/quill/quill.min.js"></script>
    <script src="{{asset('backend')}}/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="{{asset('backend')}}/vendor/tinymce/tinymce.min.js"></script>
    <script src="{{asset('backend')}}/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="{{asset('backend')}}/js/main.js"></script>
    @stack('scripts')
</body>

</html>
