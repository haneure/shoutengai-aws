<main id="main">
    <div class="container">

        <!--MAIN SLIDE-->

        <div class="wrap-main-slide">
            <div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true"
                data-dots="false">
                @foreach ($sliders as $slide)
                    <div class="item-slide">
                        @if (strpos($slide->image, 'http') !== false)
                            <img src=" {{ $slide->image }}" alt="" class="img-slide">
                        @else
                            <img src=" {{ asset('assets/images/sliders') }}/{{ $slide->image }}" alt=""
                                class="img-slide">
                        @endif
                        <div class="slide-info slide-3">
                            <h2 class="f-title"><b style="color: white !important;">{{ $slide->title }}</b></h2>
                            <span class="subtitle" style="color: white !important;">{{ $slide->subtitle }}</span>
                            <p class="sale-info" style="color: white !important;">Only <span
                                    class="price">${{ $slide->price }}</span></p>
                            <a href="{{ $slide->link }}" class="btn-link">Shop Now</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


    </div>
    </div>

    <!--BANNER-->
    {{-- <div class="wrap-banner style-twin-default">
        <div class="banner-item">
            <a href="#" class="link-banner banner-effect-1">
                <figure><img src="{{ asset('assets/images/home-1-banner-1.jpg') }}" alt="" width="960" height="200">
                </figure>
            </a>
        </div>
        <div class="banner-item">
            <a href="#" class="link-banner banner-effect-1">
                <figure><img src="{{ asset('assets/images/home-1-banner-2.jpg') }}" alt="" width="960" height="200">
                </figure>
            </a>
        </div>
    </div> --}}

    <!--On Sale-->
    @if ($saleproducts->count() > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
        <div class="wrap-show-advance-info-box style-1 has-countdown">
            <h3 class="title-box">On Sale</h3>
            <div class="wrap-countdown mercado-countdown"
                data-expire="{{ Carbon\Carbon::parse($sale->sale_date)->format('Y/m/d h:m:s') }}"></div>
            <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5"
                data-loop="false" data-nav="true" data-dots="false"
                data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>

                @foreach ($saleproducts as $saleproduct)
                    <div class="product product-style-2 equal-elem ">
                        <div class="product-thumnail">
                            <a href="{{ route('product.details', ['slug' => $saleproduct->slug]) }}"
                                title="{{ $saleproduct->name }}">
                                @if (strpos($saleproduct->image, 'http') !== false)
                                    <figure><img src="{{ $saleproduct->image }}" width="1200" height="1200" alt="">
                                    </figure>
                                @else
                                    <figure><img
                                            src="{{ asset('assets/images/products') }}/{{ $saleproduct->image }}"
                                            width="1200" height="1200" alt="">
                                    </figure>
                                @endif

                            </a>
                            <div class="group-flash">
                                <span class="flash-item sale-label">sale</span>
                            </div>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-name"><span>{{ $saleproduct->name }}</span></a>
                            <div class="wrap-price"><ins>
                                    <p class="product-price">${{ $saleproduct->sale_price }}</p>
                                </ins> <del>
                                    <p class="product-price">${{ $saleproduct->regular_price }}</p>
                                </del>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    @endif

    <!--Latest Products-->
    <div class="wrap-show-advance-info-box style-1">
        <h3 class="title-box">Latest Products</h3>
        <div class="wrap-top-banner">
            <a href="#" class="link-banner banner-effect-2">
                <figure><img src="{{ asset('assets/images/ads-banner-nvidia.jpg') }}" width="100%" height="240"
                        alt="">
                </figure>
            </a>
        </div>
        <div class="wrap-products">
            <div class="wrap-product-tab tab-style-1">
                <div class="tab-contents">
                    <div class="tab-content-item active" id="digital_1a">
                        <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container"
                            data-items="5" data-loop="false" data-nav="true" data-dots="false"
                            data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
                            @foreach ($latestproducts as $latestproduct)
                                <div class="product product-style-2 equal-elem ">
                                    <div class="product-thumnail">
                                        @if ($latestproduct->sale_price)
                                            <div class="group-flash" style="margin-left: 50px;">
                                                <span class="flash-item sale-label">sale</span>
                                            </div>
                                        @endif
                                        <a href="{{ route('product.details', ['slug' => $latestproduct->slug]) }}"
                                            title="{{ $latestproduct->name }}">
                                            @if (strpos($latestproduct->image, 'http') !== false)
                                                <figure><img src="{{ $latestproduct->image }}" width="800"
                                                        height="800" alt={{ $latestproduct->name }}>
                                                </figure>
                                            @else
                                                <figure><img
                                                        src="{{ asset('assets/images/products') }}/{{ $latestproduct->image }}"
                                                        width="800" height="800" alt={{ $latestproduct->name }}>
                                                </figure>
                                            @endif

                                        </a>
                                        <div class="group-flash">
                                            <span class="flash-item new-label">new</span>
                                        </div>
                                        <div class="wrap-btn">
                                            <a href="{{ route('product.details', ['slug' => $latestproduct->slug]) }}"
                                                class="function-link">quick view</a>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <a href="#"
                                            class="product-name"><span>{{ $latestproduct->name }}</span></a>
                                        @if ($latestproduct->sale_price)
                                            <div class="wrap-price"><ins>
                                                    <p class="product-price">${{ $latestproduct->sale_price }}</p>
                                                </ins> <del>
                                                    <p class="product-price">${{ $latestproduct->regular_price }}
                                                    </p>
                                                </del>
                                            </div>
                                        @else
                                            <div class="wrap-price"><span
                                                    class="product-price">${{ $latestproduct->regular_price }}</span>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Product Categories-->
    <div class="wrap-show-advance-info-box style-1">
        <h3 class="title-box">Product Categories</h3>
        <div class="wrap-top-banner">
            <a href="#" class="link-banner banner-effect-2">
                <figure><img src="{{ asset('assets/images/fashion-accesories-banner.jpg') }}"
                        style="background-size: 100%;" width="1920" height="240" alt="">
                </figure>
            </a>
        </div>
        <div class="wrap-products">
            <div class="wrap-product-tab tab-style-1">
                <div class="tab-control">
                    @foreach ($categories as $key => $category)
                        <a href="#category_{{ $category->id }}"
                            class="tab-control-item {{ $key == 0 ? 'active' : '' }}">{{ $category->name }}</a>
                    @endforeach
                </div>

                <div class="tab-contents">
                    @foreach ($categories as $key => $category)
                        <div class="tab-content-item {{ $key == 0 ? 'active' : '' }}"
                            id="category_{{ $category->id }}">
                            <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container"
                                data-items="5" data-loop="false" data-nav="true" data-dots="false"
                                data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
                                @php
                                    $c_products = DB::table('products')
                                        ->where('category_id', $category->id)
                                        ->get()
                                        ->take($no_of_products);
                                @endphp

                                @foreach ($c_products as $c_product)
                                    <div class="product product-style-2 equal-elem ">
                                        <div class="product-thumnail">
                                            @if ($c_product->sale_price)
                                                @if ($c_product->created_at == Carbon\Carbon::now())
                                                    <div class="group-flash" style="margin-left: 50px;">
                                                        <span class="flash-item sale-label">sale</span>
                                                    </div>
                                                @else
                                                    <div class="group-flash">
                                                        <span class="flash-item sale-label">sale</span>
                                                    </div>
                                                @endif
                                            @endif
                                            @if ($c_product->created_at == Carbon\Carbon::now())
                                                <div class="group-flash">
                                                    <span class="flash-item new-label">new</span>
                                                </div>
                                            @endif
                                            <a href="{{ route('product.details', ['slug' => $c_product->slug]) }}"
                                                title="{{ $c_product->name }}">
                                                @if (strpos($c_product->image, 'http') !== false)
                                                    <figure><img src="{{ $c_product->image }}" width="800"
                                                            height="800" alt="{{ $c_product->name }}">
                                                    </figure>
                                                @else
                                                    <figure><img
                                                            src="{{ asset('assets/images/products') }}/{{ $c_product->image }}"
                                                            width="800" height="800" alt="{{ $c_product->name }}">
                                                    </figure>
                                                @endif

                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <a href="{{ route('product.details', ['slug' => $c_product->slug]) }}"
                                                class="product-name"><span>{{ $c_product->name }}</span></a>

                                            @if ($c_product->sale_price)
                                                <div class="wrap-price"><ins>
                                                        <p class="product-price">${{ $c_product->sale_price }}</p>
                                                    </ins> <del>
                                                        <p class="product-price">${{ $c_product->regular_price }}
                                                        </p>
                                                    </del>
                                                </div>
                                            @else
                                                <div class="wrap-price"><span
                                                        class="product-price">${{ $c_product->regular_price }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
