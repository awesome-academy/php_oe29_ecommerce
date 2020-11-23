<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ trans('admin.product.add_product') }}</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">{{ trans('admin.product.name_product') }}</label>
                        @error('name')
                            <span id = "show_errors">* {{ $errors->first('name') }}</span>
                        @enderror
                        <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="original_price">{{ trans('admin.product.original_price') }}</label>
                        @error('original_price')
                            <span id = "show_errors">* {{ $errors->first('original_price') }}</span>
                        @enderror
                        <input type="text" id="original_price" class="form-control" name="original_price" value="{{ old('original_price') }}">
                    </div>
                    <div class="form-group">
                        <label for="current_price">{{ trans('admin.product.current_price') }}</label>
                        @error('current_price')
                            <span id = "show_errors">* {{ $errors->first('current_price') }}</span>
                        @enderror
                        <input type="text" id="current_price" class="form-control" name="current_price" value="{{ old('current_price') }}">
                    </div>
                    <div class="form-group">
                        <label>{{ trans('admin.brand.name_brand') }}</label>
                        @error('brand')
                        <span id = "show_errors">* {{ $errors->first('brand') }}</span>
                        @enderror
                        <select multiple="" class="form-control" name="brand">
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
                        <select multiple="" class="form-control" name="category">
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
                        <textarea class="form-control ckeditor" name="description">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">{{ trans('admin.image') }}</label>
                        @error('image')
                            <span id = "show_errors">* {{ $errors->first('image') }}</span>
                        @enderror
                        <input type="file" id="browse" class="form-control" name="images[]" multiple>
                        <div id="preview"></div>
                    </div>
                    <input value="create" hidden name="define">
                    <button class="btn btn-primary" type="submit">{{ trans('admin.product.add_product') }}</button>
                    <button class = "btn btn-danger" type="reset"> {{ trans('admin.reset') }} </button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin.close') }}</button>
            </div>
        </div>

    </div>
</div>
