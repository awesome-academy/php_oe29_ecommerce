<div class="sidebar-box-2">
    <h2 class="heading">{{ trans('price_range') }}</h2>
    <form action="{{ route('user.filter_by_price') }}" method="post" class="colorlib-form-2">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="guests">{{ trans('price_from') }}</label>
                    <div class="form-field">
                        <i class="icon icon-arrow-down3"></i>
                        @php
                            $priceTo = config('setting.range_price.price_to');
                            $priceFrom = config('setting.range_price.price_from');
                        @endphp
                        <select name="price_from" id="pricefrom" class="form-control">
                            <option value="0" selected>{{ trans('select_price') }}</option>
                            @foreach ($priceFrom as $key => $price)
                                <option value="{{ $price }}">{{ number_format($price) . trans('admin.money.vi') }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="guests">{{ trans('price_to') }}</label>
                    <div class="form-field">
                        <i class="icon icon-arrow-down3"></i>
                        <select name="price_to" id="price_to" class="form-control">
                            @foreach ($priceTo as $key => $price)
                                <option value="{{ $price }}">{{ number_format($price) . trans('admin.money.vi') }}</option>
                            @endforeach
                            <option value="0" selected>{{ trans('select_price') }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <button class="btn btn-primary" type="submit">{{ trans('search') }}</button>
            </div>
        </div>
    </form>
</div>
