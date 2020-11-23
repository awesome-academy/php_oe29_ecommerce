<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Image\ImageRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductDetails\ProductDetailRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $productRepo, $brandRepo, $categoryRepo, $imageRepo, $productDetailRepo;

    function __construct(
        ProductRepositoryInterface $productRepo,
        BrandRepositoryInterface $brandRepo,
        CategoryRepositoryInterface  $categoryRepo,
        ImageRepositoryInterface  $imageRepo,
        ProductDetailRepositoryInterface $productDetailRepo
    ){
        $this->productRepo = $productRepo;
        $this->brandRepo = $brandRepo;
        $this->categoryRepo = $categoryRepo;
        $this->productDetailRepo = $productDetailRepo;
        $this->imageRepo = $imageRepo;
    }

    public function index()
    {
        if (Auth::user()->can('viewAny', Product::class)) {
            $categories = $this->categoryRepo->getAll();
            $brands = $this->brandRepo->getAll();
            $products = $this->productRepo->getCountImageAndProductDetail();

            return view('admin.products.index', compact('products', 'categories', 'brands'));
        }

            return abort(config('setting.errors404'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        if (Auth::user()->can('create', Product::class)) {
            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'rate' => config('setting.rate'),
                'original_price' => $request->original_price,
                'current_price' => $request->current_price,
                'category_id' => $request->category,
                'brand_id' => $request->brand,
            ];
            $product = $this->productRepo->create($data);
            $this->uploadImage($request, $product);

            return redirect()->back()->with('message_success', trans('message_success'));
        }

            return abort(config('setting.errors404'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        if (Auth::user()->can('view', Product::class)) {
            $data  = [
                'images',
                'productDetails',
                'comments',
            ];
            $product = $this->productRepo->getRelated($id, $data);
            if ($product) {
                $images = $product->images()
                    ->where('product_id', $id)->paginate(config('setting.number_paginate'), ['*'], config('setting.paginate.image'));
                $productDetails = $product->productDetails()
                    ->where('product_id', $id)->paginate(config('setting.number_paginate'), ['*'], config('setting.paginate.product_detail'));
                $comments = $product->comments;

                return view('admin.products.detail_product', compact('product', 'images', 'productDetails', 'comments'));
            }

            return abort(config('setting.errors404'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->productRepo->find($id);
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
        if (Auth::user()->can('update', Product::class)) {
            $product = $this->productRepo->find($id);
            if ($product) {
            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'rate' => $product->rate,
                'original_price' => $request->original_price,
                'current_price' => $request->current_price,
                'category_id' => $request->category,
                'brand_id' => $request->brand,
            ];
            $this->productRepo->update($id, $data);
            $this->uploadImage($request, $product);

            return redirect()->back()->with('message_success', trans('success'));
            }

            return abort(config('setting.errors404'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->can('delete', Product::class)) {
            $this->productRepo->delete($id);

            return redirect()->back()->with('message_success', trans('message_success'));
        }

            return abort(config('setting.errors404'));
    }

    public function uploadImage(Request $request,Product $product)
    {
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $name = time() . "_" . $file->getClientOriginalName();
                $path = public_path(config('setting.image.product'));
                $data = [
                    'product_id' => $product->id,
                    'image_link' => $name,
                ];
                $this->imageRepo->create($data);
                $file->move($path, $name);
            }

            return true;
        } else {
            $data = [
                'product_id' => $product->id,
                'image_link' => config('setting.image.default'),
            ];
            $this->imageRepo->create($data);

            return  true;
        }

        return false;
    }

    public function deleteImage($id)
    {
        if (Auth::user()->can('deleteImage', Product::class)) {
            $image = $this->imageRepo->find($id);
            if (file_exists(config('setting.image.product') . $image->image_link)) {
                unlink(config('setting.image.product') . $image->image_link);
            }
            $image->delete();

            return redirect()->back()->with('message_success', trans('message_success'));
        }

            return abort(config('setting.errors404'));
    }

    public function deleteProductDetail($id)
    {
        if (Auth::user()->can('deleteProductDetail', Product::class)) {
            $this->productDetailRepo->delete($id);

            return redirect()->back()->with('message_success', trans('message_success'));
        }

            return abort(config('setting.errors404'));
    }
}
