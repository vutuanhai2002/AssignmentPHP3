@extends('client.client_layout.layout')
@section('content')
    @php
        $objUserClient = \Illuminate\Support\Facades\Auth::user();
    @endphp
    <script src="https://cdn.tailwindcss.com"></script>
    <div class="checkout-area pt-100px pb-100px">
        <div class="container">
            <form action="{{route('saveBill')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-7">
                        <div class="billing-info-wrap">
                            <h3>Chi tiết thanh toán</h3>
                            @if(isset($objUserClient))
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="billing-info mb-4">
                                            <label>Tên người đặt</label>
                                            <input type="text" name="name" value="{{$objUserClient->name}}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="billing-info mb-4">
                                            <label>Email</label>
                                            <input type="email" value="{{$objUserClient->email}}" name="email" required />
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="billing-info mb-4">
                                            <label>Địa chỉ</label>
                                            <input name="address" value="{{$objUserClient->address}}" class="billing-address" placeholder="Nhập vào địa chỉ" type="text"  required />

                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="billing-info mb-4">
                                            <label>Số điện thoại</label>
                                            <input name="phone" value="{{$objUserClient->phone}}" class="billing-address"  type="number" required />

                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="billing-info mb-4">
                                            <label>Tên người đặt</label>
                                            <input type="text" name="name" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="billing-info mb-4">
                                            <label>Email</label>
                                            <input type="email" name="email" required />
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="billing-info mb-4">
                                            <label>Địa chỉ</label>
                                            <input name="address" class="billing-address" placeholder="Nhập vào địa chỉ" type="text" required />

                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="billing-info mb-4">
                                            <label>Số điện thoại</label>
                                            <input name="phone" class="billing-address"  type="number" required />

                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="col-lg-5 mt-md-30px mt-lm-30px ">
                        <div class="your-order-area">
                            <h3>Đơn hàng của bạn</h3>
                            <div class="your-order-wrap gray-bg-4">
                                <div class="your-order-product-info">
                                    <div class="your-order-top">
                                        <ul>
                                            <li>Sản phẩm</li>
                                            <li>Thành tiền</li>
                                        </ul>
                                    </div>
                                    <div class="your-order-middle">
                                        <ul>
                                            @if(Session::has('cart') != null)
                                                @foreach(Session::get('cart')->products as $item)
                                                    <li><span class="order-middle-left">{{$item['productInfo']['name']}} X {{$item['quantity']}}</span> <span
                                                            class="order-price">{{number_format($item['price'])}} VNĐ</span></li>
                                                @endforeach
                                            @else
                                                Hãy tiếp tục mua sắm đi !
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="your-order-bottom">
                                        <ul>
                                            <li class="your-order-shipping">Vận chuyển</li>
                                            <li><input type="hidden" name="ship" value="0">Thanh toán khi nhận hàng</li>
                                        </ul>
                                    </div>
                                    <div class="your-order-total">
                                        <ul>
                                            @if(Session::has('cart') != null)
                                                <li class="order-total">Tổng tiền</li>
                                                <li>{{number_format(Session::get('cart')->totalPrice)}} VNĐ</li>
                                            @else
                                                <li class="order-total">Tổng tiền</li>
                                                <li>0 VNĐ</li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>

                                @if(Session::has('cart') != null)
                                    <input type="hidden" name="user_id" value="{{$objUserClient->id}}">

                                    <input type="hidden" name="ngaylap" value="0">
                                    <input type="hidden" name="tongdonhang" value="{{Session::get('cart')->totalPrice}}">
                                    <input type="hidden" name="trangthai" value="0">
                                @else
                                @endif


                                <div class="Place-order mt-25">
                                    @if(!isset($objUserClient))
                                        *Vui lòng đăng nhập để tiến hành đặt hàng
                                    @else
                                        <button style="background-color: blue" type="submit" class="btn btn-primary">Đặt hàng</button>

                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
