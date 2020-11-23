<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteBrand-{{ $brand->id }}">
    <i class="fa fa-fw fa-lg" aria-hidden="true">&#xf014;</i>
</button>
<div class="wrap-modal-delete-brand">
    <div id="deleteBrand-{{ $brand->id }}" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ trans('admin.modal_delete_brand.title') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <h4>{{ trans('admin.modal_delete_brand.confirm_delete') }}</h4>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('brands.destroy', $brand->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="id" value="{{ $brand->id }}">
                        <input type="submit" class="btn btn-info" value="{{ trans('admin.modal_delete_brand.delete') }}">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ trans('admin.modal_delete_brand.back') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

