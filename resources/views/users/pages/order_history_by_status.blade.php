@extends('users.master')

@section('content')
<div class="wrap-user-order-history-by-status-page">
    <div class="hero-wrap hero-bread">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-0 bread">{{ trans('user.order_history') }}</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="list-status">
                <a href="{{ route('user.orderHistory') }}" class="btn btn-info">{{ trans('user.order_history.show_all') }}</a>
                <a href="{{ route('user.orderHistoryByStatus') }}" class="btn btn-info">{{ trans('user.order_history.show_by_status') }}</a>
            </div>
            <div class="group-tabs">
                <ul class="nav nav-pills">
                    <li class="tab-status active"><a href="#pending" data-toggle="tab">{{ trans('user.order.pending') }}</a></li>
                    <li class="tab-status"><a href="#approved" data-toggle="tab">{{ trans('user.order.approved') }}</a></li>
                    <li class="tab-status"><a href="#rejected" data-toggle="tab">{{ trans('user.order.rejected') }}</a></li>
                    <li class="tab-status"><a href="#cancelled" data-toggle="tab">{{ trans('user.order.cancelled') }}</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show fade in active" id="pending" active>
                        @if ($existsPending)
                            <table class="table table-bordered table-striped">
                                <thead class="thead-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('user.order_history.total_payment') }}</th>
                                        <th>{{ trans('user.order_history.status') }}</th>
                                        <th>{{ trans('user.order_history.note') }}</th>
                                        <th>{{ trans('user.order_history.time_order') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $index = 0;
                                    @endphp
                                    @foreach ($orders as $order)
                                        @if($order->status == config('order.status.pending'))
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                <td>{{ number_format($order->total_price) . " VND" }}</td>
                                                <td><span class="label label-primary">{{ trans('user.order.pending') }}</span></td>
                                                <td>{{ $order->note }}</td>
                                                <td>{{ $order->created_at }}</td>
                                                <td>
                                                    @include ('users.modals.order_detail')
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="approved">
                        @if ($existsApproved)
                            <table class="table table-bordered table-striped">
                                <thead class="thead-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('user.order_history.total_payment') }}</th>
                                        <th>{{ trans('user.order_history.status') }}</th>
                                        <th>{{ trans('user.order_history.note') }}</th>
                                        <th>{{ trans('user.order_history.time_order') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $index = 0;
                                    @endphp
                                    @foreach ($orders as $order)
                                        @if($order->status == config('order.status.approved'))
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                <td>{{ number_format($order->total_price) . " VND" }}</td>
                                                <td><span class="label label-success">{{ trans('user.order.approved') }}</span></td>
                                                <td>{{ $order->note }}</td>
                                                <td>{{ $order->created_at }}</td>
                                                <td>
                                                    @include ('users.modals.order_detail')
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="rejected">
                        @if ($existsRejected)
                            <table class="table table-bordered table-striped">
                                <thead class="thead-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('user.order_history.total_payment') }}</th>
                                        <th>{{ trans('user.order_history.status') }}</th>
                                        <th>{{ trans('user.order_history.note') }}</th>
                                        <th>{{ trans('user.order_history.time_order') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $index = 0;
                                    @endphp
                                    @foreach ($orders as $order)
                                        @if($order->status == config('order.status.rejected'))
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                <td>{{ number_format($order->total_price) . " VND" }}</td>
                                                <td><span class="label label-danger">{{ trans('user.order.rejected') }}</span></td>
                                                <td>{{ $order->note }}</td>
                                                <td>{{ $order->created_at }}</td>
                                                <td>
                                                    @include ('users.modals.order_detail')
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="cancelled">
                        @if ($existsCancelled)
                            <table class="table table-bordered table-striped">
                                <thead class="thead-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('user.order_history.total_payment') }}</th>
                                        <th>{{ trans('user.order_history.status') }}</th>
                                        <th>{{ trans('user.order_history.note') }}</th>
                                        <th>{{ trans('user.order_history.time_order') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $index = 0;
                                    @endphp
                                    @foreach ($orders as $order)
                                        @if($order->status == config('order.status.cancelled'))
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                <td>{{ number_format($order->total_price) . " VND" }}</td>
                                                <td><span class="label label-default">{{ trans('user.order.cancelled') }}</span></td>
                                                <td>{{ $order->note }}</td>
                                                <td>{{ $order->created_at }}</td>
                                                <td>
                                                    @include ('users.modals.order_detail')
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('js')
    <script src="{{ asset('js/order_history_by_status.js') }}"></script>
@endsection
