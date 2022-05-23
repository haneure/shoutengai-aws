<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AdminDashboardComponent extends Component
{
    public function updateOrderStatus($order_id, $status)
    {
        $order = Order::find($order_id);
        $order->status = $status;
        if($status == 'delivered') {
            $order->delivered_date = DB::raw('CURRENT_TIMESTAMP');
        } else if ($status == 'cancelled') {
            $order->canceled_date = DB::raw('CURRENT_TIMESTAMP');
        }
        $order->save();
        session()->flash('order_message', 'Order status updated successfully');
    }

    public function render()
    {
        $orders = Order::orderBy('created_at', 'DESC')->get()->take(10);
        $totalSales = Order::where('status', 'delivered')->count();
        $totalRevenue = Order::where('status', 'delivered')->sum('total');

        $todaySales = Order::where('status', 'delivered')->whereDate('created_at', Carbon::today())->count();
        $todayRevenue = Order::where('status', 'delivered')->whereDate('created_at', Carbon::today())->sum('total');

        return view('livewire.admin.admin-dashboard-component', [
            'orders'=>$orders,
            'totalSales'=>$totalSales,
            'totalRevenue'=>$totalRevenue,
            'todaySales'=>$todaySales,
            'todayRevenue'=>$todayRevenue
        ])->layout('layouts.base');
    }
}
