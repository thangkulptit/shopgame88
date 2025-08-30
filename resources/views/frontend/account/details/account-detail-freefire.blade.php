@extends('frontend.master')
@section('title', 'Shop Acc Freefire Mua bán Nick Freefire giá rẻ, uy tín bảo hành vĩnh viễn')
@section('description', 'Ngay hôm nay, tại Shop Freefire chúng tôi bán nick ff giảm giá 50% chỉ có tại hôm nay, shop acc ff uy tín, giá rẻ nhất việt nam, 9k, 20k cực vip chỉ có tại BanAccUytin.com chỉ có 20k, 30k, 40k, 50k')
@section('keywords', 'shop acc free fire, mua nick ff, shop free fire, shop acc ff, mua acc free fire, mua nick free fire, shopaccfree fire, mua acc ff, bán acc free fire')
@section('main')

<div class="container">
    <div class="sl-dtprmain">
        <div class="sa-lsnmain clearfix">
            <ul class="sa-brea">
                <li>Trang Chủ</li>
                <li class="active"><a href="javascript:;">Thông tin chi tiết Acc Freefire #{{$data_account->acc_id}}</a>
                </li>
            </ul>
            <div class="row">
                <div class="col-sm-6">
                    <div class="sa-ttactit clearfix">
                        <h1 class="sa-ttacc-tit">
                            Acc Freefire #{{$data_account->acc_id}} </h1>
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
                                <li><img src="{{$imgSRC}}" alt="shop acc freefire uy tin gia re"></li>
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