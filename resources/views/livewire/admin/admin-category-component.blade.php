<div>
    <style>
        nav svg {
            height: 20px;
        }

        nav .hidden {
            display: block !important;
        }

        .sub-category-list {
            list-style: none;
        }

        .sub-category-list li {
            line-height: 33px;
            border-bottom: 1px solid #ccc;
        }

        .slink i {
            font-size: 16px;
            margin-left: 12px;
        }

    </style>
    <div class="container" style="padding:30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="shop-title" style="display:inline;">All Categories</h3>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.addcategory') }}" class="btn btn-success pull-right">Add New
                                    Category</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                        @endif
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Name</th>
                                    <th>Slug</th>
                                    <th>Sub Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>
                                            <ul class="sub-category-list">
                                                @foreach ($category->subCategories as $sub_category)
                                                    <li><i>{{ $sub_category->name }}
                                                            <a
                                                                href="{{ route('admin.editcategory', ['category_slug' => $category->slug, 'sub_category_slug' => $sub_category->slug]) }}"><i
                                                                    class="fa fa-edit slink"></i>
                                                            </a>
                                                            <a href="#"
                                                                onclick="confirm('Are you sure you want to delete this sub category?') || event.stopImmediatePropagation()"
                                                                wire:click.prevent="deleteSubCategory({{ $sub_category->id }})"><i
                                                                    class="fa fa-times text-danger slink"></i>
                                                            </a>
                                                        </i>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.editcategory', [$category->slug]) }}"><i
                                                    class="fa fa-edit fa-2x"></i></a>
                                            <a href="#"
                                                onclick="confirm('Are you sure you want to delete this category?') || event.stopImmediatePropagation()"
                                                wire:click.prevent="deleteCategory({{ $category->id }})"
                                                style="margin-left:10px;">
                                                <i class="fa fa-times fa-2x text-danger">
                                                </i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="wrap-pagination-info">
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
