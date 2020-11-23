@if (Auth::check())
    <div class="modal" id="modal-password">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">{{ trans('change_password') }}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ route('user.change_password') }}" method="post">
                        @csrf
                        @method("PATCH")
                        <div class="form-group">
                            <label>{{ trans('old_password') }}</label>
                            @error("old_password")
                                <div class="show-error">
                                    * {{ $errors->first('old_password') }}
                                </div>
                            @enderror
                            <input class="form-control" type="password" name="old_password">
                        </div>
                        <div class="form-group">
                            <label>{{ trans('new_password') }}</label>
                            @error("new_password")
                                <div class="show-error">
                                    * {{ $errors->first('new_password') }}
                                </div>
                            @enderror
                            <input class="form-control" type="password" name="new_password">
                        </div>
                        <div class="form-group">
                            <label>{{ trans('rep_password') }}</label>
                            @error("rep_password")
                                <div class="show-error">
                                    * {{ $errors->first('rep_password') }}
                                </div>
                            @enderror
                            <input class="form-control" type="password" name="rep_password">
                        </div>
                        <input type="hidden" value="password" name="define">
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
