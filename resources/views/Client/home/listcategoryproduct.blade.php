@extends('client.client_layout.layout')
@section('content')
    <div class="dropdown mt-3 mb-3">
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
            </div>
        </div>
    </div>
                            <div class="tab-content">
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 py-5">
                                    @foreach($listProCates as $product)
                                        <article class="single_product">
                                            <figure>

                                                <div class="product_thumb">
                                                    <a class="primary_img" href="{{route('route_BackEnd_Client_productdetail', ['id' => $product->id])}}"><img width="262.2px" height="262.2px" src="{{ $product->image?''.Storage::url($product->image):'http://placehold.it/100x100' }}" alt=""></a>
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
                                                            <span class="old_price">{{number_format($product->price)}}VNĐ</span>
                                                        </div>
                                                    </div>
                                                    <div class="add_to_cart" >
                                                        <a href="" title="Add to cart">Add to cart</a>
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

                    </div>
                </div>
            </div>
        </div>
@endsection
