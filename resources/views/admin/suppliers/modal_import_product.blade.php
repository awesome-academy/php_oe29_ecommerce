 <div class="modal-dialog">
     <div class="modal-content">
         <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal">&times;</button>
             <h4 class="modal-title">{{ trans('admin.supplier.import') . ": " . $product->name }}</h4>
         </div>
         <div class="modal-body">
             <div class="form-group">
                 <label for="name">{{ trans('admin.product_size') }}</label>
                 <span id="show_errors" class="show-size">*</span>
                 <input type="text" id="size" class="form-control" name="size" >
             </div>
             <div class="form-group">
                 <label for="original_price">{{ trans('admin.quantity') }}</label>
                 <span id="show_errors" class="show-quantity">*</span>
                 <input type="text" id="quantity" class="form-control" name="quantity">
             </div>
             <div class="form-group">
                 <label for="unit_price">{{ trans('admin.product.unit_price') }}</label>
                 <span id="show_errors" class="show-unit-price">*</span>
                 <input type="text" id="unit_price" class="form-control" name="unit_price" >
             </div>
             <div class="form-group">
                 <label for="current_price">{{ trans('admin.product.current_price') }}</label>
                 <span id="show_errors" class="show-current-price"></span>
                 <input type="text" id="current_price"  class="form-control" name="current_price" value="{{ $product->current_price }}">
             </div>
             <div class="form-group">
                 <label for="original_price">{{ trans('admin.product.original_price') }}</label>
                 <span id="show_errors" class="show-original-price">* {{ trans('message_error_price') }}</span>
                 <input type="text" id="original_price" class="form-control" name="original_price" value="{{ $product->original_price }}">
             </div>
             <div class="save-data"></div>
                 <button class="btn btn-primary submit-import"
                     data-url="{{ route('action.import', $product->id) }}"
                     data-id = {{ $supplierId }}
                     id="submit-import" type="button">{{ trans('admin.send') }}</button>
                 <button class = "btn btn-danger" type="reset"> {{ trans('admin.reset') }} </button>
            </div>
         <div class="modal-footer">
             <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin.close') }}</button>
         </div>
        </div>
 </div>


