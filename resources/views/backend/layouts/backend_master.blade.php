<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ url('favicon.png') }}">
  <link rel="icon" type="image/png" href="{{ url('favicon.png') }}">
  <title>{{ env('APP_NAME') }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <!--     Fonts and icons     -->
  @include('backend.layouts.partials.styles')
  <style>
    body{
      background: #28104e !important;
    }
    .navbar-vertical .navbar-nav>.nav-item .nav-link.active .icon {
        background-image: linear-gradient(310deg, #6237a0 0%, #6237a0 100%);
    }
    .bg-gradient-primary {
      background-image: linear-gradient(310deg, #6237a0 0%, #6237a0 100%) !important;
    }
    .active {
        /* border-left: 2px solid #deacf5 !important; */
    }
    .navbar-vertical.navbar-expand-xs .navbar-nav .nav-link{
      color: #ffffff;
    }
    .navbar-vertical .navbar-nav .nav-item .collapse .nav .nav-item .nav-link{
      color: #ffffff;
    }
    .navbar-vertical .navbar-nav .nav-item .collapse .nav .nav-item .nav-link.active{
      color: #deacf5;
    }
    .navbar-vertical .navbar-nav .nav-link[data-bs-toggle="collapse"]:after{
      color: #ffffff !important;
    }
    .navbar-vertical .navbar-nav .nav-item .collapse .nav .nav-item .nav-link:before{
      background: #deacf5 !important;
    }
    .btn-info{
      background: #6237a0;
    }
    .btn-info:hover{
      background-color: #6237a0;
      border-color: #6237a0;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        background-color: transparent !important;
    }
    .navbar-brand img{
        width: 150px !important;
    }
  </style>
  @yield('styles')
</head>

<body class="g-sidenav-show">
  
   @include('backend.layouts.partials.sidebar')
    

  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <!-- Navbar -->
    @include('backend.layouts.partials.header')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      @yield('admin-content')
    </div>
  </main>
 
  <!--   Core JS Files   -->
  @include('backend.layouts.partials.scripts')
  @yield('scripts')
</body>

</html>