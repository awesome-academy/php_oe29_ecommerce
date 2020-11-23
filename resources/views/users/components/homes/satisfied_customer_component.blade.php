<section class="ftco-section testimony-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="services-flow">
                    <div class="services-2 p-4 d-flex ftco-animate">
                        <div class="icon">
                            <span class="flaticon-bag"></span>
                        </div>
                        <div class="text">
                            <h3>{{ trans('free_shipping') }}</h3>
                            <p class="mb-0">{{ trans('free_ship_title') }}</p>
                        </div>
                    </div>
                    <div class="services-2 p-4 d-flex ftco-animate">
                        <div class="icon">
                            <span class="flaticon-heart-box"></span>
                        </div>
                        <div class="text">
                            <h3>{{ trans('valuable_gifts') }}</h3>
                            <p class="mb-0">{{ trans('valuable_gifts') }}</p>
                        </div>
                    </div>
                    <div class="services-2 p-4 d-flex ftco-animate">
                        <div class="icon">
                            <span class="flaticon-payment-security"></span>
                        </div>
                        <div class="text">
                            <h3>{{ trans('all_day_support') }}</h3>
                            <p class="mb-0">{{ trans('support_customer_title') }}</p>
                        </div>
                    </div>
                    <div class="services-2 p-4 d-flex ftco-animate">
                        <div class="icon">
                            <span class="flaticon-customer-service"></span>
                        </div>
                        <div class="text">
                            <h3>{{ trans('all_day_support') }}</h3>
                            <p class="mb-0">{{ trans('support_customer_title') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="heading-section ftco-animate mb-5">
                    <h2 class="mb-4">{{ trans('satisfied_customer') }}</h2>
                    <p>{{ trans('satisfied_customer') }}</p>
                </div>
                <div class="carousel-testimony owl-carousel">
                    <div class="item">
                        <div class="testimony-wrap">
                            <div class="user-img mb-4" style="background-image: url({{ asset(config('setting.image.user1')) }})">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                            </div>
                            <div class="text">
                                <p class="mb-4 pl-4 line">{{ trans('satisfied') }}</p>
                                <p class="name">{{ trans('alexander') }}</p>
                                <span class="position">{{ trans('marketing') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
