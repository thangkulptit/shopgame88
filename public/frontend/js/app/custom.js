function RSA(plaintext) {
    var before = new Date();
    var rsa = new RSAKey();
    var n = 'D1EC51E7CEA07CB3233ADA6009006EF3EBF89EFD5CF77AAD211051D008077DC7142872B8C36EE971D4B368C79C13A6BBCB89B551A8308C68F71764C1519DEAD90B560E126B365375700CC5A2E6CF81E2A0FEEA31B53C1F8D3F3AE522DF9AB19B5C0C391D997D6DE56807328B9BBD5F6D08EA47614060177E12F65BDB95D5D6E3';
    var e = '10001';
    rsa.setPublic(n, e);
    var currentTime = new Date()
    var timestamp = currentTime.getTime();
    var plain_dict = new Object();
    plain_dict['timestamp'] = parseInt(timestamp / 1000, 10);
    plain_dict['password'] = plaintext;
    var res = rsa.encrypt(JSON.stringify(plain_dict));
    return res;
}
window.fbAsyncInit = function() {
    FB.init({
        appId: '946692825507723',
        cookie: true,
        xfbml: true,
        version: 'v2.12'
    });

    FB.AppEvents.logPageView();

};

(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement(s);
    js.id = id;
    js.src = "https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


var fsBner = {
    init: function () {
        fsBner.events();
    },
    events: function () {
        $('.slhdbner').swiper({
            slidesPerView: 1,
            centeredSlides: true,
            paginationClickable: true,
            preventClicks: false,
            spaceBetween: 1,
            autoplay: 15000,
            autoplayDisableOnInteraction: false,
            nextButton: '.slhdbner .fsbn-n',
            prevButton: '.slhdbner .fsbn-p',
            pagination: '.slhdbner .swiper-pagination'
        });
    }
};
fsBner.init();

function loginWithFacebook1(url = '') {
    FB.login(function(response) {
        if (response.status == "connected") {
            $.post('dang-nhap', {accessToken: response.authResponse.accessToken}, function() {
                if (!url)
                    window.location.reload();
                else 
                    window.location = url;
            });
        }
    });
}

function showPopupAcc(acc) {

    window.open('https://www.facebook.com/leanhtuan8886');
    // swal({
    //     title: "Tài Khoản Số #" + acc,
    //     text: "Bạn có chắc chắn muốn giao dịch tài khoản này ?",
    //     type: "info",
    //     showCancelButton: true,
    //     confirmButtonColor: "#DD6B55",
    //     confirmButtonText: "Có",
    //     cancelButtonText: "Không",
    //     closeOnConfirm: false,
    //     showLoaderOnConfirm: true
    // }, function() {
    //     ajaxSetup();
    //     $.ajax({
    //         type: "POST",
    //         url: "/account/buy",
    //         data: {
    //             'id': acc 
    //         },
    //         dataType: "json",
    //         success: function (response) {
    //             if (response.status && response.isLoggedIn) {
    //                 swal({
    //                     title: 'Giao dịch hoàn tất',
    //                     type: 'success',
    //                     text: 'Mua thành công tài khoản #' + acc
    //                 }, function() {
    //                     location.href = '/lich-su-giao-dich';
    //                 });
    //             } else if (!response.status && !response.isLoggedIn){
    //                 $("#my-modal-login-register").modal('show');
    //                 swal({
    //                     title: 'Thông báo',
    //                     type: 'info',
    //                     text: 'Chưa đăng nhập. Vui lòng đăng nhập để mua tài khoản'
    //                 }, function() {
    //                 });
    //             } else {
    //                 swal({
    //                     title: 'Thông báo',
    //                     type: 'error',
    //                     text: response.msg
    //                 }, function() {
    //                 });
                    
    //             }
    //         },
    //         error: function(error){
    //             toastr.error('Mua acc thất bại');
    //         }
    //     });
    // });
}

$(document).ready(function () {
    $('.sl-icmenu').click(function () {
        $('.sl-menu').toggleClass('slshowmn');
    });
    
    
    $('.slchgame').swiper({
        slidesPerView: 5,
        paginationClickable: true,
        preventClicks: false,
        spaceBetween: 20,
        scrollbarHide: false,
        scrollbarDraggable: true,
        scrollbar: '.slchgame .swiper-scrollbar',
        breakpointsInverse: true,
        breakpoints: {
            992: {
                slidesPerView: 3
            }
        }
    });
});