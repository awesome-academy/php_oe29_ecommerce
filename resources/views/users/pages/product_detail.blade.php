@extends('users.master')

@section('content')
    <div class="wrap-user-product-detail-page">
        <section class="ftco-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mb-5 ftco-animate">
                        <img src="{{ asset(config('setting.image.product') . $images->first()->image_link) }}" class="img-fluid" alt="" id="image-show">
                        <div class="row">
                            @foreach ($images as $image)
                                <div class="col-xl-3">
                                    <img src="{{ asset(config('setting.image.product') . $image->image_link) }}" alt="" class="list-image">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                        <h3 class="product-name">{{ $product->name }}</h3>
                        <div class="rating d-flex">
                            <p class="text-left mr-4">
                                <a href="#" class="mr-2">{{ $product->rate }}</a>
                                @for ($index = 0; $index < $product->rate; $index++)
                                    <a href="#"><span class="ion-ios-star"></span></a>
                                @endfor
                            </p>
                        </div>
                        <p class="price">
                            @if ($product->original_price > $product->current_price)
                                <span class="original-price">{{ number_format($product->original_price) . trans('admin.money.vi') }}</span>
                                <span class="current-price">{{ number_format($product->current_price) . trans('admin.money.vi') }}</span>
                            @else
                                <span class="current-price">{{ number_format($product->current_price) . trans('admin.money.vi') }}</span>
                            @endif
                        </p>
                        <p>{!! $product->description !!}</p>
                        <form class="add-to-cart" action="{{ route('user.addToCart') }}" method="POST">
                            @csrf
                            <div class="row mt-4">
                                <div class="wrap-size">
                                    @foreach ($productDetails as $detail)
                                        <input type="button" class="btn btn-primary btn-size" value="{{ $detail->size }}" data-url ="{{ route('user.quantity', $detail->id) }}" id="size-{{ $detail->size }}">
                                    @endforeach
                                </div>
                                <div class="w-100"></div>
                                <div class="input-group col-md-6 d-flex mb-3">
                                    <span class="input-group-btn mr-2">
                                        <button type="button" class="quantity-left-minus btn" data-type="minus" data-field="" id="btn-sub" disabled>
                                            <i class="ion-ios-remove"></i>
                                        </button>
                                    </span>
                                    <input type="text" id="quantity" name="quantity" class="quantity form-control input-number" value="1" min="0" disabled>
                                    <span class="input-group-btn ml-2">
                                        <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="" id="btn-add" disabled>
                                            <i class="ion-ios-add"></i>
                                        </button>
                                    </span>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-12">
                                    <p class="quantity">
                                        <span>{{ trans('user.product_detail.quantity') }}: </span>
                                        <span id="quantity-size"></span>
                                    </p>
                                </div>
                            </div>
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="size" id="add-size" value="">
                            <input type="submit" class="btn btn-black py-3 px-5 mr-2" value="{{ trans('user.product_detail.add_to_cart') }}" dusk="add-to-cart" id="add-to-cart">
                            <a href="#" class="btn btn-primary py-3 px-5">{{ trans('user.product_detail.buy_now') }}</a>
                        </form>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12 nav-link-wrap">
                        <div class="nav nav-pills d-flex text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link ftco-animate mr-lg-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="false">
                                {{ trans('admin.description') }}
                            </a>

                            <a class="nav-link ftco-animate mr-lg-1" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">
                                {{ trans('manufactured') }}
                            </a>

                            <a class="nav-link ftco-animate active" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab" aria-controls="v-pills-3" aria-selected="true">
                                {{ trans('admin.comment') }}
                            </a>

                        </div>
                    </div>
                    <div class="col-md-12 tab-wrap">
                        <div class="tab-content bg-light" id="v-pills-tabContent">

                            <div class="tab-pane fade" id="v-pills-1" role="tabpanel" aria-labelledby="day-1-tab">
                                <div class="p-4">
                                    <h3 class="mb-4">{{ $product->name }}</h3>
                                    <p> {!! $product->description !!}</p>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-day-2-tab">
                                <div class="p-4">
                                    <h3 class="mb-4"> {{ $product->name . trans('manufactured_buy') . $product->brand->name }}</h3>
                                    <p>{!! $product->description !!}</p>
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-day-3-tab">
                                <div class="row p-4">
                                    <div class="col-md-7">
                                        <h3 class="mb-4">{{ $comments->count('id') . " " . trans('admin.comment') }}</h3>
                                        @if ($comments->count('id') > 0)
                                            <div class="list-comment">
                                            @foreach ($comments as $comment)
                                                <div class="review">
                                                    <div class="user-img"></div>
                                                    <div class="desc">
                                                        <h4>
                                                            <span class="text-left">{{ $comment->user->name }}</span>
                                                            <span class="text-right">{{ $comment->created_at }}</span>
                                                        </h4>
                                                        <p class="star">
								   				        <span>
                                                            @for ($i = 0; $i < $comment->rate; $i++)
                                                                <i class="ion-ios-star-outline"></i>
                                                            @endfor
							   					        </span>
                                                        <span class="text-right">
                                                            <a class="reply" data-toggle="collapse" href="#comment-{{ $comment->id }}" role="button" aria-expanded="false" aria-controls="collapseExample" >
                                                                <i class="icon-reply"></i>
                                                            </a>
                                                            @can('delete', $comment)
                                                                <a class="reply" href="{{ route('user.delete_comment', $comment->id) }}">
                                                                    <i class="icon-delete"></i>
                                                                </a>
                                                            @endcan
                                                        </span>
                                                        </p>
                                                        <p>{{ $comment->message }}</p>
                                                        @if (count($comment->replies) > 0)
                                                        <div class="list-reply">
                                                            @foreach ($comment->replies as $reply)
                                                                <div class="user-img"></div>
                                                                <div class="desc">
                                                                    <h4>
                                                                        <span class="text-left">{{ $reply->user->name }}</span>
                                                                        <span class="text-right">{{ $reply->created_at }}</span>
                                                                    </h4>
                                                                    <p class="star">
                                                                        <span class="text-right">
                                                                            <a class="reply" data-toggle="collapse" href="#comment-{{ $comment->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                                <i class="icon-reply"></i>
                                                                            </a>
                                                                            @can('delete', $reply)
                                                                                <a class="reply" href="{{ route('user.delete_comment', $reply->id) }}">
                                                                                    <i class="icon-delete"></i>
                                                                                </a>
                                                                            @endcan
                                                                        </span>
                                                                    </p>
                                                                    <p>{{ $reply->message }}</p>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        @endif
                                                        <div class="collapse" id="comment-{{ $comment->id }}">
                                                            <form action="{{ route('user.reply_comment',['commentId' => $comment->id, 'productId' => $product->id]) }}" method="post" id="comment">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <span>{{ $errors->first('comment') }}</span>
                                                                    <input class="form-control" type="text" name="reply" value="{{ "@" . $comment->user->name . ": " }}">
                                                                </div>
                                                                <button class="btn btn-primary" type="submit">{{ trans('admin.send') }}</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        @else
                                            <div class="list-comment">
                                                {{ trans('no_comment') }}
                                            </div>
                                        @endif
                                        @auth
                                        <div class="user-comment">
                                            <form action="{{ route('user.comment', $product->id) }}" method="post" id="comment">
                                                @csrf
                                                <h3>{{ trans('admin.comment') }}</h3>
                                                <div class="form-group">
                                                    <div class="rating">
                                                        <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5"></label>
                                                        <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4"></label>
                                                        <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3"></label>
                                                        <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2"></label>
                                                        <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <span>{{ $errors->first('comment') }}</span>
                                                    <input class="form-control" type="text" name="comment" value="{{ old('comment') }}" placeholder="{{ trans('admin.comment') }}">
                                                </div>
                                                <button class="btn btn-primary" type="submit">{{ trans('admin.send') }}</button>
                                            </form>
                                        </div>
                                        @endauth
                                    </div>
                                    <div class="col-md-4">
                                        <div class="rating-wrap">
                                            <h3 class="mb-4">{{ trans('give_a_comment') }}</h3>
                                            @php
                                                $rate = config('setting.rate');
                                            @endphp
                                            @if ($comments->count('id') != 0)
                                                @while ($rate)
                                                <p class="star">
                                                    <span>
                                                        @for ($i = $rate; $i > 0; $i--)
                                                            <i class="ion-ios-star-outline"></i>
                                                        @endfor
                                                        {{ round($comments->where('rate', '=', $rate)->count('id') / $comments->count('id') * 100) . "%"}}
                                                    </span>
                                                    <span>
                                                        {{ $comments->where('rate', '=', $rate)->count('id') . " " . trans('admin.comment') }}
                                                    </span>
                                                    </p>
                                                    @php
                                                      $rate = $rate - 1;
                                                    @endphp
                                                @endwhile
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script src="{{ mix('js/product_detail.js') }}"></script>
@endsection
