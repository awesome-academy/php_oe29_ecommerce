@extends('users.layouts.auth')

@section('content')
    <div class="wrap-user-register-page">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ trans('user.register.title') }}</h3>
                        </div>
                        <div class="panel-body">
                            <form action="{{ route('user.postRegister') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="{{ trans('user.register.name') }}" autofocus required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="{{ trans('user.register.email') }}"required>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="{{ trans('user.register.password') }}" required>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" name="repeat_password" class="form-control" placeholder="{{ trans('user.register.repeat_password') }}" required>
                                    @error('repeat_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="submit" class="btn btn-lg btn-primary btn-block" value="{{ trans('user.register.submit') }}">
                            </form>
                            <a href="{{ route('user.getLogin') }}" class="btn-login">{{ trans('user.register.back_to_login') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
