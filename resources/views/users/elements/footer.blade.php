<footer class="ftco-footer ftco-section">
    <div class="container">
        <div class="row">
            <div class="mouse">
                <a href="#" class="mouse-icon">
                    <div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
                </a>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">{{ config('information_shop.name_shop') }}</h2>
                    <p>{{ trans('information') }}</p>
                    <p>{{ trans('information2') }}</p>
                    <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                        <li class="ftco-animate"><a href="{{ config('information_shop.twitter_shop') }}"><span class="icon-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="{{ config('information_shop.facebook_shop') }}"><span class="icon-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="{{ config('information_shop.instagram') }}"><span class="icon-instagram"></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4 ml-md-5">
                    <h2 class="ftco-heading-2">{{ trans('menu') }}</h2>
                    <ul class="list-unstyled">
                        <li><a href="#" class="py-2 d-block">{{ config('information_shop.name_shop') }}</a></li>
                        <li><a href="#" class="py-2 d-block">{{ trans('about') }}</a></li>
                        <li><a href="#" class="py-2 d-block">{{ trans('contact') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">{{ trans('have_question') }}</h2>
                    <div class="block-23 mb-3">
                        <ul>
                            <li><span class="icon icon-map-marker"></span><span class="text">{{ config('information_shop.address_shop') }}</span></li>
                            <li><a href="#"><span class="icon icon-phone"></span><span class="text">{{ config('information_shop.phone_shop') }}</span></a></li>
                            <li><a href="#"><span class="icon icon-envelope"></span><span class="text">{{ config('information_shop.email_shop') }}</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
