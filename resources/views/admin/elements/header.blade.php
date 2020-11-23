<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">{{ trans('admin.title') }}</a>
    </div>

    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>

    <ul class="nav navbar-nav navbar-left navbar-top-links">
        <li>
            <a href="{{ route('user.home') }}"><i class="fa fa-home fa-fw"></i> {{ trans('admin.header.website') }}</a>
        </li>
    </ul>

    <ul class="nav navbar-right navbar-top-links">
        <li class="dropdown navbar-inverse">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-bell fa-fw"></i> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu dropdown-alerts">
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-comment fa-fw"></i> Bạn có đơn đặt hàng mới kìa . vào xem đi.
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a class="text-center" href="#">
                        <strong>See All Alerts</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" dusk="language">
                {{ trans('language') }}
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('localization', ['en']) }}">{{ trans('language.english') }}</a>
                <a class="dropdown-item" href="{{ route('localization', ['vi']) }}">{{ trans('language.vietnamese') }}</a>
            </div>
        </li>
        @auth
        <li class="dropdown" id="information">
            <a class="dropdown-toggle " data-toggle="dropdown" href="#" dusk="logout">
                {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li>
                    <a href="{{ route('user.logout') }}"><i class="fa fa-sign-out fa-fw"></i>{{ trans('admin.header.logout') }}</a>
                </li>
            </ul>
        </li>
        @endauth
    </ul>
    @include('admin.elements.menu')
</nav>
