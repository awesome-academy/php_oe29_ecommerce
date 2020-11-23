<div id="modal-edit-supplier" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ trans('admin.edit') }}</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data" id="form-edit">
                    @method("PUT")
                    @csrf
                    <div class="form-group">
                        <label for="name">{{ trans('admin.supplier.name_supplier') }}</label>
                        @error('name')
                            <span id = "show_errors">* {{ $errors->first('name') }}</span>
                        @enderror
                        <input type="text" id="edit-name" class="form-control" name="name" >
                    </div>
                    <div class="form-group">
                        <label for="original_price">{{ trans('admin.supplier.phone') }}</label>
                        @error('phone')
                            <span id = "show_errors">* {{ $errors->first('phone') }}</span>
                        @enderror
                        <input type="text" id="edit-phone" class="form-control" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="current_price">{{ trans('admin.supplier.address') }}</label>
                        @error('address')
                            <span id = "show_errors">* {{ $errors->first('address') }}</span>
                        @enderror
                        <input type="text" id="edit-address" class="form-control" name="address">
                    </div>
                    <div class="form-group">
                        <label>{{ trans('description') }}</label>
                        @error('description')
                            <span id = "show_errors">* {{ $errors->first('description') }}</span>
                        @enderror
                        <textarea class="form-control ckeditor" id="edit-description" name="description"></textarea>
                    </div>
                    <input value="edit" hidden name="define">
                    <button class="btn btn-primary" type="submit">{{ trans('admin.edit') }}</button>
                    <button class = "btn btn-danger" type="reset"> {{ trans('admin.reset') }} </button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin.close') }}</button>
            </div>
        </div>
    </div>
</div>
