<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopLienQuanController extends Controller
{
    public function getViewShopLQ() {
        $acc = Account::where(['type_account' => 5, 'status' => 1])->paginate(16);
        $accimg = Common::getImagesAll($acc);
        $data['listAccount'] = Common::filterRankAll($acc);
        return view('frontend/index', $data);
    }
}
