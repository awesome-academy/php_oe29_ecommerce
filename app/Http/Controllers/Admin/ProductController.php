<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Policies\ProductPolicy;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->user->can('viewAny', Product::class)) {
            $categories = Category::select('id', 'name')->get();
            $brands = Brand::select('id', 'name')->get();
            $products = Product::withCount(['images', 'productDetails'])->get();

            return view('admin.products.index', compact('products', 'categories', 'brands'));
        }

        return abort(config('setting.error404'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        if ($this->user->can('update', Product::class)) {
            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'rate' => config('setting.rate'),
                'original_price' => $request->original_price,
                'current_price' => $request->current_price,
                'category_id' => $request->category,
                'brand_id' => $request->brand,
            ]);
            $this->uploadImage($request, $product);

            return redirect()->back()->with('message_success', trans('message_success'));
        }

        return abort(config('setting.error404'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($this->user->can('view', Product::class)) {
            $product = Product::with(['images', 'productDetails'])->find($id);
            $images = $product->images()->where('product_id', $id)->paginate(config('setting.number_paginate'), ['*'], config('setting.paginate.image'));
            $productDetails = $product->productDetails()->where('product_id', $id)->paginate(config('setting.number_paginate'), ['*'], config('setting.paginate.product_detail'));

            return view('admin.products.detail_product', compact('product','images', 'productDetails'));
        }

        return abort(config('setting.error404'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findorFail($id);
        $data = [
            'name' => $product->name,
            'current_price' => $product->current_price,
            'original_price' => $product->original_price,
            'description' => $product->description,
            'category' => $product->category_id,
            'brand' => $product->brand_id,
            'url' => route('products.update', $product->id),
        ];

        return json_encode($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        if ($this->user->can('update', Product::class)) {
            $product = Product::findOrFail($id);
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'rate' => $product->rate,
                'original_price' => $request->original_price,
                'current_price' => $request->current_price,
                'category_id' => $request->category,
                'brand_id' => $request->brand,
            ]);
            $this->uploadImage($request, $product);

            return redirect()->back()->with('message_success', trans('success'));
            }

        return abort(config('setting.error404'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->user->can('delete', Product::class)) {
            $product = Product::findOrFail($id);
            $product->delete();

            return redirect()->back()->with('message_success', trans('message_success'));
        }

        return abort('404');
    }

    public function uploadImage($request, $product)
    {
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $name = time() . "_" . $file->getClientOriginalName();
                $path = public_path(config('setting.image.product'));
                $image = Image::create([
                    'product_id' => $product->id,
                    'image_link' => $name,
                ]);
                $file->move($path, $name);
            }
        }
    }

    public function deleteImage($id)
    {
        if ($this->user->can('delete', Product::class)) {
            $image = Image::findorFail($id);
            if (file_exists(config('setting.image.product') . $image->image_link)) {
                unlink(config('setting.image.product') . $image->image_link);
            }
            $image->delete();

            return redirect()->back()->with('message_success', trans('message_success'));
        }

        return abort(config('setting.error404'));

    }

    public function deleteProductDetail($id)
    {
        if ($this->user->can('deleteProductDetail', Product::class)) {
            $productDetail = ProductDetail::findOrFail($id);
            $productDetail->delete();

            return redirect()->back()->with('message_success', trans('message_success'));
        }

        return abort(config('setting.error404'));

    }
}
