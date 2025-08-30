<div class="display-account">
    <div class="container">
        <div class="sllpbox">
            <br>
            <h3 class="sl-htit sl-ht3"></h3><br>
            <div id="list-account" data-type-account="1">
                <div class="sl-produl clearfix">
                    @forelse ($accountList as $item)
                        <div class="sl-prodli" id="get-type-account" data-type-filter="{{ $item->type_account }}">
                            <div class="sl-prodbox">
                                <img src="images/price-percent-br-2.png"
                                    style="position:absolute; top:-2px; right:-9px;z-index:99">
                                <span
                                    style="color:#000; position:absolute; top:8px; right:0px; z-index:99;"><b>-15%</b></span>
                                <a class="sl-prlinks" target="_blank" href="/mua-acc-{{$item->acc_id}}.html">
                                    <p class="sl-primg">
                                        <img src="{{$item->img_bgr}}">
                                    </p>
                                    <div class="sl-prcode">
                                        <span>Mã Số #{{ $item->acc_id }}</span>
                                        <div class="hidden-xs">
                                            <img class="sl-champMaster" style="right: 5px;"
                                                src="/images/cf/icon.png">
                                            <img class="sl-champMaster" style="right: 40px;"
                                                src="/images/cf/icon.png">
                                            <img class="sl-champMaster" style="right: 75px;"
                                                src="/images/cf/icon.png">
                                        </div>
                                    </div>
                                    <div class="sl-priftop">
                                        <p class="sl-prcode"><span>Acc CF#{{$item->acc_id}}</span></p>
                                        <ul>
                                            <li>Thông tin: {{$item->content}}</li>
                                            <li>Acc chuyên: {{ $item->vip_main }}</li>
                                            <li>Tên vip: {{ $item->vip_name }}</li>
                                            <li>Cấp độ vip: {{ $item->vip_level }}</li>
                                        </ul>
                                    </div>
                                </a>
                                <div class="sl-prifs">
                                <span class="sl-prpri sl-prpri1 hidden-xs"><img src="/images/cf/cf.png" width="45"
                                            height="45"></span>
                                    <span class="sl-prpri sl-prpri2 hidden-xs"
                                        style="top: 50px; font-size: 12px; text-decoration: line-through; color: #bdc3c7">{{number_format(($item->price)*1.15)}} <sup>ATM</sup></span>
                                    <span class="sl-prpri sl-prpri2">{{number_format($item->price)}} <sup>ATM</sup></span>
                                    <div class="sl-prifbot">
                                        <ul>
                                            <li>{{$item->content}}</li>
                                            <li>Chuyên: {{ $item->vip_main }}</li>
                                            <li>Tên: {{ $item->vip_name }}</li>
                                            <li>Cấp: {{ $item->vip_level }}</li>
                                        </ul>
                                    </div>
                                    <p class="sl-prbot"><a style="cursor: pointer;" onclick="showPopupAcc({{$item->acc_id}});"
                                            class="sl-btnod">MUA NGAY</a></p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h2 style="text-align: center; font-size: 35px; font-weight: bold; color: #fff"> Không có tài khoản nào </h2>
                    @endforelse
                </div>
                <div class="paginate-block">
                    {{$accountList->links()}}
                </div>
                <div id="loading" style="margin: 30px 0; text-align: center; display: none;">
                    <img src="images/loading.gif">
                </div>
                <style>
                    .paginate-block nav {
                        display: flex;
                        justify-content: center;
                    }
                </style>
            </div>
        </div>
    </div>
</div>
