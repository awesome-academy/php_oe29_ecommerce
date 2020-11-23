@extends('admin.layouts.master')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" id="name_product">{{ $product->name }}</h1>
                </div>
            </div>
            <div class="container">
                @if (session('message_success'))
                    <div class="alert alert-success">
                        {{ session('message_success') }}
                    </div>
                @endif
            </div>
            <div class="container">
                <ul class="nav nav-pills" id="jtab">
                    <li class="active"><a data-toggle="pill" href="#description">{{ trans('admin.description') }}</a></li>
                    <li><a data-toggle="pill" href="#image">{{ trans('admin.image') }}</a></li>
                    <li><a data-toggle="pill" href="#detail">{{ trans('admin.product.list_size') }}</a></li>
                </ul>
                <div class="tab-content">
                    <div id="description" class="tab-pane fade in active">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="item-product">
                                    <span id="infor">{{ trans('admin.brand.name') }} </span>
                                    {{ $product->brand->name }}
                                </p>
                                <p class="item-product">
                                    <span id="infor">{{ trans('admin.category.name') }}</span>
                                {{ $product->category->name }}
                                <p class="item-product">
                                    <span id="infor">{{ trans('admin.rate') }}</span>
                                    <span class="infor">
                                        @for ($i = $product->rate; $i > 0; $i--)
                                            <i class="fa fa-fw star" aria-hidden="true"></i>
                                        @endfor
                                    </span>
                                </p>
                                <p class="item-product">
                                    <span id="infor">{{ trans('admin.quantity') }}</span>
                                        {{ $product->productDetails->sum('quantity') }}
                                </p>
                                <div class="row item-product">
                                    <div class="col-md-4">
                                        <span id="infor">{{ trans('admin.description') }}</span>
                                    </div>
                                    <div class="col-md-8">
                                        {!! $product->description !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="rating-wrap">
                                    <h3 class="mb-4">{{ trans('give_a_comment') }}</h3>
                                    @php
                                        $rate = config('setting.rate');
                                    @endphp
                                    @if ($comments->count('id') != 0)
                                        @while ($rate)
                                            <p class="star">
                                                    <span class="infor">
                                                        @for ($i = $rate; $i > 0; $i--)
                                                            <i class="fa fa-fw star" aria-hidden="true"></i>
                                                        @endfor
                                                        {{ round($comments->where('rate', '=', $rate)->count('id') / $comments->count('id') * 100) . "%"}}
                                                    </span>
                                                <span class="infor title-comment">
                                                        {{ $comments->where('rate', '=', $rate)->count('id') . " " . trans('admin.comment') }}
                                                </span>
                                            </p>
                                            @php
                                                $rate = $rate - 1;
                                            @endphp
                                        @endwhile
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (count($images))
                        <div id="image" class="tab-pane fade">
                            <div class="row">
                                @foreach ($images as $key => $image)
                                    <div class="col-md-3 item-detail-product">
                                        <div class="img">
                                            <img class="img-circle item-image" src="{{ asset(config('setting.image.product') . $image->image_link) }}">
                                        </div>
                                        <form class="delete-product delete-image"
                                              action="{{ route('delete.image', $image->id) }}"
                                              data-message ="{{ trans('admin.delete') . trans('admin.image') }}"
                                              method="post" >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-warning btn-circle " id="delete-image">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                            <div class="text-center">
                                {{ $images->appends(config('setting.paginate.image'))->links() }}
                            </div>
                        </div>
                    @else
                        <div id="image" class="tab-pane fade ">
                           <h2>{{ trans('admin.product.currently_image') }}</h2>
                        </div>
                    @endif
                    @if (count($productDetails))
                        <div id="detail" class="tab-pane fade">
                                <h3>{{ trans('admin.product.list_size') }}</h3>
                                <div class="row">
                                    <div classs="col-md-6">
                                        <div class="data-product-detail">
                                            <table class="table">
                                                <thead class="header-table">
                                                <tr>
                                                    <th>{{ trans('admin.#') }}</th>
                                                    <th>{{ trans('admin.product_size') }}</th>
                                                    <th>{{ trans('admin.quantity') }}</th>
                                                    <th>{{ trans('admin.action') }}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($productDetails as $key => $productDetail)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $productDetail->size }}</td>
                                                        <td>{{ $productDetail->quantity }}</td>
                                                        <td>
                                                            <form action="{{ route('delete.productDetail', $productDetail->id) }}"
                                                                  data-message ="{{ trans('admin.delete') . trans('admin.product.list_size')}}"
                                                                  class="delete-product"
                                                                  method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger" dusk="delete-productdetail" type="submit">{{ trans('admin.delete') }}</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">{{ $productDetails->appends(config('setting.paginate.product_detail'))->links() }}</div>
                            </div>
                    @else
                        <div id="detail" class="tab-pane fade text-center">
                            <h2>{{ trans('admin.product.currently_product_detail') }}</h2>
                        </div>
                    @endif
                </div>
            </div>

            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <style>

    </style>
@endsection
@section('js')

@endsection
