<!DOCTYPE html>
<html>
<head>
    <title>{{ trans('language.title', ['name' => 'kawabii']) }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{ asset('bower_components/bower_project1/admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/bower_project1/admin/css/startmin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
</head>
<body class="goto-here">
    @yield('content')
    @include('sweetalert::alert')
    <script src="{{ asset('bower_components/bower_project1/admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/sweetalert2.all.js') }}"></script>
</body>
</html>
