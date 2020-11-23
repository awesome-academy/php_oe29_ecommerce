@extends('users.master')
@section('content')
<div class="wrap-user-checkout-page">
    <div class="hero-wrap hero-bread">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-0 bread">{{ trans('user.checkout') }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="list-cart-detail">
            <h3 class="title-page">{{ trans('user.checkout.list_product') }}</h3>
            <table class="table table-bordered table-striped">
                <thead class="thead-primary">
                    <tr>
                        <th class="col-index">#</th>
                        <th class="col-name">{{ trans('user.checkout.name') }}</th>
                        <th class="col-size">{{ trans('user.checkout.size') }}</th>
                        <th class="col-quantity">{{ trans('user.checkout.quantity') }}</th>
                        <th class="col-unit-price">{{ trans('user.checkout.unit_price') }}</th>
                        <th class="col-total">{{ trans('user.checkout.total') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $index = 0;
                        $quantity = 0;
                        $total = 0;
                    @endphp
                    @foreach ($cart as $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $productNames[$index] }}</td>
                            <td>{{ $item['size'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ number_format($item['price']) . " VND" }}</td>
                            <td>{{ number_format($item['quantity'] * $item['price']) . " VND" }}</td>
                        </tr>
                        @php
                            $index++;
                            $total += $item['quantity'] * $item['price'];
                            $quantity += $item['quantity'];
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
        <hr>
        <form action="{{ route('user.checkout') }}" method="POST" class="form-checkout">
            @csrf
            <div class="user-info">
                <h3>{{ trans('user.checkout.receive_information') }}</h3>
                <div class="form-group">
                    <label>{{ trans('user.checkout.name') }}</label>
                    <input type="text" name="receive_name" class="form-control" value="{{ $user->name }}" placeholder="{{ trans('user.checkout.enter_your_name') }}" required>
                    @error('receive_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{ trans('user.checkout.address') }}</label>
                    <input type="text" name="receive_address" class="form-control" value="{{ $user->address }}" placeholder="{{ trans('user.checkout.enter_your_address') }}" required>
                    @error('receive_address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{ trans('user.checkout.phone_number') }}</label>
                    <input type="text" name="receive_phone" class="form-control" value="{{ $user->phone }}" placeholder="{{ trans('user.checkout.enter_your_phone_number') }}" required>
                    @error('receive_phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{ trans('user.checkout.note') }}</label>
                    <input type="text" name="note" class="form-control" placeholder="{{ trans('user.checkout.enter_note_for_us') }}">
                </div>
            </div>
            <div class="order-info">
                <h3>{{ trans('user.checkout.order_information') }}</h3>
                <div class="form-group">
                    <div class="line">
                        <span class="title">{{ trans('user.checkout.quantity') }}</span>
                        <span class="content" id="quantity">{{ $quantity }}</span>
                    </div>
                    <div class="line">
                        <span class="title">{{ trans('user.checkout.total_payment') }}</span>
                        <span class="content">{{ number_format($total) }}</span>
                        <span> VND</span>
                    </div>
                    <input type="hidden" name="payment" value="{{ $total }}">
                </div>
                <input type="submit" value="{{ trans('user.checkout.confirm_checkout') }}" class="btn btn-danger btn-checkout">
            </div>
        </form>
    </div>

</div>
@endsection
