<div class="py-1 bg-black">
    <div class="container">
        <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
            <div class="col-lg-12 d-block">
                <div class="row d-flex">
                    <div class="col-md pr-4 d-flex topper align-items-center">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
                        <span class="text">{{ config('information_shop.phone_shop') }}</span>
                    </div>
                    <div class="col-md pr-4 d-flex topper align-items-center">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
                        <span class="text">{{ config('information_shop.email_shop') }}</span>
                    </div>
                    <div class="col-md-2 pr-4 d-flex topper align-items-center text-lg-right">
                        <a href="{{ route('localization', 'en') }}" dusk="english">
                            <span class="text">{{ trans('language.english') }}</span>
                        </a>
                    </div>
                    <div class="col-md-2 pr-4 d-flex topper align-items-center text-lg-right">
                        <a href="{{ route('localization', 'vi') }}" dusk="vietnamese">
                            <span class="text">{{ trans('language.vietnamese') }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
