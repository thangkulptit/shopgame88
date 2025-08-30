<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\HistoryChargeCard;
use App\UserClient;

class RechargeCardController extends Controller
{
    private $REQUEST_ID = 111111;
    private $CHARGE_CARD = '060715';

    public function callback(Request $request) {
        if ($request->get('authentication') != md5($this->REQUEST_ID)) {
            return response()->json([
                'rcode' => 403,
                'msg' => 'Unauthozied'
            ]);
        }

        $card_data = $request->card_data; //lay array card_data;
        $status = $request->status; //lay status
        $desc = $request->desc; // lay mo ta

        $serial = $card_data['serial']; //lay serial
        $pin = $card_data['pin']; //lay ma the
        $amount = $card_data['amount']; //lay menh gia
        $type = $card_data['card_type']; //lay card_type

        $historyCard = HistoryChargeCard::where(['seri_card' => $serial, 'code_card' => $pin])
                        ->orderBy('created_at', 'desc')
                        ->limit(1)
                        ->firstOrFail();

        if ($historyCard->status != 99) {
            return;
        }
        $uid = $historyCard->uid; //user nap the

        if ($status == 1) {
            //The nap thanh cong
            $user = UserClient::where('uid', $uid)->first();
            $moneyNew = $user->money + $amount;
            //update money cho user nap the
            UserClient::where('uid', $uid)->update(array('money' => $moneyNew));
            // cap nhat lai status
            HistoryChargeCard::where(['seri_card' => $serial, 'code_card' => $pin])
            ->update(array('status' => $status));
        } else {
            HistoryChargeCard::where(['seri_card' => $serial, 'code_card' => $pin])
            ->update(array('status' => $status));
        }
        // $status = $validate['status']; //Trạng thái thẻ nạp, thẻ thành công = 1, thẻ thất bại != 1, xem bảng mã lỗi.
		// $description = $validate['desc']; //Mô tả chi tiết lỗi.
		// $serial = $validate['card_data']['serial']; //Số serial của thẻ.
		// $pin = $validate['card_data']['pin']; //Mã pin của thẻ.
		// $card_type = $validate['card_data']['card_type']; //Loại thẻ. vd: VTT, VMS, VNP.
		// $amount = $validate['card_data']['amount']; //Mệnh giá của thẻ.
		// $real = $validate['card_data']['real_amount']; //Mệnh giá của thẻ.
        // $uid = $validate['content']; //Nội dung quý khách đã đẩy lên ở phần nạp thẻ.
        
    }
}
