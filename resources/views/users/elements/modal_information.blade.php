@if (AUth::check())
    <div class="modal" id="modal-information">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">{{ trans('change_information') }}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ route('user.change_information') }}" method="post">
                        @csrf
                        @method("PATCH")
                        <div class="form-group">
                            <label>{{ trans('username') }}</label>
                            @error('username')
                                <div class="show-error">
                                    * {{ $errors->first('username') }}
                                </div>
                            @enderror
                            <input class="form-control" type="text" name="username" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group">
                            <label>{{ trans('phone') }}</label>
                            @error('phone')
                                <div class="show-error">
                                    * {{ $errors->first('phone') }}
                                </div>
                            @enderror
                            <input class="form-control" type="text" name="phone" value="{{ Auth::user()->phone }}">
                        </div>
                        <div class="form-group">
                            <label>{{ trans('address') }}</label>
                            @error('address')
                                <div class="show-error">
                                    * {{ $errors->first('address') }}
                                </div>
                            @enderror
                            <input class="form-control" type="text" name="address" value="{{ Auth::user()->address }}">
                        </div>
                        <input type="hidden" name="define" value="information">
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">{{ trans('admin.send') }}</button>
                            <button type="reset" class="btn btn-danger">{{ trans('admin.reset') }}</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ trans('admin.close') }}</button>
                </div>
            </div>
        </div>
    </div>
@endif
