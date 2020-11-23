<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('user.home') }}">{{ config('information_shop.name_shop') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> {{ trans('menu') }}
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{ route('user.home') }}" class="nav-link">{{ trans('home') }}</a></li>
                <li class="nav-item"><a href="{{ route('user.product') }}" class="nav-link" >{{ trans('product') }}</a></li>
                <li class="nav-item"><a href="{{ route('user.about') }}" class="nav-link">{{ trans('about') }}</a></li>
                <li class="nav-item"><a href="{{ route('user.contact') }}" class="nav-link">{{ trans('contact') }}</a></li>
                <li class="nav-item cta cta-colored">
                    <a href="{{ route('user.cart') }}" class="nav-link" dusk="cart">
                        <span class="icon-shopping_cart"></span>
                        @if(Session::has('numberOfItemInCart'))
                            <span class="badge">{{ Session::get('numberOfItemInCart') }}</span>
                        @else
                            <span class="badge">0</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    @if (Auth::check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" dusk="user-active">{{ Auth::user()->name }}</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-information">{{ trans('change_information') }}</a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-password">{{ trans('change_password') }}</a>
                            <a class="dropdown-item" href="{{ route('user.orderHistory') }}" dusk="order-history">{{ trans('user.menu.order_history') }}</a>
                            @if (Auth::user()->role_id > config('role.user'))
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}" class="nav-link">{{ trans('admin') }}</a>
                            @endif
                            <a class="dropdown-item" href="{{ route('user.logout') }}" class="nav-link">{{ trans('logout') }}</a>
                        </div>
                    </li>
                    @else
                        <a href="{{ route('user.getLogin') }}" class="nav-link">{{ trans('login') }}</a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>
