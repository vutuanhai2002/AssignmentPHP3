@extends('client.client_layout.layout')
@section('content')

    <!--header area end-->
    <div class="header_bottom">
        <div class="row align-items-center">
            <div class="column1 col-lg-3 col-md-6">
                <div class="categories_menu">
                    <div class="categories_title">
                        <h2 class="categori_toggle">ALL CATEGORIES</h2>
                    </div>
                    <div class="categories_menu_toggle">
                        @foreach ($getNameCate as $cate)
                        <ul>
                            <li class="menu_item_children"><a href="{{route('route_BackEnd_Client_category', ['id' => $cate->id])}}">{{$cate->name}}<i class="fa fa-angle-right"></i></a></li>
                        </ul>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="column2 col-lg-6 ">
                <div class="search_container">
                    <form action="#">
                        <div class="hover_category">
                            <select class="select_option" name="select" id="categori2">
                                <option selected value="1">All Categories</option>
                                <option value="2">Accessories</option>
                                <option value="3">Accessories & More</option>
                            </select>
                        </div>
                        <div class="search_box">
                            <input placeholder="Search product..." type="text">
                            <button type="submit">Search</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>
        <section class="slider_section slider_s_two mb-60 mt-20">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 offset-lg-3 col-md-12">
                        <div class="swiper-container gallery-top">
                            <div class="slider_area swiper-wrapper">
                                @foreach($banners as $banner)
                                    <div class="single_slider swiper-slide d-flex align-items-center" data-bgimg="{{ $banner->image?''.Storage::url($banner->image):'http://placehold.it/100x100' }}">
                                    </div>
                                @endforeach

                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                        <div class="swiper-container gallery-thumbs">
                            <div class="swiper-wrapper">
                                @foreach($banners as $banner)
                                <div class="swiper-slide">
                                   {{$banner ->title}}
                                </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <div class="container">
            <div class="product_area">
                <div class="row">
                    <div class="col-12">
                        <div class="product_header row">
                            <div class="section_title col-xl-auto col-12">
                                <h2>Sản phẩm mới</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 py-5">
                        @foreach($products as $product)
                            <article class="single_product">
                                <span class="badges">
                                        <span class="sale">-{{$product->discount}}%</span>
                                    </span>
                                <figure>

                                    <div class="product_thumb">
                                        <a class="primary_img"href="{{route('route_BackEnd_Client_productdetail', ['id' => $product->id])}}"><img width="262.2px" height="262.2px" src="{{ $product->image?''.Storage::url($product->image):'http://placehold.it/100x100' }}" alt=""></a>
                                    </div>
                                    <div class="product_content">
                                        <div class="product_content_inner">
                                            <h4 class="product_name"><a href="{{route('route_BackEnd_Client_productdetail', ['id' => $product->id])}}">{{$product->name}}</a></h4>
                                            <div class="price_box">
                                                <span class="current_price"><?php $num = number_format($product->price, 0, ',', '.') ?>{{$num.' VND'}}</span>
                                            </div>
                                        </div>
                                        <div class="add_to_cart" >
                                            <a class="primary_img"href="{{route('route_BackEnd_Client_productdetail', ['id' => $product->id])}}" title="Add to cart">Add to cart</a>
                                        </div>

                                    </div>
                                </figure>
                            </article>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    <div class="container">
        <div class="product_area">
            <div class="row">
                <div class="col-12">
                    <div class="product_header row">
                        <div class="section_title col-xl-auto col-12">
                            <h2>Sản phẩm giảm giá</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 py-5">
                    @foreach($listProHomeSale as $product)
                        <article class="single_product">
                            <span class="badges">
                                        <span class="sale">-{{$product->discount}}%</span>
                                    </span>
                            <figure>

                                <div class="product_thumb">
                                    <a class="primary_img"href="{{route('route_BackEnd_Client_productdetail', ['id' => $product->id])}}"><img width="262.2px" height="262.2px" src="{{ $product->image?''.Storage::url($product->image):'http://placehold.it/100x100' }}" alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_content_inner">
                                        <h4 class="product_name"><a href="{{route('route_BackEnd_Client_productdetail', ['id' => $product->id])}}">{{$product->name}}</a></h4>
                                        <div class="price_box">
                                            <span class="current_price"> @php
                                                    $giamgia = 0;
                                                    $tong = 0;
                                                    $giamgia = $product->price * $product->discount / 100;
                                                    $tong = $product->price - $giamgia
                                                @endphp
                                                {{number_format($tong)}}
                                                VNĐ</span></span>
                                            <span class="old_price"><?php $num = number_format($product->price, 0, ',', '.') ?>{{$num.' VND'}}</span>
                                        </div>
                                    </div>
                                    <div class="add_to_cart" >
                                        <a class="primary_img"href="{{route('route_BackEnd_Client_productdetail', ['id' => $product->id])}}" title="Add to cart"> Add to cart</a>
                                    </div>

                                </div>
                            </figure>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endsection


