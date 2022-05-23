<div>
    <style>
        nav svg {
            height: 20px;
        }

        nav .hidden {
            display: block !important;
        }

    </style>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-4">
                                <h3 class="shop-title" style="display:inline;">All Products</h3>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="" id="" placeholder="Search. . ." class="form-control"
                                    wire:model="searchTerm" />
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('admin.addproduct') }}" class="btn btn-success pull-right">Add New
                                    Product</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('message') }}
                            </div>
                        @endif
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Sale Price</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            @if (strpos($product->image, 'http') !== false)
                                                <img src="{{ $product->image }}" alt="{{ $product->name }}"
                                                    width="60">
                                            @else
                                                <img src="{{ asset('assets/images/products') }}/{{ $product->image }}"
                                                    alt="{{ $product->name }}" width="60">
                                            @endif
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->stock_status }}</td>
                                        <td>{{ $product->regular_price }}</td>
                                        <td>{{ $product->sale_price }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->created_at }}</td>
                                        <td>
                                            <a
                                                href="{{ route('admin.editproduct', ['product_slug' => $product->slug]) }}"><i
                                                    class="fa fa-edit fa-2x text-info"></i></a>
                                            <a href="#"
                                                onclick="confirm('Are you sure you want to delete this product?') || event.stopImmediatePropagation()"
                                                style="margin-left:10px;"
                                                wire:click.prevent="deleteProduct({{ $product->id }})"><i
                                                    class="fa fa-times fa-2x text-danger"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="wrap-pagination-info">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
