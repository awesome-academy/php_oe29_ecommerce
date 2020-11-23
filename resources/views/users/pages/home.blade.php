@extends('users.master')

@section('content')
    @include("users.elements.slide")
    @include("users.components.homes.introduce_component")
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h2 class="mb-4">{{ trans('new_arrival') }}</h2>
                    <p>{{ trans('infor_new_shoes') }}</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-sm-12 col-md-6 col-lg-3 ftco-animate d-flex">
                        <div class="product d-flex flex-column">
                            <a href="{{ route('user.product.show', $product->id) }}" class="img-prod"><img class="img-fluid" src="{{ asset(config('setting.image.product') . $product->images->first()->image_link) }}" alt="Colorlib Template">
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 pb-4 px-3">
                                <div class="d-flex">
                                    <div class="cat">
                                        <span>{{ $product->category->name }}</span>
                                    </div>
                                    <div class="rating">
                                        <p class="text-right mb-0">
                                            @for ($i = 0; $i < $product->rate; $i++)
                                                <a href="#"><span class="ion-ios-star-outline"></span></a>
                                            @endfor
                                        </p>
                                    </div>
                                </div>
                                <h3><a href="#">{{ $product->name }}</a></h3>
                                <div class="pricing">
                                    <p class="price">
                                        @if ($product->original > $product->current_price)
                                            <span class="mr-2 price-dc">{{ number_format($product->orignal_price) . trans('admin.money.vi') }}</span>
                                            <span class="price-sale">{{ number_format($product->current_price) . trans('admin.money.vi') }}</span>
                                        @else
                                            <span class="price-sale">{{ number_format($product->current_price) . trans('admin.money.vi') }}</span>
                                        @endif
                                    </p>
                                </div>
                                <p class="bottom-area d-flex px-3">
                                    <a href="{{ route('user.product.show', $product->id) }}" class="add-to-cart text-center py-2 mr-1"><span>{{ trans('add_to_cart') }} <i class="ion-ios-add ml-1"></i></span></a>
                                    <a href="{{ route('user.product.show', $product->id) }}" class="buy-now text-center py-2">{{ trans('buy_now') }}<span><i class="ion-ios-cart ml-1"></i></span></a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @include("users.components.homes.introduce_product_component")
@endsection
