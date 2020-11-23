<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#detail-{{ $order->id }}">
    {{ trans('user.modals.order_detail.detail') }}
</button>
<div class="wrap-user-order-detail-modal">
    <div id="detail-{{ $order->id }}" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ trans('user.modals.order_detail') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="info">
                        <div class="title">
                            <div class="column">{{ trans('user.modals.order_detail.user_name') }}</div>
                            <div class="column">{{ trans('user.modals.order_detail.total_payment') }}</div>
                            <div class="column">{{ trans('user.modals.order_detail.time') }}</div>
                            <div class="column">{{ trans('user.modals.order_detail.status') }}</div>
                            @if ($order->status != config('order.status.pending'))
                                <div class="column">{{ trans('user.modals.order_detail.time_update') }}</div>
                            @endif
                        </div>
                        <div class="content">
                            <div class="column">{{ $order->user->name }}</div>
                            <div class="column">{{ number_format($order->total_price) . " VND" }}</div>
                            <div class="column">{{ $order->created_at }}</div>
                            <div class="column">
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
                            </div>
                            @if ($order->status != config('order.status.pending'))
                                <div class="column">{{ $order->updated_at }}</div>
                            @endif
                        </div>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('user.modals.order_detail.name_product') }}</th>
                                <th>{{ trans('user.modals.order_detail.size') }}</th>
                                <th>{{ trans('user.modals.order_detail.quantity') }}</th>
                                <th>{{ trans('user.modals.order_detail.unit_price') }}</th>
                                <th>{{ trans('user.modals.order_detail.total') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $index = 0;
                            @endphp
                            @foreach ($order->productDetails as $productDetail)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>
                                        <div>{{ $productDetail->product->name }}</div>
                                        @if ($productDetail->product->deleted_at != null)
                                            <div>
                                                <span class="text text-danger">* {{ trans('user.modals.order_detail.product_not_exist') }}</span>
                                                @if ($order->status == config('order.status.pending'))
                                                    <form action="{{ route('user.deleteProductInOrder') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="product_detail_id" value="{{ $productDetail->id }}">
                                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                        <input type="hidden" name="total_price" value="{{ $order->total_price }}">
                                                        <input type="submit" class="btn btn-danger" value="{{ trans('user.modals.order_detail.delete') }}">
                                                    </form>
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $productDetail->size }}</td>
                                    <td>{{ $productDetail->pivot->quantity }}</td>
                                    <td>{{ number_format($productDetail->pivot->unit_price) . " VND" }}</td>
                                    <td>{{ number_format($productDetail->pivot->unit_price * $productDetail->pivot->quantity) . " VND" }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($order->status == config('order.status.pending'))
                        <form action="{{ route('user.cancelOrder') }}" method="POST">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                            <input type="submit" class="btn btn-danger btn-cancel" value="{{ trans('user.modals.order_detail.cancel_order') }}">
                        </form>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">
                        {{ trans('user.modals.order_detail.close') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
