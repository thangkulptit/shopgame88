<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Common\common;

class AccountDetailController extends Controller
{
    public function getViewDetailLMHT(Request $request) {
        $id = $request->route('id');
        $detail = Account::find($id);

        $acc = Common::filterRankOne($detail);
        $data['data_account'] = $acc;
        $arrIMG = Common::convertUrlImagesToArray($acc['url_image']);
        $data['img_content'] = $arrIMG;
        return view('frontend/account/details/account-detail', $data);
    }

    public function getViewDetailLQ(Request $request) {
        $id = $request->route('id');
        $detail = Account::find($id);
        $acc = Common::filterRankOne($detail);
        $data['data_account'] = $acc;
        $arrIMG = Common::convertUrlImagesToArray($acc['url_image']);
        $data['img_content'] = $arrIMG;
        return view('frontend/account/details/account-detail-lienquan', $data);

    }

    public function getViewDetailFF(Request $request) {
        $id = $request->route('id');
        $detail = Account::find($id);
        $acc = Common::filterRankOne($detail);
        $data['data_account'] = $acc;
        $arrIMG = Common::convertUrlImagesToArray($acc['url_image']);
        $data['img_content'] = $arrIMG;
        return view('frontend/account/details/account-detail-freefire', $data);
    }

    public function getViewDetailLMHTKR(Request $request) {
        $id = $request->route('id');
        $detail = Account::find($id);
        $acc = Common::filterRankOne($detail);
        $data['data_account'] = $acc;
        $arrIMG = Common::convertUrlImagesToArray($acc['url_image']);
        $data['img_content'] = $arrIMG;
        return view('frontend/account/details/account-detail', $data);
    }

    public function getViewDetailCF(Request $request) {
        $id = $request->route('id');
        $detail = Account::find($id);
        $acc = Common::filterRankOne($detail);
        $data['data_account'] = $acc;
        $arrIMG = Common::convertUrlImagesToArray($acc['url_image']);
        $data['img_content'] = $arrIMG;
        return view('frontend/account/details/account-detail-cf', $data);
    }

    public function getViewDetailPubgMobile(Request $request) {
        $id = $request->route('id');
        $detail = Account::find($id);
        $acc = Common::filterRankOne($detail);
        $data['data_account'] = $acc;
        $arrIMG = Common::convertUrlImagesToArray($acc['url_image']);
        $data['img_content'] = $arrIMG;
        return view('frontend/account/details/account-detail-pubg-mobile', $data);
    }

    public function getViewDetailFifa(Request $request) {
        $id = $request->route('id');
        $detail = Account::find($id);
        $acc = Common::filterRankOne($detail);
        $data['data_account'] = $acc;
        $arrIMG = Common::convertUrlImagesToArray($acc['url_image']);
        $data['img_content'] = $arrIMG;
        return view('frontend/account/details/account-detail-fo4', $data);
    }
    
    public function getViewDetailPubgPC(Request $request) {
        $id = $request->route('id');
        $detail = Account::find($id);
        $acc = Common::filterRankOne($detail);
        $data['data_account'] = $acc;
        $arrIMG = Common::convertUrlImagesToArray($acc['url_image']);
        $data['img_content'] = $arrIMG;
        return view('frontend/account/details/account-detail-pubg-pc', $data);
    }
}
