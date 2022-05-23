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
                        @if (Session::has('order_message'))
                            <div class="alert alert-success" role="alert">{{ Session::get('order_message') }}</div>
                        @endif
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Subtotal</th>
                                    <th>Discount</th>
                                    <th>Tax</th>
                                    <th>Total</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Zipcode</th>
                                    <th>Status</th>
                                    <th>Order Date</th>
                                    <th colspan="2" class="text-center">Action</th>
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
                                        <td>{{ $order->firstname }}</td>
                                        <td>{{ $order->lastname }}</td>
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
                                        <td><a href="{{ route('admin.orderdetails', ['order_id' => $order->id]) }}"
                                                class="btn btn-info btn-sm">Details</a></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-success btn-sm dropdown-toggle" type="button"
                                                    data-toggle="dropdown">Status
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#"
                                                            wire:click.prevent="updateOrderStatus({{ $order->id }}, 'delivered')">Delivered</a>
                                                    </li>
                                                    <li><a href="#"
                                                            wire:click.prevent="updateOrderStatus({{ $order->id }}, 'cancelled')">Cancelled</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
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
