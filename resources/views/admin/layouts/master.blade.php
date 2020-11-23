<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">
    <title>{{ trans('admin.title') }}</title>
    <link href="{{ asset('bower_components/bower_project1/admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/bower_project1/admin/css/metisMenu.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/bower_project1/admin/css/timeline.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/bower_project1/admin/css/startmin.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/bower_project1/admin/css/morris.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/bower_project1/admin/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/bower_project1/admin/css/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/bower_project1/admin/css/dataTables/dataTables.responsive.css') }}" rel="stylesheet">
    @yield('css')
    <script src="{{ asset('bower_components/ckeditor/ckeditor.js') }}"></script>
</head>
<body>
<div id="wrapper">
    @include('admin.elements.header')
    @yield('content')
</div>
    <script src="{{ asset('bower_components/bower_project1/admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/admin/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/admin/js/raphael.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/admin/js/startmin.js') }}"></script>
    <script src="{{ asset('bower_components/highcharts/highcharts.js') }}"></script>
    <script src="{{ asset('bower_components/highcharts/modules/exporting.js') }}"></script>
    @yield('js')
</body>
</html>
