@if ($product)
<section class="ftco-section ftco-deal bg-primary">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset(config('setting.image.product') . $product->images->first()->image_link) }}" class="img-fluid" alt="">
            </div>
            <div class="col-md-6">
                <div class="heading-section heading-section-white">
                    <span class="subheading">{{ trans('deal_month') }}</span>
                    <h2 class="mb-3">{{ trans('deal_month') }}</h2>
                </div>
                <div class="text-deal">
                    <h2><a href="{{ route('user.product.show', $product->id) }}">{{ $product->name }}</a></h2>
                    <p class="price">
                        @if ($product->original_price > $product->current_price)
                            <span class="mr-2 price-dc">{{ number_format($product->original_price) . trans('admin.money.vi') }}</span>
                            <span class="price-sale">{{ number_format($product->current_price) . trans('admin.money.vi') }}</span>
                        @else
                            <span class="price-sale">{{ number_format($product->current_price) . trans('admin.money.vi') }}</span>
                        @endif
                    </p>
                    <ul class="thumb-deal d-flex mt-4">
                        @foreach ($product->images as $image)
                            <li class="img" style="background-image: url({{ config('setting.image.product') . $image->image_link }});"></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
