@extends('client.client_layout.layout')
@section('content')
<div class="container">
    <table class="table mt-5 mb-5">
        <thead class="thead-dark">
        <tr>
            <th scope="col">MÃ ĐƠN HÀNG</th>
            <th scope="col">NGÀY ĐẶT</th>
            <th scope="col">CHI TIẾT ĐƠN HÀNG</th>
            <th scope="col">TỔNG GIÁ TRỊ ĐƠN HÀNG</th>
            <th scope="col">TÌNH TRẠNG ĐƠN HÀNG</th>
            <th scope="col">HÀNH ĐỘNG</th>
        </tr>
        </thead>
        <tbody>

        @foreach($Listbill as $item)
            <tr>
                <th scope="row">DH-{{$item->id}}</th>
                <td>{{$item->ngaylap}}</td>
                <td><a href="{{route('billProDetail', ['id' => $item->id])}}">Chi tiết</a></td>
                <td>{{number_format($item->tongdonhang)}}</td>
                <td>
                    @if($item->trangthai == 0)
                        Chờ xác nhận
                    @elseif($item->trangthai == 1)
                        Đang giao
                    @else
                        Giao hàng thành công
                    @endif
                </td>

                <td>
                    @if($item->trangthai == 0)
                        <a href="{{route('deleteBill', ['id' => $item->id])}}">Xóa</a>
                    @elseif($item->trangthai == 1)
                        <a href="{{route('nhanHang', ['id' => $item->id])}}">Đã nhận hàng</a>
                    @else

                    @endif
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
@endsection
