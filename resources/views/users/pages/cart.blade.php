@extends('users.master')

@section('content')
<div class="wrap-user-cart-page">
    <div class="hero-wrap hero-bread">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-0 bread">{{ trans('user.cart') }}</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    @if (!Session::has('numberOfItemInCart') || Session::get('numberOfItemInCart') == 0)
                        <h4 class="text-center">
                            {{ trans('user.cart.empty') }}
                        </h4>
                        <div class="text-center"><a href="{{ route('user.product') }}" class="buy-now">{{ trans('user.cart.buy_now') }}</a></div>

                    @else
                        <table class="table">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>{{ trans('user.cart.image') }}</th>
                                    <th>{{ trans('user.cart.product_name') }}</th>
                                    <th class="size">{{ trans('user.cart.size') }}</th>
                                    <th class="quantity">{{ trans('user.cart.quantity') }}</th>
                                    <th>{{ trans('user.cart.price') }}</th>
                                    <th>{{ trans('user.cart.total') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $index = 0;
                                    $total = 0;
                                @endphp
                                @foreach ($cart as $item)
                                    <tr class="text-center">
                                        <td class="product-remove">
                                            <form action="{{ route('user.deleteOne') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_detail_id" value="{{ $item['product_detail_id'] }}">
                                                <input type="submit" class="btn btn-primary" value="X">
                                            </form>
                                        </td>
                                         <td class="image-prod">
                                            <img src="{{ config('setting.image.product') . $images[$index] }}" alt="" class="img">
                                        </td>
                                        <td class="product-name">
                                            <h3>{{ $productNames[$index] }}</h3>
                                        </td>
                                        <td class="size">{{ $item['size'] }}</td>
                                        <td class="quantity">
                                            <div class="input-group mb-3">
                                                <input type="text" name="quantity" class="quantity form-control input-number" value="{{ number_format($item['quantity']) }}" min="1" max="100">
                                            </div>
                                        </td>
                                        <td class="price">{{ number_format($item['price']) . " VND" }}</td>
                                        <td class="total">{{ number_format($item['price']*$item['quantity']) . " VND" }}</td>
                                    </tr>
                                    @php
                                        $index++;
                                        $total += $item['price']*$item['quantity'];
                                    @endphp
                                @endforeach
                                <tr class="tr-total">
                                    <td class="total-price">
                                        <a href="{{ route('user.deleteAll') }}" class="btn btn-primary">{{ trans('user.cart.delete_all') }}</a>
                                    </td>
                                    <td class="total-price">&nbsp;</td>
                                    <td class="total-price">&nbsp;</td>
                                    <td class="total-price">&nbsp;</td>
                                    <td class="total-price">&nbsp;</td>
                                    <td class="total-price">{{ trans('user.cart.total_payment') }}</td>
                                    <td class="total-price">{{ number_format($total) . " VND" }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="{{ route('user.listItemInCart') }}" class="btn btn-danger btn-checkout">{{ trans('user.cart.checkout') }}</a>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
