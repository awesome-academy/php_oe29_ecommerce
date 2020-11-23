<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.pages.dashboard');
    }

    public function highChart()
    {
        $orders = Order::select("status", DB::raw("count(*) as number_order"))->groupBy('status')->get();
        $data = array();
        foreach ($orders as $order) {
            switch ($order->status) {
                case config('order.status.approved') :
                    $data['approved'] = $order->number_order;

                    break;
                case config('order.status.pending') :
                    $data['pending'] = $order->number_order;

                    break;
                case config('order.status.rejected'):
                    $data['rejected'] = $order->number_order;

                    break;
                default :
                    $data['cancel'] = $order->number_order;
            }
        }

        return json_encode($data);
    }
}
