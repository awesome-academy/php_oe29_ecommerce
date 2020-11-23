<section id="home-section" class="hero">
    <div class="home-slider owl-carousel">
        <div class="slider-item js-fullheight">
            <div class="overlay"></div>
            <div class="container-fluid p-0">
                <div class="row d-md-flex no-gutters slider-text align-items-center justify-content-end" data-scrollax-parent="true">
                    <img class="one-third order-md-last img-fluid" src="{{ config('setting.image.slide1') }}" alt="">
                    <div class="one-forth d-flex align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
                        <div class="text">
                            <span class="subheading">{{ trans('new_arrival') }}</span>
                            <div class="horizontal">
                                <h1 class="mb-4 mt-3">{{ trans('new_shoes') }}</h1>
                                <p class="mb-4">
                                    {{ trans('infor_new_shoes') }}
                                </p>

                                <p><a href="{{ route('user.product') }}" class="btn-custom">{{ trans('discover_now') }}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="slider-item js-fullheight">
            <div class="overlay"></div>
            <div class="container-fluid p-0">
                <div class="row d-flex no-gutters slider-text align-items-center justify-content-end" data-scrollax-parent="true">
                    <img class="one-third order-md-last img-fluid" src="{{ config('setting.image.slide2') }}" alt="">
                    <div class="one-forth d-flex align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
                        <div class="text">
                            <span class="subheading">{{ trans('new_arrival') }}</span>
                            <div class="horizontal">
                                <h1 class="mb-4 mt-3">{{ trans('new_shoes') }}</h1>
                                <p class="mb-4">
                                    {{ trans('infor_new_shoes') }}
                                </p>
                                <p><a href="{{ route('user.product') }}" class="btn-custom">{{ trans('discover_now') }}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
