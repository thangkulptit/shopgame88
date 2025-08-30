<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\HistoryChargeCard;
use App\UserClient;
use Auth;
use App\Common\common;

class ChargeCardController extends Controller
{
    private $SECRET_KEY = 'd0k92dk09dk0!';
    private $CHARGE_CARD = '060715';
    private $REQUEST_ID = 111111;
    
    public function getViewIndex() {
        if (Auth::guard('users_client')->check()) {
            $currentUser = Auth::guard('users_client')->user();
            $data['historyCharge'] = HistoryChargeCard::where('uid',$currentUser->uid)->orderBy('id', 'DESC')->get();
            return view('frontend/charge_card', $data);
        }
        return view('frontend/charge_card');
    }
    public function postCardMember(Request $req){
        if (Auth::guard('users_client')->guest()) {
            return  response()->json([
                    'error' => true,
                    'isLoggedIn' => false,
                    'msg' => 'Bạn chưa đăng nhập vào hệ thống'
                ]);
        }
        if ($req->ajax()) {
            $type = $req->get('type');
            $amount = $req->get('amount');
            $seri = $req->get('seri');
            $code = $req->get('code');
            $userSession = Auth::guard('users_client')->user();
            $request_id = $this->REQUEST_ID;
            if (HistoryChargeCard::where('seri_card', $seri)->exists()){
                return response()->json([
                    'error' => true,
                    'isLoggedIn' => true,
                    'msg' => 'Thẻ đã tồn tại trong hệ thống, Vui lòng chờ duyệt thẻ'
                ]);
            } 

            $historyCard = new HistoryChargeCard();
            $historyCard->uid = $userSession->uid;
            $historyCard->type_card = $type;
            $historyCard->amount_card = $amount;
            $historyCard->seri_card = $seri;
            $historyCard->code_card = $code;
            $historyCard->status = 0;
            $historyCard->order_by = $request_id;
            $historyCard->save();       
            $response = $this->apiToCard($type, $amount, $seri, $code);
            if ($response->rcode == 99 && $response->status == 99) {
                // Da gui len Server Nap the vui long cho`
                $find = HistoryChargeCard::find($historyCard->id);
                $find->status = 99;
                $find->save();
                return response()->json([
                    'isLoggedIn' => true,
                    'error' => false,
                    'status' => 'success',
                    'msg' => 'Thẻ đã gửi lên Hệ thống thành công, Vui lòng chờ duyệt thẻ',
                    'type' => $type,
                    'amount' => $amount,
                    'seri' => $seri,
                    'code' => $code,
                ]);
            }

            if ($response->rcode == 200 && $response->status == 1) {
                //success
                $moneyNew = $userSession->money + $amount;
                //update money
                UserClient::where('uid', $userSession->uid)->update(array('money' => $moneyNew));

                $fine = HistoryChargeCard::find($historyCard->id);
                $fine->status = 1;
                $fine->save();

                return response()->json([
                    'isLoggedIn' => true,
                    'error' => false,
                    'status' => 'success',
                    'msg' => 'Nạp thẻ thành công',
                    'type' => $type,
                    'amount' => $amount,
                    'seri' => $seri,
                    'code' => $code,
                ]);
            } else if ($response->rcode != 99 && $response->rcode != 200 && $response->status == 2){
                $fine = HistoryChargeCard::find($historyCard->id);
                $fine->status = 2;
                $fine->save();

                return response()->json([
                    'isLoggedIn' => true,
                    'error' => true,
                    'status' => 'faild',
                    'msg' => 'Nạp thẻ Thất bại',
                    'type' => $type,
                    'amount' => $amount,
                    'seri' => $seri,
                    'code' => $code,
                ]);
            }
        }
    }

    private function apiToCard($type, $amount, $seri, $code) {
        $params = array();
        $params['charge_card'] = $this->CHARGE_CARD;
        $params['authentication'] = md5($this->SECRET_KEY);
        $params['type_card'] = $type;
        $params['amount'] = $amount;
        $params['seri'] = $seri;
        $params['pin'] = $code;
        $response = $this->curlPost('https://shopacclmht69.com/core/api/open-api-shop.php', $params);

        return json_decode($response, false);
    }
    private function curlPost($url, $dataPost) { //Hàm cURL POST dữ liệu.
		if(!is_array($dataPost))
			return false;
		
		$dataPost = http_build_query($dataPost);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $dataPost);
		$ref = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; //Nếu kết quả cURL bị lỗi xác thực tên miền, thử thay thế $ref = tên miền của bạn. Ví dụ: $ref = 'https://trumthe247.com';
		curl_setopt($ch, CURLOPT_REFERER, $ref);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		
		$result = curl_exec($ch);
		
		if(curl_error($ch))
			$error_msg = curl_error($ch);
		
		curl_close($ch);
		
		if(isset($error_msg))
			return $error_msg;
		
		return $result;
	}
}
