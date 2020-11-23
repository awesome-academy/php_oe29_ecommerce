@extends('users.layouts.auth')

@section('content')
    <div class="wrap-user-login-page">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ trans('login') }}</h3>
                        </div>
                        <div class="panel-body">
                            <form action="{{ route('user.postLogin') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="{{ trans('email') }}" autofocus required>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="{{ trans('password') }}" required>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">{{ trans('remember_me') }}
                                    </label>
                                </div>
                                <input type="submit" class="btn btn-lg btn-primary btn-block" value="{{ trans('login') }}">
                            </form>
                            <a href="#" class="btn-forgot-password">{{ trans('forgot_password') }}</a>
                            <a href="{{ route('user.getRegister') }}" class="btn-register">{{ trans('register_account') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
