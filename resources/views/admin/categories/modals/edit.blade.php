<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editCategory-{{ $category->id }}">
    <i class="fa fa-fw fa-lg" aria-hidden="true">&#xf044;</i>
</button>
<div id="editCategory-{{ $category->id }}" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('admin.modal_edit_category.title') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label>{{ trans('admin.modal_edit_category.name') }}</label>
                        <input type="text" class="form-control" name="name" value="{{ $category->name }}" required>
                        @error('name')
                            <span class="text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                     <div class="form-group">
                        <label>{{ trans('admin.modal_edit_category.parent') }}</label>
                        <select class="form-control" name="parent_id">
                            <option value="{{ null }}">{{ trans('admin.modal_edit_category.none_parent') }}</option>
                            @foreach ($categories->where('parent_id', null) as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                            @endforeach
                        </select>
                        </select>
                    </div>
                    <input class="hide" type="hidden" name="define" value="editCategory-{{ $category->id }}">
                    <div class="form-group">
                        <input type="submit" class="btn btn-info" value="{{ trans('admin.modal_edit_category.save') }}">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{ trans('admin.modal_edit_category.close') }}</button>
            </div>
        </div>
    </div>
</div>
