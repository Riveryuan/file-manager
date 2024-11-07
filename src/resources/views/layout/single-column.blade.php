<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="X-CSRF-TOKEN" content="{{csrf_token()}}">
    <title>@yield('pageTitle')</title>
    @yield('custom_css_front')
    <link rel="stylesheet" href="{{$assets_path}}/adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{$assets_path}}/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="{{$assets_path}}/adminlte/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{$assets_path}}/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    @yield('custom_css_end')
    <script>
        let BASE_URL = '{{config('app.url')}}';
        let CSRF_TOKEN = '{{csrf_token()}}';
    </script>
    @yield('custom_script_head')
</head>
<body class="hold-transition">
<div class="wrapper">
    @yield('content')
</div>

@yield('custom_script_footer_front')
<script src="{{$assets_path}}/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="{{$assets_path}}/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="{{$assets_path}}/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{$assets_path}}/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="{{$assets_path}}/adminlte/dist/js/adminlte.js"></script>
@yield('custom_script_footer_end')
</body>
</html>
