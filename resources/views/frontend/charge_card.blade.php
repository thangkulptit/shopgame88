@extends('frontend.master')
@section('title', 'Nạp thẻ vào ShopDaxua ')
@section('description', 'Nơi mua bán acc liên quân giá rẻ uy tín hàng đầu việt nam, acc liên quân cực vip chỉ có 20k,
30k, 40k, 50k')
@section('keywords', 'shop liên quân, mua acc liên quân, mua nick liên quân, bán acc lq, shop lq, acc lien quan gia re')
@section('main')
<section class="napthe">
    <div class="napthe__header">
        <div class="header__content">
            @if(Auth::guard('users_client')->check())
                <div class="header__info">
                    <i style="color:#137f50;" class="fas fa-user"></i>&nbsp;&nbsp;
                    {{Auth::guard('users_client')->user()->name}}
                </div>
                <div class="header__money">
                    <i style="font-size: 25px;" class="fas fa-money-bill-alt"></i>&nbsp;&nbsp;
                    {{Auth::guard('users_client')->user()->money}} đ
                </div>
            @endif
        </div>
    </div>
    <div class="napthe__content">
        <div class="napthe__form">
            <div class="form__title">
                <i class="fas fa-hand-holding-usd" style="color:#137f50;"></i>
                Nạp Tiền Bằng Thẻ Cào Điện Thoại
            </div>
            <div class="form__content">
                <div class="card__title">
                    <div class="card__number">1</div>
                    <div class="card__label">Chọn loại thẻ</div>
                </div>
                <div class="card">
                    <select id="type_card" class="form-control ui fluid selection dropdown upward" name="type_card">
                        <option value="">Chọn loại thẻ</option>
                        <option value="VIETTEL">Viettel</option>
                        <option value="VINAPHONE">Vinaphone</option>
                        <option value="MOBIFONE">Mobifone</option>
                        <option value="GATE">Gate</option>
                        <option value="ZING">Zing</option>
                    </select>
                    <div class="card__title">
                        <div class="card__number">2</div>
                        <div class="card__label">Chọn mệnh giá</div>
                    </div>
                    <select id="amount" class="form-control ui fluid selection dropdown upward" name="amount">
                        <option value="">Mệnh giá thẻ || Chọn sai mất thẻ</option>
                        <option value="10000">10.000VNĐ</option>
                        <option value="20000">20.000VNĐ</option>
                        <option value="30000">30.000VNĐ</option>
                        <option value="50000">50.000VNĐ</option>
                        <option value="100000">100.000VNĐ</option>
                        <option value="200000">200.000VNĐ</option>
                        <option value="300000">300.000VNĐ</option>
                        <option value="500000">500.000VNĐ</option>
                        <option value="1000000">1.000.000VNĐ</option>
                    </select>
                    <div class="card__title">
                        <div class="card__number">3</div>
                        <div class="card__label">Nhập vào số Seri</div>
                    </div>
                    <div style="width: 100%" class="ui fluid input">
                        <input type="text" name="seri" id="seri" class="form-control" placeholder="Nhập vào Số Seri ...."aria-describedby="helpId">
                    </div>
                    <div class="card__title">
                        <div class="card__number">4</div>
                        <div class="card__label">Nhập vào mã thẻ</div>
                    </div>
                    <div style="width: 100%" class="ui fluid input">
                        <input type="text" name="code" id="code" placeholder="Nhập vào Mã thẻ ...."
                        aria-describedby="helpId">
                    </div>
                </div>
                <button id="submit-card" name="submit-card" style="margin-top: 10px;" class="button-buy">Nạp Ngay</button>
                <button type="reset" id="submit-card" name="submit-card" style="margin-top: 10px;" class="button-buy">Reset</button>
            </div>
        </div>
        <div class="napthe__noti">
            <div class="noti__title">
                <i style="color:red;" class="fas fa-exclamation-triangle"></i>
                Chú Ý Khi Nạp Thẻ
            </div>
            <div class="noti__content">
                <div class="card__title">
                    <div class="card__number">1</div>
                    <div class="card__label">Nạp sai Mệnh Giá &gt;&gt;&gt; Mất Thẻ</div>
                </div>
                <div class="card__title">
                    <div class="card__number">2</div>
                    <div class="card__label">Nạp Sai nhiều lần &gt;&gt;&gt; Khóa nick</div>
                </div>
                <div class="card__title">
                    <div class="card__number">3</div>
                    <div class="card__label">Tỉ giá nạp tiền 1:1 - 10k được 10k</div>
                </div>
            </div>
        </div>
    </div>
    <div class="napthe__table">
        <div class="card__history"><i class="fas fa-history" style="color: #137f50;"></i>Lịch Sử Nạp Thẻ</div>
        <table class="ui celled table stackable">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Loại thẻ</th>
                    <th scope="col">Seri</th>
                    <th scope="col">Mệnh giá</th>
                    <th scope="col">Thời gian nạp</th>
                    <th scope="col">Trạng thái nạp</th>
                </tr>
            </thead>
            <tbody>
                @if (Auth::guard('users_client')->check())
                    @forelse ($historyCharge as $key => $item)
                        <tr>
                            <th scope="row">{{$key + 1}}</th>
                            <td>{{$item->type_card}}</td>
                            <td>{{$item->seri_card}}</td>
                            <td>{{$item->amount_card}}</td>
                            <td>Lúc {{$item->created_at->format('h:m d/m/Y')}}</td>
                            <td>
                                @if($item->status == 0 || $item->status == 99)
                                <span style="background: #f1c40f;" class="badge badge-warning">Đang xử lý</span>
                                @elseif($item->status == 1)
                                <span style="background: #27ae60;" class="badge badge-success">Thành công</span>
                                @else
                                <span style="background: #c0392b;" class="badge badge-error">Thất bại</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th scope="row">Bạn chưa có cuộc giao dịch nào</th>
                        </tr>
                    @endforelse
                @else
                    <tr>
                        <th scope="row" style="text-align: center;">Bạn chưa đăng nhập vào hệ thống</th>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</section>


{{-- <div class="container">
    <div class="wrapper-container">
    <h1 style="text-align: center; color : red; font-size: 40px;">NẠP THẺ</h1>
    <h3 style="text-align: center; color : red; margin-top: 15px;">Tỉ lệ 1:1. 10.000Card = 10.000 VNĐ</h3>
    <h3 style="text-align: center; color : red; margin-top: 15px;">Duyệt thẻ mua acc trong 1 nốt nhạc, Sai mệnh giá mất thẻ</h3>

    <div class="wrap my-wrapper">
        <div class="form-card">
            <form>
                <div class="form-group">
                    <label for="type_card">Chọn loại thẻ</label>
                    <select id="type_card" class="form-control" name="type_card">
                        <option value="">Chọn loại thẻ</option>
                        <option value="VIETTEL">Viettel</option>
                        <option value="MOBIFONE">Mobifone</option>
                        <option value="VINAPHONE">Vinaphone</option>
                        <option value="GATE">Gate</option>
                        <option value="ZING">Zing</option>
                    </select>
                    <label for="amount">Mệnh giá</label>
                    <select id="amount" class="form-control" name="amount">
                        <option value="">Mệnh giá thẻ || Chọn sai mất thẻ</option>
                        <option value="10000">10.000VNĐ</option>
                        <option value="20000">20.000VNĐ</option>
                        <option value="30000">30.000VNĐ</option>
                        <option value="50000">50.000VNĐ</option>
                        <option value="100000">100.000VNĐ</option>
                        <option value="200000">200.000VNĐ</option>
                        <option value="300000">300.000VNĐ</option>
                        <option value="500000">500.000VNĐ</option>
                        <option value="1000000">1.000.000VNĐ</option>
                    </select>
                    <label for="seri">Nhập Seri</label>
                    <input type="text" name="seri" id="seri" class="form-control" placeholder="Nhập vào Số Seri ...."
                        aria-describedby="helpId">
                    <label for="code">Nhập Mã thẻ</label>
                    <input type="text" name="code" id="code" class="form-control" placeholder="Nhập vào Mã thẻ ...."
                        aria-describedby="helpId">
                    <div class="wrap-button">
                        <button type="button" id="submit-card" name="submit-card" class="btn btn-primary">
                            NẠP THẺ
                        </button>
                        <button type="reset" class="btn btn-danger">
                            RESET
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <h2 style="text-align: center; font-size: 30px; color : red; margin: 30px 0;">LỊCH SỬ NẠP</h2>
    <div class="lich-su-nap">
        <table class="table table-dark table-responsive">
                <thead class="thead-dark header-table-card">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Loại thẻ</th>
                    <th scope="col">Seri</th>
                    <th scope="col">Mệnh giá</th>
                    <th scope="col">Thời gian</th>
                    <th scope="col">Trạng thái nạp</th>
                </tr>
                </thead>
                <tbody>
                    @if (Auth::guard('users_client')->check())
                        @if (sizeof($historyCharge) > 0) 
                            @foreach ($historyCharge as $key => $item)
                            <tr>
                                <th scope="row">{{$key + 1}}</th>
                <td>{{$item->type_card}}</td>
                <td>{{$item->seri_card}}</td>
                <td>{{$item->amount_card}}</td>
                <td>Lúc {{$item->created_at->format('h:m d/m/Y')}}</td>
                <td>
                    @if($item->status == 0 || $item->status == 99)
                    <span style="background: #f1c40f;" class="badge badge-warning">Đang xử lý</span>
                    @elseif($item->status == 1)
                    <span style="background: #27ae60;" class="badge badge-success">Thành công</span>
                    @else
                    <span style="background: #c0392b;" class="badge badge-error">Thất bại</span>
                    @endif
                </td>

                </tr>
                @endforeach
                @else
                <tr>
                    <th scope="row">Bạn chưa có cuộc giao dịch nào</th>
                </tr>
                @endif
                @else
                <tr>
                    <th scope="row" style="text-align: center;">Bạn chưa đăng nhập vào hệ thống</th>
                </tr>
                @endif
                </tbody>
</table>
</div>
</div>

</div> --}}


@stop