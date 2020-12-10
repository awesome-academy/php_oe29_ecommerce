@extends('admin.layouts.master')

@section('content')
    <div class="wrap-admin-list-brand-page">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">{{ trans('admin.user.name') }}</h1>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">{{ trans('admin.user.add_user') }}</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('admin.user.name') }}</th>
                                            <th>{{ trans('admin.user.phone') }}</th>
                                            <th>{{ trans('admin.user.address') }}</th>
                                            <th>{{ trans('admin.user.role') }}</th>
                                            <th>{{ trans('admin.user.email') }}</th>
                                            <th>{{ trans('admin.action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $key => $user)
                                                <tr>
                                                    <td>{{ $key++ }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->phone }}</td>
                                                    <td>{{ $user->address }}</td>
                                                    <td>{{ $user->role->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        <button class="btn btn-primary">{{ trans('admin.detail') }}</button>
                                                        <button type="button" class="btn btn-info edit-product">
                                                            {{ trans('admin.edit') }}
                                                        </button>
                                                        <button class="btn btn-danger" type="submit">{{ trans('admin.delete') }}</button>
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
    @include('admin.users.modal_create_user')
@endsection

@section('js')
    <script src="{{ asset('bower_components/bower_project1/admin/js/dataTables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/admin/js/dataTables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ mix('js/admin_user.js') }}"></script>
@endsection