<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#createBrand">
    {{ trans('admin.brand.create_new_brand') }}
</button>
<div id="createBrand" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('admin.modal_create_brand.title') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('brands.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>{{ trans('admin.modal_create_brand.name') }}</label>
                        <input type="text" class="form-control" name="name_of_create" required>
                        @error('name_of_create')
                            <span class="text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-info" value="{{ trans('admin.modal_create_brand.save') }}">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{ trans('admin.modal_create_brand.close') }}</button>
            </div>
        </div>
    </div>
</div>
