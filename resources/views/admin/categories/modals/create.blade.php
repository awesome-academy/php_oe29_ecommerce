<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#createCategory">
    {{ trans('admin.category.create_new_category') }}
</button>
<div id="createCategory" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('admin.modal_create_category.title') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>{{ trans('admin.modal_create_category.name') }}</label>
                        <input type="text" class="form-control" name="name" required>
                        @error('name')
                            <span class="text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                     <div class="form-group">
                        <label>{{ trans('admin.modal_create_category.parent') }}</label>
                        <select class="form-control" name="parent_id">
                            <option value="{{ null }}">{{ trans('admin.modal_create_category.none_parent') }}</option>
                            @foreach ($categories->where('parent_id', null) as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input class="hide" type="hidden" name="define" value="create">
                    <div class="form-group">
                        <input type="submit" class="btn btn-info" value="{{ trans('admin.modal_create_category.save') }}">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{ trans('admin.modal_create_category.close') }}</button>
            </div>
        </div>
    </div>
</div>