{{--<!--slider area start-->--}}
{{--<section class="slider_section slider_s_two mb-60 mt-20">--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-lg-9 offset-lg-3 col-md-12">--}}
{{--                <div class="swiper-container gallery-top">--}}
{{--                    <div class="slider_area swiper-wrapper">--}}
{{--                        <div class="single_slider swiper-slide d-flex align-items-center">--}}
{{--                            @foreach($banners as $banner)--}}
{{--                            <img src="{{asset('storage/'. $banner->image)}}">--}}
{{--                            @endforeach--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                    <!-- Add Arrows -->--}}

{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
{{--<!--slider area end-->--}}

{{--    <div class="product">--}}
{{--        <h2 class="text-center mt-5 mb-3">Sản phẩm bán chạy</h2>--}}
{{--        <div class="row">--}}
{{--            @foreach($products as $product)--}}
{{--            <div class="col">--}}
{{--                <a class="text-decoration-none" href="#">--}}
{{--                    <img class="w-100" src="{{asset('storage/'. $product->image)}}" style="width: 30px;height:200px" alt="">--}}
{{--                    <p class="text-body">{{$product->name}}</p>--}}
{{--                    <span class="old_price">{{$product->price}}</span>--}}
{{--                    <span class="current_price">{{$product->discount}}</span>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}

{{--            <div class="tab-content">--}}
{{--                <div class="tab-pane fade show active" id="Computer" role="tabpanel">--}}
{{--                    <div class="product_carousel product_style product_column5 owl-carousel">--}}
{{--                        <article class="single_product">--}}
{{--                            <figure>--}}
{{--                                    <div class="action_links">--}}
{{--                                        <ul>--}}
{{--                                            <li class="wishlist"><a href="wishlist.html" data-tippy-placement="top" data-tippy-arrow="true" data-tippy-inertia="true" data-tippy="Add to Wishlist"><i class="ion-android-favorite-outline"></i></a></li>--}}
{{--                                            <li class="compare"><a href="#" data-tippy-placement="top" data-tippy-arrow="true" data-tippy-inertia="true"  data-tippy="Add to Compare"><i class="ion-ios-settings-strong"></i></a></li>--}}
{{--                                            <li class="quick_button"><a href="#" data-tippy-placement="top" data-tippy-arrow="true" data-tippy-inertia="true"  data-bs-toggle="modal" data-bs-target="#modal_box" data-tippy="quick view"><i class="ion-ios-search-strong"></i></a></li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                    @foreach($products as $product)--}}
{{--                                <div class="product_content">--}}
{{--                                    <div class="product_content_inner">--}}
{{--                                        <h4 class="product_name"><a href="product-details.html">{{$product->name}}</a></h4>--}}
{{--                                        <div class="price_box">--}}
{{--                                            <span class="old_price">{{$product->price}}</span>--}}
{{--                                            <span class="current_price">{{$product->discount}}</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="add_to_cart">--}}
{{--                                        <a href="cart.html" title="Add to cart">Add to cart</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                        @endforeach--}}
{{--                            </figure>--}}
{{--                        </article>--}}
{{--                    </div>--}}

{{--                </div>--}}

{{--            </div>--}}

{{--        <img class="w-100 mt-5" src="images/banner-p1.jpg" alt="">--}}

{{--        <h2 class="text-center mt-5 mb-3">GIÀY BÁN CHẠY</h2>--}}

{{--        <div class="row">--}}
{{--            <div class="col">--}}
{{--                <img class="w-100" src="images/product1.webp" alt="">--}}
{{--                <p>Giày retropy f2</p>--}}
{{--                <span class="me-5 text-danger">2.490.000₫</span>--}}
{{--                <span class="text-decoration-line-through ms-4 text-secondary">2.500.000₫</span>--}}
{{--            </div>--}}
{{--            <div class="col">--}}
{{--                <img class="w-100" src="images/product1.webp" alt="">--}}
{{--                <p>Giày retropy f2</p>--}}
{{--                <span class="me-5 text-danger">2.490.000₫</span>--}}
{{--                <span class="text-decoration-line-through ms-4 text-secondary">2.500.000₫</span>--}}
{{--            </div>--}}
{{--            <div class="col">--}}
{{--                <img class="w-100" src="images/product1.webp" alt="">--}}
{{--                <p>Giày retropy f2</p>--}}
{{--                <span class="me-5 text-danger">2.490.000₫</span>--}}
{{--                <span class="text-decoration-line-through ms-4 text-secondary">2.500.000₫</span>--}}
{{--            </div>--}}
{{--            <div class="col">--}}
{{--                <img class="w-100" src="images/product1.webp" alt="">--}}
{{--                <p>Giày retropy f2</p>--}}
{{--                <span class="me-5 text-danger">2.490.000₫</span>--}}
{{--                <span class="text-decoration-line-through ms-4 text-secondary">2.500.000₫</span>--}}
{{--            </div>--}}
{{--            <div class="col">--}}
{{--                <img class="w-100" src="images/product1.webp" alt="">--}}
{{--                <p>Giày retropy f2</p>--}}
{{--                <span class="me-5 text-danger">2.490.000₫</span>--}}
{{--                <span class="text-decoration-line-through ms-4 text-secondary">2.500.000₫</span>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <img class="w-100 mt-5" src="images/banner-p2.jpg" alt="">--}}

{{--        <h2 class="text-center mt-5 mb-3">TỐT NHẤT CỦA HÃNG</h2>--}}

{{--        <div class="row">--}}
{{--            <div class="col">--}}
{{--                <img class="w-100" src="images/product1.webp" alt="">--}}
{{--                <p>Giày retropy f2</p>--}}
{{--                <span class="me-5 text-danger">2.490.000₫</span>--}}
{{--                <span class="text-decoration-line-through ms-4 text-secondary">2.500.000₫</span>--}}
{{--            </div>--}}
{{--            <div class="col">--}}
{{--                <img class="w-100" src="images/product1.webp" alt="">--}}
{{--                <p>Giày retropy f2</p>--}}
{{--                <span class="me-5 text-danger">2.490.000₫</span>--}}
{{--                <span class="text-decoration-line-through ms-4 text-secondary">2.500.000₫</span>--}}
{{--            </div>--}}
{{--            <div class="col">--}}
{{--                <img class="w-100" src="images/product1.webp" alt="">--}}
{{--                <p>Giày retropy f2</p>--}}
{{--                <span class="me-5 text-danger">2.490.000₫</span>--}}
{{--                <span class="text-decoration-line-through ms-4 text-secondary">2.500.000₫</span>--}}
{{--            </div>--}}
{{--            <div class="col">--}}
{{--                <img class="w-100" src="images/product1.webp" alt="">--}}
{{--                <p>Giày retropy f2</p>--}}
{{--                <span class="me-5 text-danger">2.490.000₫</span>--}}
{{--                <span class="text-decoration-line-through ms-4 text-secondary">2.500.000₫</span>--}}
{{--            </div>--}}
{{--            <div class="col">--}}
{{--                <img class="w-100" src="images/product1.webp" alt="">--}}
{{--                <p>Giày retropy f2</p>--}}
{{--                <span class="me-5 text-danger">2.490.000₫</span>--}}
{{--                <span class="text-decoration-line-through ms-4 text-secondary">2.500.000₫</span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}
