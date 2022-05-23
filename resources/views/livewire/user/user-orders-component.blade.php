<div>
    <style>
        nav svg {
            height: 20px;
        }

        nav .hidden {
            display: block !important;
        }

        .badge-main {
            background-color: #7d7d7d !important;
        }

        .badge-success {
            background-color: #4caf50 !important;
        }

        .badge-warning {
            background-color: #ff9800 !important;
        }

        .badge-danger {
            background-color: #f44336 !important;
        }

    </style>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="shop-title" style="display:inline;">All Orders</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped text-center">
                            <thead>
                                <tr>
                                    <th class="text-center">Order ID</th>
                                    <th class="text-center">Subtotal</th>
                                    <th class="text-center">Discount</th>
                                    <th class="text-center">Tax</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Mobile</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Zipcode</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Order Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>${{ $order->subtotal }}</td>
                                        <td>${{ $order->discount }}</td>
                                        <td>${{ $order->tax }}</td>
                                        <td>${{ $order->total }}</td>
                                        <td>{{ $order->firstname }} {{ $order->lastname }}</td>
                                        <td>{{ $order->mobile }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->zipcode }}</td>
                                        <td>
                                            @if ($order->status == 'ordered')
                                                <span class="badge badge-warning">Ordered</span>
                                            @elseif ($order->status == 'delivered')
                                                <span class="badge badge-success">Delivered</span>
                                            @elseif ($order->status == 'cancelled')
                                                <span class="badge badge-danger">Cancelled</span>
                                            @endif
                                        </td>

                                        <td>{{ $order->created_at }}</td>
                                        <td><a href="{{ route('user.orderdetails', ['order_id' => $order->id]) }}"
                                                class="btn btn-info btn-sm">Details</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="wrap-pagination-info">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
