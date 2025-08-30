<div class="container">
    <h2 style="text-align: center; margin-bottom: 30px;">DANH MỤC TÀI KHOẢN</h2>

    <div class="row row-flex-safari game-list">
            @foreach ($global_list as $index => $item)
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="classWithPad position-relative">
                <img src="{{ asset('frontend/images/yasuo-hinh.png') }}" style="height: 64px; position: absolute; width: 52px; left: 8px; top: -6px;" alt="Card Image">
                <div class="news_image">
                    <a href="{{$item['link']}}" class=""><img style="height: 200px;" src="{{$item['bgr']}}"></a>
                </div>
                <div class="news_title"><a href="{{$item['link']}}">{{$item['title']}}</a></div>
                <div class="news_description">
                    <p>
                        {{ $item['description'] }}
                    </p>
                </div>
                <div class="a-more">
                    <div class="row">
                        <div class="col-xs-12" style="margin-top: 12px;">
                            <p class="sl-prbot"><a style="cursor: pointer;" onclick="window.open('{{$item['link']}}')" class="sl-btnod">XEM TẤT CẢ</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>




    {{-- </div>
    <div class="wrapper-above">
        
<div class="row row-flex-safari game-list">
    <div class="col-sm-3 col-xs-6 p-5">
        <div class="classWithPad">
            <div class="news_image">
                <a href="https://shoplienquan24h.vn/lien-quan" class=""><img src="https://shoplienquan24h.vn/assets/images/thumblqm.jpg"></a>
            </div>
            <div class="news_title"><a href="https://shoplienquan24h.vn/lien-quan">Tài khoản Liên Quân</a></div>
            <div class="news_description">
                <p>
                    Số Tài Khoản Hiện Có: <b>3</b>
                </p>
                <p>
                    Đã bán: <b>403</b>
                </p>
            </div>
            <div class="a-more">
                <div class="row">

                    <div class="col-xs-12">
                        <div class="view">
                            <a href="https://shoplienquan24h.vn/lien-quan">Xem tất cả</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
<div class="col-sm-3 col-xs-6 p-5">
        <div class="classWithPad">
            <div class="news_image">
                <a href="https://shoplienquan24h.vn/free-fire" class=""><img src="https://shoplienquan24h.vn/assets/images/thumbff.jpg"></a>
            </div>
            <div class="news_title"><a href="https://shoplienquan24h.vn/free-fire">Tài khoản Free Fire</a></div>
            <div class="news_description">
                <p>
                    Số Tài Khoản Hiện Có: <b>0</b>
                </p>
                <p>
                    Đã bán: <b>653</b>
                </p>
            </div>
            <div class="a-more">
                <div class="row">

                    <div class="col-xs-12">
                        <div class="view">
                            <a href="https://shoplienquan24h.vn/free-fire">Xem tất cả</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="col-sm-3 col-xs-6 p-5">
        <div class="classWithPad">
            <div class="news_image">
                <a href="https://shoplienquan24h.vn/pubg" class=""><img src="https://shoplienquan24h.vn/assets/images/pubgmb.jpg"></a>
            </div>
            <div class="news_title"><a href="https://shoplienquan24h.vn/pubg">Tài khoản PUBG Mobile</a></div>
            <div class="news_description">
                <p>
                    Số Tài Khoản Hiện Có: <b>0</b>
                </p>
                <p>
                    Đã bán: <b>840</b>
                </p>
            
            </div>
            <div class="a-more">
                <div class="row">

                    <div class="col-xs-12">
                        <div class="view">
                            <a href="https://shoplienquan24h.vn/pubg">Xem tất cả</a>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>

<div class="col-sm-3 col-xs-6 p-5">
        <div class="classWithPad">
            <div class="news_image">
                <a href="https://shoplienquan24h.vn/lien-minh" class=""><img src="https://shoplienquan24h.vn/assets/images/thumblmht.jpg"></a>
            </div>
            <div class="news_title"><a href="https://shoplienquan24h.vn/lien-minh">Tài khoản LMHT</a></div>
            <div class="news_description">
                <p>
                    Số Tài Khoản Hiện Có: <b>0</b>
                </p>
                <p>
                    Đã bán: <b>532</b>
                </p>
            </div>
            <div class="a-more">
                <div class="row">

                    <div class="col-xs-12">
                        <div class="view">
                            <a href="https://shoplienquan24h.vn/lien-minh">Xem tất cả</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>		
 --}}


</div>
</div>