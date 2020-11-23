@extends('users.master')
@section('content')
    <div class="wrap-user-product-page">
        <div class="hero-wrap hero-bread">
            <div class="container">
                <div class="row no-gutters slider-text align-items-center justify-content-center">
                    <div class="col-md-9 ftco-animate text-center">
                        <h1 class="mb-0 bread">{{ trans('user.product') }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="ftco-section bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-lg-10 order-md-last" >
                        <div class="row" id="list-product">
                            @foreach ($products as $product)
                            <div class="col-sm-12 col-md-12 col-lg-4 ftco-animate d-flex">
                                <div class="product d-flex flex-column">
                                    <a href="{{ route('user.product.show', $product->id) }}" class="img-prod">
                                        <img class="img-fluid" src="{{ asset(config('setting.image.product') . $product->images->first()->image_link) }}" alt="">
                                        <div class="overlay"></div>
                                    </a>
                                    <div class="text py-3 pb-4 px-3">
                                        <div class="d-flex">
                                            <div class="cat">
                                                <span>{{ $product->brand->name }}</span>
                                            </div>
                                            <div class="rating">
                                                <p class="text-right mb-0">
                                                    @for ($star = 0; $star < $product->rate; $star++)
                                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                                    @endfor
                                                </p>
                                            </div>
                                        </div>
                                        <h3><a href="#">{{ $product->name }}</a></h3>
                                        <div class="pricing">
                                            <p class="price">
                                                @if ($product->original_price > $product->current_price)
                                                    <span class="original-price">{{ number_format($product->original_price) . trans('admin.money.vi') }}</span>
                                                    <span class="current-price">{{ number_format($product->current_price) . trans('admin.money.vi') }}</span>
                                                @else
                                                    <span class="current-price">{{ number_format($product->current_price) . trans('admin.money.vi') }}</span>
                                                @endif
                                            </p>
                                        </div>
                                        <p class="bottom-area d-flex px-3">
                                            <a href="#" class="add-to-cart text-center py-2 mr-1"><span>{{ trans('user.product.add_to_cart') }} <i class="ion-ios-add ml-1"></i></span></a>
                                            <a href="#" class="buy-now text-center py-2">{{ trans('user.product.buy_now') }}<span><i class="ion-ios-cart ml-1"></i></span></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="paginate">{{ $products->links() }}</div>
                    </div>
                    <div class="col-md-4 col-lg-2">
                        <div class="sidebar">
                            <div class="sidebar-box-2">
                                <h2 class="heading">{{ trans('user.product.category') }}</h2>
                                @foreach ($categories as $category)
                                    @if ($category->parent_id == null)
                                        <div class="fancy-collapse-panel">
                                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" role="tab" id="heading-{{ $category->id }}">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $category->id }}" aria-expanded="true" aria-controls="collapse-{{ $category->id }}">{{ $category->name }}</a>
                                                        </h4>
                                                    </div>
                                                    @if (count($category->children) > 0)
                                                        <div id="collapse-{{ $category->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-{{ $category->id }}">
                                                            <div class="panel-body">
                                                                <ul>
                                                                @foreach ($category->children as $child)
                                                                    <li><a href="{{ route('user.product.filter_by_category', $child->id) }}">{{ $child->name }}</a></li>
                                                                @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            @include('users.elements.range_price_product')
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
@endsection
