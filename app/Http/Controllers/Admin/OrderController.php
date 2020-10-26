<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Policies\OrderPolicy;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->user->can('viewAny', Order::class)) {
            $orders = Order::OrderBy('status')->withCount('productDetails')->get();

            return view('admin.orders.index', compact('orders'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->can('view', Order::class)) {
            $order = Order::with(['productDetails', 'user'])->findOrFail($id);
            $productDetails = $order->productDetails;
            $user = $order->user;

            return view('admin.orders.modal_detail_order', compact('order', 'productDetails', 'user'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function approvedOrder($id)
    {
        DB::beginTransaction();
        $data = [
            'status' => config('setting.http_status.success'),
            'message' => trans('message_success'),
        ];
        try {
            $order = Order::with('productDetails')->findOrFail($id);
            if ($order->status != config('order.status.approved')) {
                $productDetails = $order->productDetails;
                foreach ($productDetails as $product) {
                    if ($product->quantity >= $product->pivot->quantity) {
                        $product->update([
                            'quantity' => $product->quantity - $product->pivot->quantity,
                        ]);
                    } else {
                        $data['status'] = config('setting.http_status.error');
                        $data['message'] = trans('admin.order.not_enough');

                        return json_encode($data);
                    }
                }
                $order->update([
                    'status' => config('order.status.approved'),
                ]);
                $data['id'] = $order->id;
                DB::commit();

                return json_encode($data);
            } else {
                $data['status'] = config('setting.http_status.serve');
                $data['message'] = trans('admin.order.approved_error');

                return  json_encode($data);
            }
        } catch (Exception $exception) {
            DB::rollBack();
            $data['status'] = config('setting.http_status.error');
            $data['message'] = trans('message_errors');

            return json_encode($data);
        }
    }

    public function rejectedOrder($id)
    {
        DB::beginTransaction();
        $data = [
            'status' => config('setting.http_status.success'),
            'message' => trans('message_success'),
        ];
        try {
            $order = Order::with(['productDetails'])->findOrFail($id);
            if ($order->status != config('order.status.rejected')
                && $order->status != config('order.status.approved')) {
                $order->update([
                   'status' => config('order.status.rejected')
                ]);
                $data['id'] = $order->id;
                DB::commit();

                return json_encode($data);
            } elseif ($order->status == config('order.status.approved')) {
                $productDetails = $order->productDetails;
                foreach ($productDetails as $product) {
                    if ($product->quantity >= $product->pivot->quantity) {
                        $product->update([
                            'quantity' => $product->quantity + $product->pivot->quantity,
                        ]);
                    }
                }
                $order->update([
                    'status' => config('order.status.rejected')
                ]);
                $data['id'] = $order->id;
                DB::commit();

                return json_encode($data);
            } else {
                $data['status'] = config('setting.http_status.serve');
                $data['message'] = trans('admin.order.rejected_error');

                return  json_encode($data);
            }
        } catch (Exception $exception) {
            DB::rollBack();
            $data['status'] = config('setting.http_status.error');
            $data['message'] = trans('message_errors');

            return json_encode($data);
        }
    }
}
