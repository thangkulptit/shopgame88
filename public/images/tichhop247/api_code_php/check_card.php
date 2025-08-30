<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
if (isset($_POST['telco']) && isset($_POST['code']) && isset($_POST['serial']) && isset($_POST['card_amount'])) {
    include 'config.php';
    include 'card_charging_api.php';

    // Call lib
    try {
        $api = new Card_charging_api($config);
    } catch (Card_charging_Exception $e) {
        exit($e->getMessage());
    }

    $telco = $_POST['telco']; //loai the cua nha mang
    $code = $_POST['code']; // ma the
    $serial = $_POST['serial']; //serial the
    $card_amount = $_POST['card_amount']; //menh gia the
    $request_id = time(); //Mã tự sinh trong mỗi giao dịch và không giống nhau (Chung toi sẽ luu lai mã này để đối chiếu khi có khiếu lại)
    
    $res = $api->check_card($telco, $code, $serial, $card_amount, $request_id);
    
    // thành công
    if (isset($res->status) && $res->status == '00') 
    {
        $amount = $res->amount; //mệnh giá thẻ
        $telco = $res->telco; //Loại thẻ
        $serial = $res->serial; //serial
        $code = $res->code; //mã thẻ
        $tran_id = $res->tran_id; //mã giao dịch bên tichhop247.com

        echo 'Bạn đã nạp thành công thẻ ' . $key . ' mệnh giá ' . number_format($amount) . ' đ';
    }
    //có lỗi
    else {
        echo isset($res->message) ? $res->message : 'Loi khong xac dinh';
    }
} else {
    echo 'Kiem tra lai du lieu';
}
		