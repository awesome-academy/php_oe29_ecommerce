@extends('users.master')

@section('content')
<div class="wrap-user-order-history-page">
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
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ number_format($order->total_price) . " VND" }}</td>
                            <td>
                                @switch ($order->status)
                                    @case (config('order.status.pending'))
                                        <span class="label label-primary">{{ trans('user.order.pending') }}</span>

                                        @break
                                    @case (config('order.status.approved'))
                                        <span class="label label-success">{{ trans('user.order.approved') }}</span>

                                        @break
                                    @case (config('order.status.rejected'))
                                        <span class="label label-danger">{{ trans('user.order.rejected') }}</span>

                                        @break
                                    @case (config('order.status.cancelled'))
                                        <span class="label label-default">{{ trans('user.order.cancelled') }}</span>

                                        @break
                                @endswitch
                            </td>
                            <td>{{ $order->note }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>
                                @include ('users.modals.order_detail')
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="paginate">{{ $orders->links() }}</div>
        </div>
    </section>
</div>
@endsection
