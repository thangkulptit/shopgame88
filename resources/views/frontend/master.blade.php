<!DOCTYPE html>
<html>

<head>
    <link rel="shortcut icon" href="{{asset('/faviconn.ico')}}">
    <meta name="google-site-verification" content="wE3M16EKuyZOCcaJ0h2RIWPUHuGcD0EGwYX1HiqAuQk" />
    <base href="{{asset('frontend')}}/">
    <title>@yield('title')</title> 
    <meta name="description" content="@yield('description')"/>
    <meta name="keywords" content="@yield('keywords')" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:url" content="{{url('/')}}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:keywords" content="@yield('keywords')" />
    <meta property="og:image" content="https://www.upsieutoc.com/images/2019/07/31/BANNER1.jpg">
    <meta property="og:image:width" content="600">
    <meta property="og:image:height" content="315">
    <meta property="og:site_name" content="{{url('/')}}">
    <meta name="dc.language" content="vi-VN">
    <link rel="alternate" href="{{url('/')}}" hreflang="vi-vn" />
    <link href="https://fonts.googleapis.com/css?family=Ma+Shan+Zheng&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-155392144-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-155392144-1');
    </script>
    <!-- End Google Tag Manager -->
    <style>
        .wrap-loading {
            z-index: 99999;
            position: fixed;
            width: 100%;
            height: 100%;
            background: #222;
            opacity: 0.5;
            top: 0;

        }

        .lds-ring {
            top: 45%;
            left: 45%;
            display: inline-block;
            position: absolute;
            width: 64px;
            height: 64px;
        }

        .lds-ring div {
            box-sizing: border-box;
            display: block;
            position: absolute;
            width: 80px;
            height: 80px;
            margin: 6px;
            border: 6px solid #fff;
            border-radius: 50%;
            animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
            border-color: #fff transparent transparent transparent;
        }

        .lds-ring div:nth-child(1) {
            animation-delay: -0.45s;
        }

        .lds-ring div:nth-child(2) {
            animation-delay: -0.3s;
        }

        .lds-ring div:nth-child(3) {
            animation-delay: -0.15s;
        }

        @keyframes lds-ring {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        body {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            -o-user-select: none;
            user-select: none;
        }
    </style>
    <!-- CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <link rel="stylesheet" type="text/css" href="lib/fontawesome/css/all.css">
    <link rel="stylesheet" type="text/css" href="lib/toastr/toastr.min.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">
    <div class="wrap-loading">
        <div class="lds-ring">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <span
                style="position: absolute; top: 12vh; left: -1vw; font-family: 'Ma Shan Zheng', cursive; color: #fff; font-size: 25px;">ShopGame88.Com</span>
        </div>
    </div>

    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="lib/toastr/toastr.min.js"></script>
    <script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/swiper.min.js"></script>
    <script src="js/bootstrap4.minn.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <script src="js/garenaweb-utils.min.js"></script>
    <script src="js/app/custom.js"></script>
    <script src="js/app/buy.js"></script>
</head>

<body>
<!--popup img-->
<div class="modal fade" id="popImgsda" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
                <h1 class="modal-title">@yield('title')</h1>
                <h2 class="modal-title">@yield('title_h2_1')</h2>
                <p>@yield('content_seo')</p>
                <h2 class="modal-title">@yield('title_h2_2')</h2>
                <h3 class="modal-title">@yield('title_h3_1')</h3>
                <p>@yield('content_seo_1')</p>
                <h3 class="modal-title">@yield('title_h3_2')</h3>
                <h3 class="modal-title">@yield('title_h3_3')</h3>
            </div>
            <div class="modal-body">
                <p class="sa-popimg"><img src="/frontend/images/user.png" alt="@yield('title_h1')">
                </p>
            </div>
        </div>
    </div>
</div>
    <div class="sl-header">
        <div class="container">
            <span class="sl-icmenu" id="xxx"><i class="glyphicon glyphicon-menu-hamburger"></i></span>
            <a class="sl-logo" href="/" title="Trang chủ">
                <div>
                    <strong
                        style="font-family: sans-serif;  font-size: 1.5vw; color: #ffea00;">SHOPGAME88.COM
                    </strong>
                </div>
            </a>
            <ul class="sl-menu clearfix">
                <li class="active"><a href="{{url('/')}}" title="TRANG CHỦ">Trang Chủ</a></li>
                {{-- <li><a href="{{url('/giao-dich-gan-day.html')}}" title="GIAO DỊCH GẦN ĐÂY">Uy Tín Của Shop</a></li> --}}
                {{-- <li><a href="{{url('/huong-dan-mua-acc.html')}}" title="Hướng dẫn mua acc" style="cursor: pointer;">Hướng Dẫn Mua</a></li> --}}
                {{-- <li><a href="{{url('/nap-the.html')}}" title="NẠP TIỀN" style="cursor: pointer;">Nạp Tiền</a></li> --}}
                <li><a href="{{url('/')}}" target="_blank">Danh mục account</a></li>
                <li><a href="https://facebook.com/leanhtuan8886" target="_blank">FB Admin Tuấn LêAnh</a></li>
            </ul>
            @if (Auth::guard('users_client')->check())
            <div class="sl-lrins">
                <div class="dropdown">
                    <button type="button" data-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false"><img style="width: 32px;" src="{{url('/frontend/images/user.png')}}">
                        <strong id="total_money"
                            data-money="{{Auth::guard('users_client')->user()->money}}">{{number_format(Auth::guard('users_client')->user()->money)}}<sup>đ</sup></strong>
                        <i></i></button>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('/lich-su-giao-dich')}}" title="Lịch sử giao dịch">Lịch sử giao dịch</a></li>
                        <li><a class="alogout" href="{{url('/front/logout')}}" title="Đăng xuất">Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
            @else
            <ul class="sl-logreg clearfix">
                <li><a class="sl-reglink" id="register-modal" title="Đăng ký">Đăng ký</a> </li>
                <li><a class="sl-loglink" id="login-modal" title="Đăng nhập">Đăng nhập</a> </li>
            </ul>
            @endif
        </div>
    </div>
    <div class="sllpbox">
          <style>
            .banner {
            background-color: #0d6efd; /* Màu nền Bootstrap primary */
            color: #fff;
            padding: 12px 0;
            overflow: hidden;
            position: relative;
            height: 60px;
            }
            .banner-title {
            position: absolute;
            white-space: nowrap;
            font-size: 1.25rem;
            font-weight: bold;
            animation: slideText 10s linear infinite;
            }
            @keyframes slideText {
            0%   { left: -100%; }
            100% { left: 100%; }
            }
        </style>
        
          <div class="banner">
            <div class="container position-relative">
            <span class="banner-title">
                🎉 Chào mừng bạn đến với Shopgame88.Com! Mua bán, cầm cố, treo acc CF Bán GO - Cày Item AI giá rẻ | Liên hệ ngay Zalo để nhận tư vấn🎉
            </span>
            </div>
        </div>
        <div class="container">

            {{-- <h2></h2> --}}
            {{-- <div class="sl-boxs">
                <div class="sl-row clearfix">
                    <div class="sl-col sl-col1">
                        <div class="sl-hdcbox">
                            <h4 class="sl-htit sl-ht1">TOP NẠP THẺ THÁNG</h4>
                            <ul class="sl-htul">
                                <li>
                                    <i>1</i>
                                    <span>Chí Cao</span>
                                    <label>11.400.000 <sup>đ</sup></label>
                                </li>
                                <li>
                                    <i>2</i>
                                    <span>Đạt Lê</span>
                                    <label>10.350.000 <sup>đ</sup></label>
                                </li>
                                <li>
                                    <i>3</i>
                                    <span>Phạm Thiện</span>
                                    <label>9.050.000 <sup>đ</sup></label>
                                </li>
                                <li>
                                    <i>4</i>
                                    <span>Lizzz</span>
                                    <label>8.950.000 <sup>đ</sup></label>
                                </li>
                                <li>
                                    <i>5</i>
                                    <span>Zooo</span>
                                    <label>7.878.000 <sup>đ</sup></label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="sl-col sl-col2">
                        <div class="swiper-container slhdbner swiper-container-horizontal">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide swiper-slide-active">
                                    <div class="left-banner">
                                        <div class="title-banner">
                                            <h3>Giao dịch gần nhất của khách</h3>
                                        </div>
                                        <div class="wrap-table">
                                            <table class="table table-striped">
                                                <tbody class="table-history" id="body-table-content">
                                                    @foreach ($listName as $index => $item)
                                                     <tr class="{{ $index % 2 == 0 ? 'active' : ''}}"> 
                                                        <td style="width: 30%;"><span class="glyphicon glyphicon-user"></span>{{$item}}</td>
                                                     <td style="width: 15%;">{{ $index < 6 ? $index + $phut : 1 }} {{ ($index) >= 6 ? ' Giờ trước ' : 'Phút trước'}}</td>
                                                        <td style="width: 15%;" class="price-table">
                                                            @if($index == 0 || $index == 1 || $index == 4) 
                                                                {{$price[$index]}}
                                                            @elseif($index == 2 || $index == 5 || $index == 7)
                                                                {{$price[$index]}}
                                                            @elseif($index == 3 || $index == 6)
                                                                89.000
                                                            @elseif($index >= 8 && $index <= 10)
                                                                {{$price[$index]}}
                                                            @endif
                                                            <sup>ATM</sup>
                                                        </td>
                                                        <td style="width: 20%;"> 
                                                        @if($index == 0 || $index == 1 || $index == 4) 
                                                            {{'Acc Đột Kích'}}
                                                        @elseif($index == 2 || $index == 5 || $index == 7) 
                                                            {{'Acc Đột Kích'}}
                                                        @elseif($index == 3 || $index == 6)
                                                            {{'Acc Đột Kích'}}
                                                        @elseif($index >= 8 && $index <= 10 )
                                                            {{'Acc Đột Kích'}}
                                                        @endif
                                                        </td>
                                                        <td style="width: 20%;">Ngày {{$date}}</td><td></td>
                                                     </tr>
                                                     @if ($index == 9) 
                                                        @break;
                                                     @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    {{-- <iframe height="400" src="https://www.youtube.com/embed/hrcoBPfLXaM"
                                        width="100%"></iframe> --}}
                                    {{-- <img src="https://www.upsieutoc.com/images/2019/07/09/shopacc.png"
                                        style="height: 350px;width: 785px;"> 
                                    <img src="https://scontent.fsgn2-1.fna.fbcdn.net/v/t31.0-8/26232766_136956847097528_2732797481514157742_o.jpg?_nc_cat=107&amp;oh=f87fdad15a4df7f22bd0f3e5cb28285e&amp;oe=5C1F5A05" style="height: 350px;"> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

    @yield('main')
    @include('frontend/extends/modal_register_login')
          <!-- Icon Zalo và Facebook -->
  <div class="social-icons">
    <div class="shop-flex" style="display: flex !important;">
        <div class="shop-flex" style="display: flex; flex-direction: column; width: auto; justify-content: center; align-items: center;">
             <strong>Gặp A Tuấn</strong>
            <a href="https://zalo.me/0703989888" target="_blank">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/91/Icon_of_Zalo.svg/1024px-Icon_of_Zalo.svg.png" alt="Zalo 1">
            </a>
            <strong>0703.989.888</strong>
        </div>

        <div class="shop-flex" style="margin-left: 64px; display: flex; flex-direction: column;  width: auto; justify-content: center; align-items: center;">
            <strong>Gặp E Việt</strong>
            <a href="https://zalo.me/0879392888" target="_blank" >
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/91/Icon_of_Zalo.svg/1024px-Icon_of_Zalo.svg.png" alt="Zalo 1">
            </a>
            <strong>0879.392.888</strong>
        </div>

        {{-- <a href="https://www.facebook.com/leanhtuan8886" target="_blank" style="margin-left: 64px;">
        <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook">
        </a> --}}

        {{-- <a href="tel:0703989888" title="Gọi ngay: 0379 439 678" style="margin-left: 64px;  width: auto;">
        <img src="data:image/png;base64,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" class="fas fa-phone"></i>
        </a> --}}
    </div>
  </div>
    </div>
    {{-- <div class="sl-footer">
        @include('frontend/extends/comment')
    </div> --}}
    <footer style="border-top: 1px solid;">
        @include('frontend/extends/modal_start_page')
        {{-- <div class="container">
                  <div class="row"> --}}
        <div class="col-md-4 col-sm-6 footerleft ">
            <h5>Giới thiệu</h5>
            <p>Uy tín tạo nên thương hiệu lớn nhất Việt Nam.
                Việt Nam</p>
            <p><i class="fa fa-map-pin"></i> Bắc Ninh </p>
            <p><i class="fa fa-phone"></i> Phone(Zalo) A Tuấn : 0703.989.888</p>
            <p><i class="fa fa-phone"></i> Phone(Zalo) E Việt : 0879.392.888</p>
            {{-- <p><i class="fa fa-envelope"></i> E-mail : banaccuytin@gmail.com</p> --}}

        </div>
        <div class="col-md-2 col-sm-6 paddingtop-bottom">
            <h6 class="heading7">Link đến các Shop khác</h6>
            <ul class="footer-ul">

                @foreach ($global_list as $index => $item)
                    <li><a href="{{url($item['link'])}}">{{ $item['title'] }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-3 col-sm-6 paddingtop-bottom">
            <h4 class="heading7">Điều khoản</h4>
            <div class="post">
                <a href="/dieu-khoan.html">Điều khoản</a>
                <p>Shop acc uy tín hàng đầu Việt Nam</p>
                <p>Chúng tôi có 7 năm trong lĩnh vực shop acc, ... </p>
                <p>Chúng tôi chịu trách nhiệm 100% với tài khoản mình bán ra </p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 paddingtop-bottom">
            <h4>Giao dịch</h4>
            <p>Shop acc chúng tôi giao dịch hoàn toàn tự động cực kỳ dễ dàng</p>
            <p>B1: Chọn tài khoản</p>
            <p>B2: Bấm vào FB Admin</p>
            <p>B3: Nhắn tin trực tiếp cho tôi để GD</p>
            <p>B4: Bạn sẽ nhận được thông tin khi GD với chúng tôi</p>
        </div>
        </div>
        </div>
        <div class="float-menu visible-lg-block">
            {{-- <a href="{{url('/')}}" class="float-btn">Danh mục acc bán</a>
            <a id="btnComment" class="float-btn">Đánh giá về shop</a> --}}
            {{-- <a href="{{url('/huong-dan-mua-acc.html')}}" style="text-align: center" class="float-btn">HD Mua Acc</a> --}}
        </div>
    </footer>
    </div>
    <div hidden>@yield('keywords')</div>
</body>

@if(isset($popup) && $popup && $popup->is_active)
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        Swal.fire({
            title: {!! json_encode($popup->title) !!},
            html: {!! json_encode($popup->content) !!},
            confirmButtonText: 'OK',
            confirmButtonColor: '#6c5ce7',
        });
    });
    </script>
@endif
<script>
    loading('hide');
</script>
</html>