@extends('admin.layouts.master')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">{{ trans('admin.order.name') }}</h1>
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
                            {{ trans('admin.order.data_order') }}
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
                                        <th>{{ trans('admin.order.user_name') }}</th>
                                        <th>{{ trans('admin.order.phone') }}</th>
                                        <th>{{ trans('admin.order.address') }}</th>
                                        <th>{{ trans('admin.order.total_price') }}</th>
                                        <th>{{ trans('admin.order.status') }}</th>
                                        <th>{{ trans('admin.order.note') }}</th>
                                        <th>{{ trans('admin.number_product_detail') }}</th>
                                        <th>{{ trans('admin.action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($orders as $key => $order)
                                        <tr class="odd gradeX">
                                            <td> {{ $key + 1 }}</td>
                                            <td>{{ $order->user->name }}</td>
                                            <td>{{ $order->phone }}</td>
                                            <td class="center">{{ $order->address }}</td>
                                            <td class="center">{{ number_format($order->total_price) . trans('admin.money.vi') }}</td>
                                            <td class="status-order" data-id="{{ $order->id }}">
                                                @switch ($order->status)
                                                    @case (config('order.status.pending'))
                                                    <div class="alert alert-success" data-id="{{ $order->id }}">
                                                        {{ trans('admin.pending') }}

                                                        @break
                                                    </div>
                                                    @case (config('order.status.approved'))
                                                        <div class="alert alert-info" data-id="{{ $order->id }}">
                                                            {{ trans('admin.approved') }}

                                                            @break
                                                        </div>
                                                    @case (config('order.status.rejected'))
                                                        <div class="alert alert-danger" data-id="{{ $order->id }}">
                                                            {{ trans('admin.rejected') }}

                                                            @break
                                                        </div>
                                                    @default
                                                        <div class="alert alert-warning" data-id="{{ $order->id }}">
                                                            {{ trans('admin.cancelled') }}
                                                        </div>
                                                    @endswitch
                                            </td>
                                            <td class="center">{{ $order->note }}</td>
                                            <td class="center">{{ $order->product_details_count }}</td>
                                            <td class="center">
                                                <button class="btn btn-primary order" data-url="{{ route('orders.show', $order->id) }}" id="view-order-detail" >{{ trans('admin.detail') }}</button>
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
    <div class="modal fade" id="detail-Order" role="dialog"></div>
    @include('admin.elements.loading')
@endsection
@section('js')
    <script src="{{ asset('bower_components/bower_project1/admin/js/dataTables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/admin/js/dataTables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ mix('js/orderjs.js') }}"></script>
@endsection
