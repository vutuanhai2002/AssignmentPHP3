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


        <div class="product">
            <div class="row">
                <div class="col mt-4">
                    <table class="table">
                        <thead class="bg-danger">
                        <tr>
                            <th class="text-white">KHOẢNG GIÁ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <input type="checkbox" name="" id="">
                                <span>Tất cả</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="" id="">
                                <span>Nhỏ hơn 100,000₫</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="" id="">
                                <span> Từ 100,000₫ - 200,000₫</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="" id="">
                                <span>Từ 200,000₫ - 300,000₫</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="" id="">
                                <span>Từ 300,000₫ - 400,000₫</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="" id="">
                                <span>Từ 400,000₫ - 500,000₫</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="" id="">
                                <span>Lớn hơn 500,000₫</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
    </div>
    <div class="banner">
        <img class="w-100" src="images/banner-list-product.webp" alt="">
    </div>

            <div class="container">
                <div class="product_area">
                    <div class="row">
                        <div class="col-12">
                            <div class="product_header row">
                                <div class="section_title col-xl-auto col-12">
                                    <h2>New Arrivals</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 py-5">

                            @foreach($products1 as $product)
                                <article class="single_product">
                            <span class="badges">
                                        <span class="sale">-{{$product->discount}}%</span>
                                    </span>
                                    <figure>

                                        <div class="product_thumb">
                                            <a class="primary_img"  href=""><img width="262.2px" height="262.2px" src="{{ $product->image?''.Storage::url($product->image):'http://placehold.it/100x100' }}" alt=""></a>
                                        </div>
                                        <div class="product_content">
                                            <div class="product_content_inner">
                                                <h4 class="product_name"><a href="">{{$product->name}}</a></h4>
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
                                                <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" value="{{ $objPro->id }}" name="id">
                                                    <input type="hidden" value="{{ $objPro->name }}" name="name">
                                                    <input type="hidden" value="{{ $objPro->price }}" name="price">
                                                    <input type="hidden" value="{{ $objPro->image }}"  name="image">
                                                    <input type="hidden" value="1" name="quantity">
                                                    <button class="px-4 py-2 text-white bg-blue-800 rounde">Add To Cart</button>
                                                </form>
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
