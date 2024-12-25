<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Favicon icon -->

    <link rel="icon" href="{{ asset('assets/backend/assets/images/favicon.ico') }}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    @include('backend.partials.styles')
    @yield('styles')
    <style>
        .bg-primary {
            background-color: #008abd !important;
        }
        .btn-primary:hover, .sweet-alert button.confirm:hover, .wizard>.actions a:hover {
            background-color: #008abd !important;
            border-color: #008abd !important;
        }
        .btn-primary, .sweet-alert button.confirm, .wizard>.actions a {
            background-color: #008abd !important;
            border-color: #008abd !important;
        }
        .checkbox-fade.fade-in-primary .cr {
            border: 2px solid #008abd !important;
        }
        .checkbox-fade.fade-in-primary .cr .cr-icon {
            color: #008abd !important;
        }
    </style>
</head>

<body class="menu-static">
    @yield('auth-content')
    @include('backend.partials.scripts')
    @yield('scripts')
</body>

</html>
