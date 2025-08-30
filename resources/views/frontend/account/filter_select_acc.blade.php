<div class="sl-search">
        <div class="container">
            <div class="sl-sebox">
                <div class="sl-row clearfix">
                    <div class="sl-col col-md-6 col-xs-12">
                        <h4 class="sl-htit sl-ht3">CHỌN GAME</h4>
                        <div class="swiper-container slchgame swiper-container-horizontal">
                            <div class="swiper-wrapper">
                                <div data-type="dot-kich" class="swiper-slide" style="width: 75px; margin-right: 20px;">
                                    <a href="{{url('/shop-acc-dot-kich.html')}}" title="Đột Kích">
                                        <span><img style="width: 60px"  src="/frontend/images/filter/dotkich.png" alt="Đột Kích"></span>
                                        <h3>Đột Kích</h3>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-scrollbar" style="display: none;">
                                <div class="swiper-scrollbar-drag" style="width: 0px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="sl-col col-md-6 col-xs-12 filter" >
                        <h4 class="sl-htit sl-ht2">CHỌN THUỘC TÍNH LỌC</h4>
                        <form lpformnum="1">
                            <ul class="sl-seauls clearfix">
                                <li>
                                    <select class="form-control property-filter" data-filter="vip_level">
                                        <option value="">Chọn cấp vip</option>
                                        <option value="1">Cấp độ 1</option>
                                        <option value="2">Cấp độ 2</option>
                                        <option value="3">Cấp độ 3</option>
                                        <option value="4">Cấp độ 4</option>
                                        <option value="5">Cấp độ 5</option>
                                        <option value="6">Cấp độ 6</option>
                                        <option value="7">Cấp độ 7</option>
                                        <option value="8">Cấp độ 8</option>
                                        <option value="9">Cấp độ 9</option>
                                        <option value="10">Cấp độ 10</option>
                
                                    </select>
                                </li>
                                <li>
                                    <select class="form-control property-filter" data-filter="price">
                                        <option value="">Chọn giá</option>
                                        <option value="0k-500k">Dưới 500k</option>
                                        <option value="500k-1tr">500k - 1tr</option>
                                        <option value="1tr-3tr">1 triệu - 3 triệu</option>
                                        <option value="3tr-5tr">3 triệu - 5 triệu</option>
                                        <option value="5tr-10tr">5 triệu - 10 triệu</option>
                                        <option value="10tr>">Lớn hơn 10 triệu</option>
                                    </select>
                                </li>
                                <li>
                                    <select class="form-control property-filter" data-filter="sort">
                                        <option value="">Sắp xếp</option>
                                        <option value="acc-moi-dang"> Acc mới đăng</option>
                                        <option value="gia-cao-nhat">Giá cao nhất</option>
                                        <option value="gia-thap-nhat">Giá rẻ nhất</option>
                                    </select>
                                </li>
                                <li>
                                    <input type="text" class="form-control property-filter" placeholder="Tìm theo mã số" data-filter="tim-theo-trang-phuc">
                                </li>

                            </ul>
                            <div class="d-flex mt-4">
                                <button class="sl-sebt1 btn-filter" style="width: 130px;" type="button">TÌM KIẾM</button>
                                <button class="sl-sebt2 ml-3" style="width: 130px;" type="reset">HỦY BỎ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript" src="js/app/filter.js"></script>   
