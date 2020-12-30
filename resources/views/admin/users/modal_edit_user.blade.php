<div id="modal-edit" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ trans('admin.product.add_product') }}</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data" class="edit-user">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label for="name">{{ trans('admin.user.name') }}</label>
                        @error('name')
                            <span id = "show_errors">&#42; {{ $errors->first('name') }}</span>
                        @enderror
                        <input type="text" id="edit-name" class="form-control" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="name">{{ trans('admin.user.address') }}</label>
                        @error('address')
                            <span id = "show_errors">&#42; {{ $errors->first('address') }}</span>
                        @enderror
                        <input type="text" id="edit-address" class="form-control" name="address" value="{{ old('address') }}">
                    </div>
                    <div class="form-group">
                        <label for="original_price">{{ trans('admin.user.phone') }}</label>
                        @error('phone')
                            <span id = "show_errors">&#42; {{ $errors->first('phone') }}</span>
                        @enderror
                        <input type="text" id="edit-phone" class="form-control" name="phone" value="{{ old('phone') }}">
                    </div>
                    <div class="form-group">
                        <label for="edit-email">{{ trans('admin.user.email') }}</label>
                        @error('email')
                            <span id = "show_errors">&#42; {{ $errors->first('email') }}</span>
                        @enderror
                        <input type="email" id="edit-email" class="form-control" name="email" value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <label>{{ trans('admin.role') }}</label>
                        @error('role')
                            <span id = "show_errors">&#42; {{ $errors->first('role') }}</span>
                        @enderror
                        <select multiple="" class="form-control" name="role" id="role">
                            @foreach ($roles as $role)
                                <option class="role" value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">{{ trans('admin.image') }}</label>
                        @error('image')
                            <span id = "show_errors">&#42; {{ $errors->first('image') }}</span>
                        @enderror
                        <input type="file" id="edit-browse" class="form-control" name="image">
                    </div>
                    <input value="edit" hidden name="define">
                    <button class="btn btn-primary" type="submit">{{ trans('admin.user.edit') }}</button>
                    <button class = "btn btn-danger" type="reset"> {{ trans('admin.reset') }} </button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin.close') }}</button>
            </div>
        </div>

    </div>
</div>
