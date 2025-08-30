<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\HistoryBought;
use App\Models\HistoryChargeCard;
use Illuminate\Support\Facades\DB;
use App\Common\common;


class HistoryBoughtController extends Controller
{   
    public function __contructor(){
        if (Auth::guard('users_client')->guest()) {
            return redirect('/');
        }
    }
    public function getViewIndex() {
        if (Auth::guard('users_client')->check()) {
            $user = Auth::guard('users_client')->user();
            $uid = $user->uid;
            $data['list'] = DB::table('history_boughts')
            ->join('type_accounts', 'type_accounts.ta_id', '=', 'history_boughts.type_account')
            ->where('uid',$uid)
            ->get();

            // $data['list'] = Common::convertTypeAccountText($data['list']);
            return view('frontend/history_boughts', $data);
        }
    }
}