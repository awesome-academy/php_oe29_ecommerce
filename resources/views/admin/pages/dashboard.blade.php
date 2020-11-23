@extends('admin.layouts.master')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">{{ trans('admin.order.name') }}</h1>
                </div>
            </div>
            <div class="row">
                <div id="container"></div>
            </div>
        </div>
    </div>
    <div class="url" data-url="{{ route('admin.highcharts') }}"></div>
@endsection
@section('js')
    <script src="{{ mix('js/adminHighCharts.js') }}"></script>
@endsection
