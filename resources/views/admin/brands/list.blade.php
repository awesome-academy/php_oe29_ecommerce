@extends('admin.layouts.master')

@section('content')
    <div class="wrap-admin-list-brand-page">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">{{ trans('admin.brand.title') }}</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        @include('admin.brands.modals.create')
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ trans('admin.brand.name') }}</th>
                                                <th>{{ trans('admin.brand.created_at') }}</th>
                                                <th>{{ trans('admin.brand.updated_at') }}</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $index = 1;
                                            @endphp
                                            @foreach ($brands as $brand)
                                                <tr>
                                                    <td>{{ $index++ }}</td>
                                                    <td>{{ $brand->name }}</td>
                                                    <td>{{ $brand->created_at }}</td>
                                                    <td>{{ $brand->updated_at }}</td>
                                                    <td>
                                                        @include('admin.brands.modals.edit')
                                                        @include('admin.brands.modals.delete')
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('bower_components/bower_project1/admin/js/dataTables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/admin/js/dataTables/dataTables.bootstrap.min.js') }}"></script>
    <script src={{ mix('js/admin_list_brand.js') }}></script>
@endsection
