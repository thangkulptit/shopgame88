@extends('frontend.master')
@section('title', 'Lich sử')
@section('description', 'Shop liên quân, nơi mua bán acc liên quân giá rẻ uy tín hàng đầu việt nam, acc liên quân cực vip chỉ có 20k, 30k, 40k, 50k')
@section('keywords', 'shop liên quân, mua acc liên quân, mua nick liên quân, bán acc lq, shop lq, acc lien quan gia re')
@section('domain', 'https://shoplienquan.com')
@section('main')
<div class="container">
    <div class="wrapper-container">
    <div class="title">
        <h2>Lịch sử giao dịch đã mua Acc</h2>
    </div>
    <table class="table table-condensed">
        <thead>
          <tr>
            <th>STT</th>
            <th>Loại tài khoản</th>
            <th>Tài khoản</th>
            <th>Mật khẩu</th>
            <th>Mật khẩu cấp 2</th>
            <th>Giá</th>
          </tr>
        </thead>
        <tbody>
            @if(sizeof($list) > 0)
                @foreach ($list as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->type_account}} #{{$item->id_acc}}</td>
                        <td>{{$item->username}}</td>
                        <td>{{$item->password}}</td>
                        <td>{{$item->password2}}</td>
                        <td>{{number_format($item->price)}}<sup>đ</sup></td>
                    </tr>
                @endforeach
            @else
                <tr style="font-size: 20px; font-weight: bold; text-align: center;">
                    Chưa có cuộc giao dịch nào xảy ra
                </tr>
            @endif

        </tbody>
      </table>
    </div>
</div>
@stop
