@extends('client.client_layout.layout')
@section('content')
    <script src="https://cdn.tailwindcss.com"></script>
        <div class="product_page_bg">
            <div class="container">
                <div class="product_details_wrapper mb-55">
                    <!--product details start-->
                    <div class="product_details">
                        <div class="row">
                            <div class="col-lg-5 col-md-6">
                                <div class="product-details-tab">
                                    <div id="img-1" class="zoomWrapper single-zoom">
                                        <a href="#">
                                            <img id="zoom1" src="{{ $objPro->image?''.Storage::url($objPro->image):'http://placehold.it/100x100' }}" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <div class="product_d_right">
                                        <h3><a href="#">{{$objPro->name}}</a></h3>
                                        <div class="product_rating">
                                            <ul>
                                                <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                <li><a href="#"><i class="ion-android-star-outline"></i></a></li>
                                                <li class="review"><a href="#">(1 customer review )</a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            @php
                                                $giamgia = 0;
                                                $tong = 0;
                                                $giamgia = $objPro->price * $objPro->discount / 100;
                                                $tong = $objPro->price - $giamgia
                                            @endphp
                                            {{number_format($tong)}}
                                            VNĐ</span></span>
                                            <span class="old_price">{{number_format($objPro->price)}}VNĐ</span>
                                        </div>
                                        <div class="product_desc">
                                            <p>{{$objPro->desc}} </p>
                                        </div>
                                        <div class="product_variant quantity">
                                            <label>quantity</label>
                                            <input min="1" max="100" value="1" type="number">
                                            <form action="{{ route('router_FontEnd_Cart_add') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" value="{{ $objPro->id }}" name="id">
                                                <input type="hidden" value="{{ $objPro->name }}" name="name">
                                                <input type="hidden" value="{{ $objPro->price }}" name="price">
                                                <input type="hidden" value="{{ $objPro->image }}"  name="image">
                                                <input type="hidden" value="1" name="quantity">
                                                <button class="button">Add To Cart</button>
                                            </form>

                                        </div>
                                        <div class=" product_d_action">
                                            <ul>
                                                <li><a href="#" title="Add to wishlist">+ Add to Wishlist</a></li>
                                                <li><a href="#" title="Add to wishlist">+ Compare</a></li>
                                            </ul>
                                        </div>
                                        <div class="product_meta">
                                            <span>Category: <a href="#">Clothing</a></span>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--product details end-->

                    <!--product info start-->
                    <div class="product_d_info">
                        <div class="row">
                            <div class="col-12">
                                <div class="product_d_inner">
                                    <div class="product_info_button">
                                        <ul class="nav" role="tablist" id="nav-tab">
                                            <li>
                                                <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Description</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="info" role="tabpanel">
                                            <div class="product_info_content">
                                                <p>{{ $objPro->desc }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="product_area related_products">
                    <div class="row">
                        <div class="col-12">
                            <div class="section_title">
                                <h2>Sản phẩm liên quan </h2>
                            </div>
                        </div>
                    </div>
                    <div class="product_carousel product_style product_column5 owl-carousel">
                        @foreach($listProCate as $pro)
                        <article class="single_product">
                            <figure>

                                <div class="product_thumb">
                                    <a class="primary_img" href=""><img src="{{ $pro->image?''.Storage::url($pro->image):'http://placehold.it/100x100' }}" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">Sale</span>
                                    </div>
                                    <div class="action_links">
                                        <ul>
                                            <li class="wishlist"><a href="wishlist.html" data-tippy-placement="top" data-tippy-arrow="true" data-tippy-inertia="true" data-tippy="Add to Wishlist"><i class="ion-android-favorite-outline"></i></a></li>
                                            <li class="compare"><a href="#" data-tippy-placement="top" data-tippy-arrow="true" data-tippy-inertia="true"  data-tippy="Add to Compare"><i class="ion-ios-settings-strong"></i></a></li>
                                            <li class="quick_button"><a href="#" data-tippy-placement="top" data-tippy-arrow="true" data-tippy-inertia="true"  data-bs-toggle="modal" data-bs-target="#modal_box" data-tippy="quick view"><i class="ion-ios-search-strong"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_content_inner">
                                        <h4 class="product_name"><a href="">{{$pro->name}}</a></h4>
                                        <div class="price_box">
                                            <span class="old_price">$80.00</span>
                                            <span class="current_price">$70.00</span>
                                        </div>
                                    </div>
                                    <div class="add_to_cart">
                                        <a href="cart.html" title="Add to cart">Add to cart</a>
                                    </div>

                                </div>
                            </figure>

                        </article>
                        @endforeach
                    </div>
                </section>
                <!--product area end-->
            </div>
        </div>

@endsection
