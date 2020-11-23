<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ImportProductRequest;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;
use App\Repositories\Supplier\SupplierRepository;
use App\Repositories\Supplier\SupplierRepositoryInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;

class SupplierController extends Controller
{
    protected $supplierRepo;
    protected $productRepo;

    public function __construct(
        SupplierRepositoryInterface $supplierRepo,
        ProductRepositoryInterface $productRepo
    )
    {
        $this->supplierRepo = $supplierRepo;
        $this->productRepo = $productRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('viewAny', Supplier::class)) {
            $suppliers = $this->supplierRepo->getAll();

            return view('admin.suppliers.index', compact('suppliers'));
        }

        return abort(config('setting.errors404'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierRequest $request)
    {
        if (Auth::user()->can('create', Supplier::class)) {
            $this->supplierRepo->create($request->all());

            return redirect()->back()->with('message_success', trans('message_success'));
        }

        return abort(config('setting.errors404'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->can('view', Supplier::class)) {
            $supplier = $this->supplierRepo->find($id);
            if (empty($supplier)) {
                $data = [
                    'status' => config('setting.http_status.errors'),
                    'message' => trans('message_error'),
                ];

                return json_encode($data);
            }
            $data = [
                'status' => config('setting.http_status.success'),
                'name' => $supplier->name,
                'phone' => $supplier->phone,
                'address' => $supplier->address,
                'description' => $supplier->description,
                'url' => route('suppliers.update', $supplier->id),
            ];

            return json_encode($data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierRequest $request, $id)
    {
        if (Auth::user()->can('update', Supplier::class)) {
            $supplier = $this->supplierRepo->update($id, $request->all());

            return redirect()->back()->with('message_success', trans('message_success'));
        }

        return abort(config('setting.errors404'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->can('delete', Supplier::class)) {
            $supplier = $this->supplierRepo->delete($id);

            return redirect()->back()->with('message_success', trans('message_success'));
        }

        return abort(config('setting.errors404'));
    }

    public function showProduct($id)
    {
        if (Auth::user()->can('importProduct', Supplier::class)) {
            $supplier = $this->supplierRepo->find($id);
            $products = $this->productRepo->getAll();

            return view('admin.suppliers.import_product', compact('supplier', 'products'));
        }
    }

    public function showInfoProduct($productId, $supplierId)
    {
        $product = $this->productRepo->find($productId);

        return view('admin.suppliers.modal_import_product', compact('product', 'supplierId'));
    }

    public function updateOrCreateProductDetails(ImportProductRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepo->find($id, ['productDetails']);
            $productDetail = $product->productDetails->where('size', '=', $request->size)->first();
            $supplier = $this->supplierRepo->find($request->supplier);
            if ($request->original_price <= $request->current_price && $request->current_price != 0) {
                $product->update([
                    'current_price' => $request->current_price,
                    'original_price' => $request->original_price,
                ]);
            } else {
                $data = [
                    'id' => $id,
                    'status' => config('setting.http_status.success'),
                    'message' => trans('message_error_price'),
                ];

                return json_encode($data);
            }
            if (isset($productDetail)) {
                $productDetail->update([
                   'quantity' => $productDetail->quantity + $request->quantity,
                ]);
                $supplier->products()->attach($product, [
                    'size' => $request->size,
                    'quantity' => $request->quantity,
                    'unit_price' => $request->unit_price,
                    'paid' => config('setting.paid.payed'),
                ]);
            } else {
                $newProductDetails = ProductDetail::create([
                   'size' => $request->size,
                   'quantity' => $request->quantity,
                   'product_id' => $id,
                ]);
                $supplier->products()->attach($product, [
                    'size' => $request->size,
                    'quantity' => $request->quantity,
                    'unit_price' => $request->unit_price,
                    'paid' => config('setting.paid.payed'),
                ]);
            }
            $data = [
                'id' => $id,
                'status' => config('setting.http_status.success'),
                'message' => trans('message_success'),
                'quantity' => $product->productDetails->sum('quantity'),
                'original_price' => $product->original_price,
            ];
            DB::commit();

            return json_encode($data);
        } catch (Exception $exception) {
            DB::rollBack();
            $data = [
                'status' => config('setting.http_status.success'),
                'message' => trans('message_error'),
            ];

            return json_encode($data);
        }
    }
}
