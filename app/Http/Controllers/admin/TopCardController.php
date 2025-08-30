<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\UserClient;
use App\Models\HistoryChargeCard;
use App\Models\HistoryBought;
use Carbon\Carbon;
use App\Common\common;

use Auth;


class TopCardController extends Controller
{
    public function getIndexView(){
        $data['card'] = DB::select('select history_charge_cards.id as id, user_clients.uid as uid,  name,  type_card, amount_card, seri_card,  code_card, status, history_charge_cards.created_at from history_charge_cards LEFT JOIN user_clients ON history_charge_cards.uid = user_clients.uid  WHERE status <> 1 && status <> 2 order by history_charge_cards.created_at desc');
        return view('backend/card-manager', $data);
    }

    public function handleEventActionSuccess(Request $req) {
        if (Auth::guest()) {
            return response()->json([
                'rcode' => 403,
                'emsg' => 'Unauthorized'
            ]);
        }
        if ($req->ajax()) {
            $uid = $req->get('uid');
            $amount = $req->get('amount');
            $id = $req->get('id');
            $user = UserClient::where('uid', $uid)->take(1)->get();
            $moneyNew = $user[0]['money'] + $amount;
            UserClient::where('uid', $uid)->update(array('money' => $moneyNew));
            $history = HistoryChargeCard::find($id);
            $history->status = 1;
            $history->save();
            return response([
                'rcode' => 200,
                'msg' =>'Thành công'
            ]);
        }
    }
    public function handleEventActionFailed(Request $req) {
        if (Auth::guest()) {
            return response()->json([
                'rcode' => 403,
                'emsg' => 'Unauthorized'
            ]);
        }
        if ($req->ajax()) {
            $id = $req->get('id');
            $history = HistoryChargeCard::find($id);
            $history->status = 2;
            $history->save();
            return response([
                'rcode' => 200,
                'msg' =>'Thành công'
            ]);
        } else {
            return response([
                'rcode' => 403,
                'msg' =>'Unauthorized'
            ]);
        }
    }

    public function getViewHistoryCard(Request $request) {
        
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $data['monthCurrent'] = $month;
        $data['card'] = HistoryChargeCard::where('status', 1)
        ->orderBy('created_at', 'desc')
        ->orderBy('id', 'desc')
        ->paginate(16);

        $data['total'] = DB::table("history_charge_cards")
        ->where('status', 1)
        ->whereYear('created_at', Carbon::now()->year)
        ->whereMonth('created_at', Carbon::now()->month)
        ->get()
        ->sum("amount_card");
        return view('backend/history-card', $data);
    }

    public function getViewHistoryBuy() {
        $data['list'] = HistoryBought::orderBy('created_at', 'desc')->paginate(20);
        $data['list'] = Common::convertTypeAccountText($data['list']);
        return view('backend/history-bought', $data);
    }
}
