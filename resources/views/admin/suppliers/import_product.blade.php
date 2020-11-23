@extends('admin.layouts.master')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">{{ $supplier->name }}</h1>
                </div>
            </div>
            @if (session('message_success'))
                <div class="text-center alert alert-success">
                    {{ session('message_success') }}
                </div>
            @endif
        <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {{ trans('admin.product.data_product') }}
                        </div>
                        @if (session('message'))
                            <div class="alert alert-danger">
                                {{ session('message') }}
                            </div>
                        @endif
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
                                        <th>{{ trans('admin.image') }}</th>
                                        <th>{{ trans('admin.quantity') }}</th>
                                        <th>{{ trans('admin.action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($products as $key => $product)
                                        <tr class="odd gradeX product" data-id="{{ $product->id }}">
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td class="original-price">{{ number_format($product->original_price ) . trans('admin.money.vi') }}</td>
                                            <td class="center">{{ number_format($product->current_price) . trans('admin.money.vi') }}</td>
                                            <td class="center">
                                                <img class="img-circle" src="{{ asset(config('setting.image.product') . $product->images->first()->image_link ) }}" width="100px" height="100px">
                                            </td>
                                            <td class="center product-quantity">{{ $product->productDetails->sum('quantity') }}</td>
                                            <td class="center">
                                                <button class="btn btn-primary btn-import-product"
                                                    type="button"
                                                    data-url="{{ route('show.modal',['productId' => $product->id, 'supplierId' => $supplier->id]) }}"
                                                    >{{ trans('admin.supplier.import') }}</button>
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
    <div id="import-product" class="modal fade" role="dialog"></div>
    @include('admin.elements.loading')
@endsection
@section('js')
    <script src="{{ asset('bower_components/bower_project1/admin/js/dataTables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/admin/js/dataTables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ mix('js/admin_supplier.js') }}"></script>
@endsection
