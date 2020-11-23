<div id="Modaledit" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ trans('admin.edit') }}</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data" id="formEdit">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label for="name">{{ trans('admin.product.name_product') }}</label>
                        @error('name')
                            <span id = "show_errors">* {{ $message }}</span>
                        @enderror
                        <input type="text" id="name_edit" class="form-control" name="name" >
                    </div>
                    <div class="form-group">
                        <label for="original_price">{{ trans('admin.product.original_price') }}</label>
                        @error('original_price')
                            <span id = "show_errors">* {{ $errors->first('original_price') }}</span>
                        @enderror
                        <input type="text" id="original_price_edit" class="form-control" name="original_price">
                    </div>
                    <div class="form-group">
                        <label for="current_price">{{ trans('admin.product.current_price') }}</label>
                        @error('current_price')
                            <span id = "show_errors">* {{ $errors->first('current_price') }}</span>
                        @enderror
                        <input type="text" id="current_price_edit" class="form-control" name="current_price">
                    </div>
                    <div class="form-group">
                        <label>{{ trans('admin.brand.name_brand') }}</label>
                        @error('brand')
                            <span id = "show_errors">* {{ $errors->first('brand') }}</span>
                        @enderror
                        <select multiple="" class="form-control brand" name="brand">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('category') }}</label>
                        @error('category')
                            <span id = "show_errors">* {{ $errors->first('category') }}</span>
                        @enderror
                        <select multiple="" class="form-control category" name="category">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('description') }}</label>
                        @error('description')
                            <span id = "show_errors">* {{ $errors->first('description') }}</span>
                        @enderror
                        <textarea id="description_edit" class="form-control ckeditor" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">{{ trans('image') }}</label>
                        @error('image')
                            <span id = "show_errors">* {{ $errors->first('image') }}</span>
                        @enderror
                        <input type="file" id="edit-browse" class="form-control" name="images[]" multiple>
                        <div id="edit-preview"></div>
                    </div>
                    <input value="edit" hidden name="define">
                    <button class="btn btn-primary" type="submit" >{{ trans('admin.edit') }}</button>
                    <button class = "btn btn-danger" type="reset"> {{ trans('admin.reset') }} </button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin.close') }}</button>
            </div>
        </div>
    </div>
</div>
