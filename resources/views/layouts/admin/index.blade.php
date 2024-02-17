<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>D'Goals Admin</title>
    @include('layouts.admin.css')
    @yield('css')
</head>

<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-chartbg" data-col="2-columns">
    <!-- Header -->
    @include('layouts.admin.navbar')
    <!-- Close Header -->

    <!-- Header -->
    @include('layouts.admin.sidebar')
    <!-- Close Header -->

    @yield('content')

    <!-- Start Footer -->
    @include('layouts.admin.footer')
    <!-- End Footer -->

    <!-- Start Script -->
    @include('layouts.admin.js')
    @yield('js')
    <!-- End Script -->
</body>
