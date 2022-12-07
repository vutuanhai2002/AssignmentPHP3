@extends('client.client_layout.layout')
@section('content')
    <div class="container">
        <a href="javascript:history.back()">Quay lại</a>
        <table class="table mt-5 mb-5">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Sản phẩm</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Tổng tiền</th>
            </tr>
            </thead>
            <tbody>

            @foreach($ListProBill as $item)
                <tr>
                    <td>
                        <div class="d-flex">
                            <div class="img">
                                <img width="100px" height="100px" src="{{ $item->image_pro?''.Storage::url($item->image_pro):'http://placehold.it/100x100' }}" alt="">
                            </div>
                            <div class="box">
                                <div class="name">
                                    {{$item->name_pro}}
                                </div>
                                <div class="price">
                                    Giá: {{$item->price_pro}}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        {{$item->quantily_pro}}
                    </td>
                    <td>
                        {{$item->total_price}}
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection
