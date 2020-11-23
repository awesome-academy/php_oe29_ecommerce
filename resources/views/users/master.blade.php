<!DOCTYPE html>
<html>
<head>
    <title>{{ trans('title', ['name' => 'kawabii']) }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{ asset('bower_components/bower_project1/user/googleapi.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('bower_components/bower_project1/user/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bower_project1/user/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bower_project1/user/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bower_project1/user/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bower_project1/user/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bower_project1/user/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bower_project1/user/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bower_project1/user/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bower_project1/user/css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bower_project1/user/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bower_project1/user/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bower_project1/user/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
</head>
<body class="goto-here">
    @include("users.elements.information_header")
    @include("users.elements.menu")
    @yield("content")
    @include("users.elements.footer")
    @include("users.elements.modal_change_password")
    @include("users.elements.modal_information")
    @include('sweetalert::alert')
    <div class="show_modal" data-modal="{{ $errors->first('show_modal') }}"></div>
    <script src="{{ asset('bower_components/bower_project1/user/js/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/user/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/user/js/popper.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/user/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/user/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/user/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/user/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/user/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/user/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/user/js/aos.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/user/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/user/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/user/js/scrollax.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/user/js/google-map.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/user/js/main.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('js/showModal.js') }}"></script>
    <script>
        window.translations = {!! $translation !!};
    </script>
    @yield("js")
</body>
</html>
