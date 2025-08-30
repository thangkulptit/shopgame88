$(document).ready(function(){

    $('.thu-van-may').click(function(){
        
        let type = '';
        type = $(this).attr('data-buy');
        let price = 0;
        let msg = '';
        let content = '';
        switch(type) {
            case 'lq-random-9k':
                price = '9.000';
                content = '100% Acc từ 20 - 88 tướng \n 10% Acc Cực Vip';
                msg = 'Liên Quân Sơ cấp';
                break;
            case 'lq-random-25k':
                price = '25.000';
                content = '100% Acc từ 20 - 88 tướng \n 10% Acc Cực Vip';
                msg = 'Liên Quân Trung cấp';
                 break;
            case 'lq-random-50k':
                price = '50.000';
                content = '100% Acc từ 30 - 88 tướng \n 30% Acc Cực Vip';
                msg = 'Liên Quân Cao Cấp';
                break;
            case 'lq-random-100k':
                price = '100.000';
                content = '100% Acc từ 40 - 88 tướng \n 50% Acc Cực Vip';
                msg = 'Liên Quân Đặc Biệt';
                break;
            case 'lmht-random-9k':
                price = '9.000';
                content = '100% Acc từ 30 - full tướng \n 10% Acc Cực Vip';
                msg = 'Liên Minh Sơ Cấp';
                break;
            case 'lmht-random-15k':
                price = '15.000';
                content = '100% Acc từ 40 - full tướng \n 20% Acc Cực Vip';
                msg = 'Liên Minh Trung Cấp';
                break;
            case 'lmht-random-50k':
                price = '50.000';
                content = '100% Acc từ 80 - full tướng \n 20% Acc Cực Vip';
                msg = 'Liên Minh Cao Cấp';
                break;
            case 'lmht-random-100k':
                price = '100.000';
                content = '100% Acc từ 100 - full tướng \n 50% Acc Cực Vip';
                msg = 'Liên Minh Đặc Biệt';
                 break;
            default: return; 
        }
        swal({
            title: "Mua acc "+msg,
            text: "Giá: " + price + "đ \n " + content,
            type: "success",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Mua ngay',
            closeOnConfirm: false,
            //closeOnCancel: false
        },
        function(){
            buyAccRd(type);
        });
    });
});

function buyAccRd(type){
    ajaxSetup();
    $.ajax({
        type: "POST",
        url: "/account/buy_acc_random",
        data: {type : type},
        dataType: "json",
        success: function (res) {
            if (!res.isLoggedIn && !res.status) {
                $("#my-modal-login-register").modal('show');
                swal("Chưa đăng nhập!", "Bạn hãy đăng nhập vào để mua acc", "warning");
                return;
            } else if (res.isLoggedIn && !res.status) {
                swal("Thông báo", res.msg, "warning");
                return;
            }
            swal("Thông báo", res.msg, "success");
            UpdateMoneyWhenBuyRandom(res.price);
        },
        error: function(res) {
            // location.reload();
        }
    });
}

function UpdateMoneyWhenBuyRandom(price){
    const paramPrice = Number.parseInt(price);
    const money = $('#total_money').attr('data-money');
    const parseMoney = Number.parseInt(money);

    const priceMoney = Number.parseInt(paramPrice);
    const currentMoney = parseMoney - priceMoney;
    //set
    $('#total_money').attr('data-money', currentMoney);
    $('#total_money').text(currentMoney + 'đ');
}