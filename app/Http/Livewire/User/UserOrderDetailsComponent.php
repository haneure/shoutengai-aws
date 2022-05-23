<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UserOrderDetailsComponent extends Component
{
    public $order_id;

    public function mount($order_id) {
        $this->order_id = $order_id;
    }

    public function renderOrderStatus($order) {
        if($order->status == 'delivered') {
            return '<span class="badge badge-success">Delivered</span>';
        } else if($order->status == 'cancelled') {
            return '<span class="badge badge-danger">Cancelled</span>';
        } else if($order->status == 'ordered') {
            return '<span class="badge badge-warning">Pending</span>';
        }
    }

    public function renderTransactionStatus($order) {
        if($order->transaction->status == 'approved') {
            return '<span class="badge badge-success">Success</span>';
        } else if($order->transaction->status == 'declined') {
            return '<span class="badge badge-danger">Failed</span>';
        } else if($order->transaction->status == 'refunded') {
            return '<span class="badge">Refunded</span>';
        } else if($order->transation->status == 'pending') {
            return '<span class="badge badge-warning">Pending</span>';
        }
    }

    public function cancelOrder() {
        $order = Order::find($this->order_id);
        $order->status = 'cancelled';
        $order->canceled_date = DB::raw('CURRENT_TIMESTAMP');
        $order->save();
        session()->flash('order_message', 'Order Cancelled Successfully');
    }

    public function render()
    {
        $order = Order::where('user_id', Auth::user()->id)->where('id', $this->order_id)->first();

        $order_status = '<span class="badge badge-warning">Ordered</span>';
        $transaction_status = '<span class="badge badge-warning">Pending</span>';

        $order_status = $this->renderOrderStatus($order);
        if($order->transaction->mode == 'card') {
            $transaction_status = $this->renderTransactionStatus($order);
        } else {
            $transaction_status = '<span class="badge badge-success">COD</span>';
        }

        return view('livewire.user.user-order-details-component', ['order'=>$order, 'order_status'=>$order_status, 'transaction_status'=>$transaction_status])->layout('layouts.base');
    }
}
