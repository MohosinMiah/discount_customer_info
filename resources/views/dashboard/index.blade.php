@include('dashboard.include.header')

{{-- https://startbootstrap.com/theme/sb-admin-2  Bootstrap SB-Admin Theme Template Used --}}

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

@include('dashboard.include.sidebar')

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
@yield('main_body')
<!-- End of Main Content -->

@include('dashboard.include.footer')
