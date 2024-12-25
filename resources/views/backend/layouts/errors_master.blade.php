<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <title>@yield('title', 'Integrashion')</title>
    @include('backend.layouts.partials.meta_tags')
    @include('backend.layouts.partials.styles')
    @yield('styles')

</head>

<body class="menu-static">
    <!-- Pre-loader start -->
    @include('backend.layouts.partials.preloader')
    <!-- Pre-loader end -->
    <!-- Menu header start -->
    @include('backend.layouts.partials.header')
    <!-- Menu header end -->
    <!-- Menu aside start -->
    @include('backend.layouts.partials.sidebar')

    <!-- Menu aside end -->
    <!-- Main-body start-->
    <div class="main-body">
        <div class="page-wrapper">
            @yield('error-content')
        </div>
    </div>
    @include('backend.layouts.partials.scripts')
    @yield('scripts')
</body>

</html>
