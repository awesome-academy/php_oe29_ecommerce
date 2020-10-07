@extends('admin.layouts.master')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">{{ trans('admin.product.name') }}</h1>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">{{ trans('admin.product.add_product') }}</button>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {{ trans('admin.product.data_product') }}
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>{{ trans('admin.#') }}</th>
                                        <th>{{ trans('admin.product.name_product') }}</th>
                                        <th>{{ trans('admin.product.original_price') }}</th>
                                        <th>{{ trans('admin.product.current_price') }}</th>
                                        <th>{{ trans('admin.product.count_image') }}</th>
                                        <th>{{ trans('admin.product.count_product_detail') }}</th>
                                        <th>{{ trans('admin.action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($products as $key => $product)
                                        <tr class="odd gradeX">
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->original_price }}</td>
                                            <td class="center">{{ $product->current_price }}</td>
                                            <td class="center">{{ $product->images_count }}</td>
                                            <td class="center">{{ $product->product_details_count }}</td>
                                            <td class="center">
                                                <button class="btn btn-primary">{{ trans('admin.detail') }}</button>
                                                <button type="button" class="btn btn-info">{{ trans('admin.edit') }}</button>
                                                <button class="btn btn-danger" type="submit">{{ trans('admin.delete') }}</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
@section('js')
    <script src="{{ asset('bower_components/bower_project1/admin/js/dataTables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/admin/js/dataTables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ mix('js/productjs.js') }}"></script>
@endsection