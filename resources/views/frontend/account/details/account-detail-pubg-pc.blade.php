@extends('frontend.master')
@section('title', 'Chi tiết acc Pubg PC')
@section('description', 'Shop Acc PUBG PC, nơi mua bán acc PUBG giá rẻ uy tín hàng đầu việt nam, acc PUBG cực vip chỉ có 20k, 30k, 40k, 50k, 100k, 200k')
@section('keywords', 'mua acc pubg uy tín, shop acc pubg, mua acc pubg , ban acc pubg gia re,mua acc pubg pc, mua nick pubg,shop bán acc pubg, pubg uy tin, sieu re')
@section('main')
<div class="container">
    <div class="sl-dtprmain">
        <div class="sa-lsnmain clearfix">
            <ul class="sa-brea">
                <li>Trang Chủ</li>
                <li class="active"><a href="javascript:;">Thông tin chi tiết Acc Pubg PC #{{$data_account->acc_id}}</a>
                </li>
            </ul>
            <div class="row">
                <div class="col-sm-6">
                    <div class="sa-ttactit clearfix">
                        <h1 class="sa-ttacc-tit">
                            Acc Pubg PC #{{$data_account->acc_id}} </h1>
                    </div>
                </div>
                <div class="col-sm-6">
                    <button class="btn btn-default hidden-sm hidden-md hidden-lg"
                        style="margin-bottom: 30px; border-radius: 0; font-size: 16px; font-weight: bold; padding: 20px; background: #FCAD26; border: none; color: #fff; font-family: Lato,'Helvetica Neue',Arial,Helvetica,sans-serif;"
                        onclick="showPopupAcc({{$data_account->acc_id}});">Mua Ngay Với Giá {{$data_account->price}}đ</button>
                    <div class="pull-right hidden-xs">
                        <button class="btn btn-default"
                            style="margin-bottom: 50px; border-radius: 0; font-size: 17px; font-weight: bold; padding: 20px; background: #FCAD26; border: none; color: #000; font-family: Lato,'Helvetica Neue',Arial,Helvetica,sans-serif;"
                            onclick="showPopupAcc({{$data_account->acc_id}});">Mua Tài Khoản Này Với Giá {{number_format($data_account->price)}}đ</button>
                    </div>
                </div>
            </div>
            <ul class="sa-ttacc-tabs clearfix">
                <li class="active"><a href="#tab-info" data-toggle="tab">THÔNG TIN</a></li>

                {{-- <li>
                    <a href="#tab-champ" data-toggle="tab">
                        DANH SÁCH TƯỚNG
                        <span>{{$data_account->count_champs}}</span>
                    </a>
                </li>
                <li>
                    <a href="#tab-skin" data-toggle="tab">
                        TRANG PHỤC
                        <span>{{$data_account->count_skins}}</span>
                    </a>
                </li>
                <li>
                    <a href="#tab-gem" data-toggle="tab">
                        NGỌC HỖ TRỢ
                        <span>{{$data_account->count_ngoc}}</span>
                    </a>
                </li> --}}
            </ul>
            <div class="sa-ttacc-tcont tab-content">
                <div class="tab-pane fade in active text-center" id="tab-info">

                    <div class="row">
                        @foreach ($img_content as $imgSRC)
                            <ul style="display: inline-block;">
                                <li><img src="{{$imgSRC}}" alt="shop acc pubg pc uy tin gia re"></li>
                            </ul>
                        @endforeach
                        
                    </div>
                    </div> 
                </div>
                <script>
                    $(document).ready(function() {
                    $('#previous').on('click', function(){
                        // Change to the previous image
                        $('#im_' + currentImage).stop().fadeOut(1);
                        decreaseImage();
                        $('#im_' + currentImage).stop().fadeIn(1);
                    }); 
                    $('#next').on('click', function(){
                        // Change to the next image
                        $('#im_' + currentImage).stop().fadeOut(1);
                        increaseImage();
                        $('#im_' + currentImage).stop().fadeIn(1);
                    }); 

                    var currentImage = 1;
                    var totalImages = 3;

                    function increaseImage() {
                        /* Increase currentImage by 1.
                        * Resets to 1 if larger than totalImages
                        */
                        ++currentImage;
                        if(currentImage > totalImages) {
                        currentImage = 1;
                        }
                    }
                    function decreaseImage() {
                        /* Decrease currentImage by 1.
                        * Resets to totalImages if smaller than 1
                        */
                        --currentImage;
                        if(currentImage < 1) {
                        currentImage = totalImages;
                        }
                    }
                    });
                </script>
                </div>
            </div>
        </div>
    </div>
</div>

@stop