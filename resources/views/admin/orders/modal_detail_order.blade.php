<div class="modal-dialog" id="show-order">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">{{ trans('admin.order.order_detail') }}</h4>
        </div>
        <div class="modal-body">
            <div class="name-customer">
                <p>
                    <span class="detail" id="infor">{{ trans('admin.order.user_name') }}</span>
                    {{ $user->name }}
                </p>
            </div>
            <div class="phone-customer">
                <p>
                    <span class="detail" id="infor">{{ trans('admin.order.phone') }}</span>
                    {{ $order->phone }}
                </p>
            </div>
            <div class="address-customer">
                <p>
                    <span class="detail" id="infor">{{ trans('admin.order.address') }}</span>
                    {{ $order->address }}
                </p>
            </div>
            <div class="note-customer">
                <p>
                    <span class="detail" id="infor">{{ trans('admin.order.note') }}</span>
                    {{ $order->note }}
                </p>
            </div>
            <div class="product-detail">
                    <div class="product">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ trans('admin.#') }}</th>
                                    <th>{{ trans('admin.product.name') }}</th>
                                    <th>{{ trans('admin.product_size') }}</th>
                                    <th>{{ trans('admin.quantity') }}</th>
                                    <th>{{ trans('admin.money') }}</th>
                                    <th>{{ trans('admin.image') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productDetails as $key => $detail)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $detail->product->name }}
                                            @if ($detail->product->deleted_at != null)
                                                <br>
                                                <span id = "show_errors">* {{ trans('product_not_exists') }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $detail->size }}</td>
                                        <td>{{ $detail->pivot->quantity }}</td>
                                        <td>{{ number_format($detail->pivot->unit_price) . trans("admin.money.vi") }}</td>
                                        <td>
                                            <img class="img-circle" id="image-detail" src="{{ asset(config('setting.image.product') . $detail->product->images->first()->image_link) }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
            <div class="total">
                <p>
                    <span class="detail" id="infor">{{ trans('admin.order.total_price') }}</span>
                    {{ number_format($order->total_price) . trans("admin.money.vi") }}
                </p>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary approved-order
                 @if ($order->status == config('order.status.approved'))
                    disabled
                 @endif
            " data-url="{{ route('orders.approved', $order->id) }}">{{ trans('admin.approved') }}</button>
            <button class="btn btn-danger rejected-order
                 @if ($order->status == config('order.status.rejected'))
                    disabled
                 @endif
            " data-url={{ route('orders.rejected', $order->id) }}>{{ trans('admin.rejected') }}</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin.close') }}</button>
        </div>
    </div>

</div>
