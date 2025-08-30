<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountRandom;
use App\Models\Account;
use App\Models\HistoryBought;
use App\Models\SeoContentModel;
use App\Models\TypeAccount;


use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;

use simplehtmldom\HtmlWeb;
use Auth;
use App\UserClient;
use App\Common\common;

class HomeController extends Controller
{
    use AuthenticatesUsers;

    public function getViewBookAcc(){
        $data['list'] = Common::getBookHome();
        return view('frontend/book-acc-all', $data);
    }

    public function getViewAccNinjaSchool() {
        $acc = DB::table('accounts')
            ->join('servers', 'accounts.server', '=', 'servers.server_id')
            ->join('sects', 'accounts.sect', '=', 'sects.sect_id')
            ->where(['accounts.type_account' => 9, 'status' => 1])
            ->paginate(16);
        $data['accountList'] = $acc;
        $this->getBackgroundAccount($acc);
        return view('frontend/shop-ninja', $data);
    }

    public function getViewAccNgocRong() {
        $htmlWeb = new HtmlWeb();
        $html = $htmlWeb->load('http://acclienquan24h.vn');
        $b = $html->find('div');
        $arrPrice = array();
        // foreach($html as $item) {
        //     $b = $item->find('div.value')
        // }
        $acc = DB::table('accounts')
            ->join('servers', 'accounts.server', '=', 'servers.server_id')
            ->join('sects', 'accounts.sect', '=', 'sects.sect_id')
            ->where(['accounts.type_account' => 10, 'status' => 1])
            ->paginate(16);
        $data['accountList'] = $acc;
        $this->getBackgroundAccount($acc);
        return view('frontend/shop-ngocrong', $data);
    }

    public function loadAccountList2(Request $req) {
        $sPrice = $req->get('price');
        $sSect = $req->get('sect');
        $sAcc_id = $req->get('id');
        $sLevel = $req->get('level');
        $sType = $req->get('type');
        $sSort = $req->get('sort');
        $vip_name = $req->get('vip_name');
        $vip_level = $req->get('vip_level');
        $orderByStr = $this->getStringOrder($sSort);

        $acc = DB::table('accounts')
            ->where(['accounts.type_account' => $sType, 'status' => 1])
            ->orderBy($orderByStr[0],$orderByStr[1])
            ->when($sPrice, function($query, $sPrice) {
                $priceList = $this->convertPriceSearch($sPrice);
                return $query->where('price','>=', $priceList[0])->where('price','<=', $priceList[1]);
            })
            ->when($vip_name, function($query, $vip_name) {
                return $query->where(['vip_name' => $vip_name]);
            })
            ->when($vip_level, function($query, $vip_level) {
                return $query->where(['vip_level' => $vip_level]);
            })
            ->when($sAcc_id, function($query, $sAcc_id) {
                return $query->where(['acc_id' => $sAcc_id]);
            })
            ->paginate(16);
        $acc = $this->getBackgroundAccount($acc);

        $data['accountList'] = $acc;
        $pathView = $this->getPathViewWhenFetchAccount($sType);

        return view($pathView, $data);
    }

    private function getBackgroundAccount($data) {
        for($i = 0; $i < sizeof($data); $i++) {
            //img bgr
            if (isset($data[$i]->url_image)) {
                $arrIMG = explode("|", $data[$i]->url_image);
                $data[$i]->img_bgr = $arrIMG[0];
            }
        }
        return $data;
    }

    private function convertPriceSearch($sPrice) {
        $priceList = array();
        switch($sPrice) {
            case '<50k':
                $price1 = 0;
                $price2 = 50000;
            break;
            case '50k-100k':
                $price1 = 50000;
                $price2 = 100000;
            break;
            case '0k-500k':
                $price1 = 0;
                $price2 = 500000;
            break;
            case '100k-500k':
                $price1 = 100000;
                $price2 = 500000;
            break;
            case '500k-1tr':
                $price1 = 500000;
                $price2 = 1000000;
            break;
            case '1tr-3tr':
                $price1 = 1000000;
                $price2 = 3000000;
            break;
            case '3tr-5tr':
                $price1 = 3000000;
                $price2 = 5000000;
            break;
            case '5tr-10tr':
                $price1 = 5000000;
                $price2 = 10000000;
            break;
            case '10tr-15tr':
                $price1 = 10000000;
                $price2 = 15000000;
            break;
            case '15tr-20tr':
                $price1 = 15000000;
                $price2 = 20000000;
            break;
            case '10tr>':
                $price1 = 10000000;
                $price2 = 990000000;
            break;
            default:
            break;
        }
        array_push($priceList, $price1);
        array_push($priceList, $price2);
        return $priceList;
    }
    private function convertLevelNinjaSearch($sLevel) {
        $levels = array();
        switch($sLevel) {
            case '<5x':
                $levelMin = 0;
                $levelMax = 49;
            break;
            case '5x':
                $levelMin = 50;
                $levelMax = 59;
            break;
            case '6x':
                $levelMin = 60;
                $levelMax = 69;
            break;
            case '7x':
                $levelMin = 70;
                $levelMax = 79;
            break;
            case '8x':
                $levelMin = 80;
                $levelMax = 89;
            break;
            case '9x':
                $levelMin = 90;
                $levelMax = 99;
            break;
            case '10x':
                $levelMin = 100;
                $levelMax = 109;
            break;
            case '11x':
                $levelMin = 110;
                $levelMax = 119;
            break;
            case '12x':
                $levelMin = 120;
                $levelMax = 129;
            break;
            case '13x':
                $levelMin = 130;
                $levelMax = 139;
            break;
            case '>13x':
                $levelMin = 131;
                $levelMax = 1000;
            break;
        }
        array_push($levels, $levelMin);
        array_push($levels, $levelMax);

        return $levels;
    }

    public function getViewHome()
    {
        $counts = DB::table('accounts')
            ->selectRaw("
                SUM(CASE WHEN price BETWEEN 0 AND 500000 THEN 1 ELSE 0 END) as range_0_500k,
                SUM(CASE WHEN price BETWEEN 500001 AND 1000000 THEN 1 ELSE 0 END) as range_500k_1m,
                SUM(CASE WHEN price BETWEEN 1000001 AND 3000000 THEN 1 ELSE 0 END) as range_1m_3m,
                SUM(CASE WHEN price BETWEEN 3000001 AND 5000000 THEN 1 ELSE 0 END) as range_3m_5m,
                SUM(CASE WHEN price BETWEEN 5000001 AND 10000000 THEN 1 ELSE 0 END) as range_5m_10m,
                SUM(CASE WHEN price BETWEEN 10000000 AND 990000000 THEN 1 ELSE 0 END) as range_above_10m
            ")
            ->first();
        
        $data['list'] = [
            [
                'title' => 'Acc Đột Kích dưới 500k',
                'link' => url('/shop-acc-dot-kich.html?price=0k-500k&type=1'),
                'description' => 'Số account hiện có: '. $counts->range_0_500k,
                'bgr' => asset('/images/siu_co.gif'),
            ],
            [
                'title' => 'Acc Đột Kích 500k - 1tr',
                'link' => url('/shop-acc-dot-kich.html?price=500k-1tr&type=1'),
                'description' => 'Số account hiện có: '. $counts->range_500k_1m,
                'bgr' => asset('/images/siu_re.gif'),
            ],
            [
                'title' => 'Acc Đột Kích 1tr - 3tr',
                'link' => url('/shop-acc-dot-kich.html?price=1tr-3tr&type=1'),
                'description' => 'Số account hiện có: '. $counts->range_1m_3m,
                'bgr' => asset('/images/siu_re.gif'),
            ],
            [
                'title' => 'Acc Đột Kích 3tr - 5tr',
                'link' => url('/shop-acc-dot-kich.html?price=3tr-5tr&type=1'),
                'description' => 'Số account hiện có: '. $counts->range_3m_5m,
                'bgr' => asset('/images/siu_re.gif'),
            ],
            [
                'title' => 'Acc Đột Kích 5tr - 10tr',
                'link' => url('/shop-acc-dot-kich.html?price=5tr-10tr&type=1'),
                'description' => 'Số account hiện có: '. $counts->range_5m_10m,
                'bgr' => asset('/images/siu_vip.gif'),
            ],
            [
                'title' => 'Acc Đột Kích 10tr trở lên',
                'link' => url('/shop-acc-dot-kich.html?price=10tr>&type=1'),
                'description' => 'Số account hiện có: '. $counts->range_above_10m,
                'bgr' => asset('/images/siu_vip.gif'),
            ],
        ];

        return view('frontend.book-acc-all', $data);
    }

    public function getViewShopLQ() {
        $acc = Account::where(['type_account' => 5, 'status' => 1])
        ->orderBy('acc_id', 'desc')
        ->paginate(16);
        $accimg = Common::getImagesAll($acc);
        $data['accountList'] = Common::filterRankAll($acc);
        return view('frontend/shop-lien-quan', $data);
    }

    public function getViewShopFreefine() {
        $acc = Account::where(['type_account' => 1, 'status' => 1])
        ->orderBy('acc_id', 'desc')
        ->paginate(16);
        $accimg = Common::getImagesAll($acc);
        $data['accountList'] = Common::filterRankAll($acc);
        return view('frontend/shop-acc-free-fire', $data);
    }
    public function getViewShopLMHTKorea() {
        $acc = Account::where(['type_account' => 3, 'status' => 1])
        ->orderBy('acc_id', 'desc')
        ->paginate(16);
        $accimg = Common::getImagesAll($acc);
        $data['accountList'] = Common::filterRankAll($acc);
        return view('frontend/shop-korea', $data);
    }
    public function getViewShopCF() {
        $acc = Account::where(['type_account' => 1, 'status' => 1])
        ->orderBy('acc_id', 'desc')
        ->paginate(16);
        $accimg = Common::getImagesAll($acc);
        $data['accountList'] = Common::filterRankAll($acc);
        return view('frontend/index', $data);
    }
    public function getViewShopPubgMobile() {
        $acc = Account::where(['type_account' => 6, 'status' => 1])
        ->orderBy('acc_id', 'desc')
        ->paginate(16);
        $accimg = Common::getImagesAll($acc);
        $data['accountList'] = Common::filterRankAll($acc);
        return view('frontend/shop-pubg-mobile', $data);
    }
    public function getViewShopPubgPC() {
        $acc = Account::where(['type_account' => 7, 'status' => 1])
        ->orderBy('acc_id', 'desc')
        ->paginate(16);
        $accimg = Common::getImagesAll($acc);
        $data['accountList'] = Common::filterRankAll($acc);
        return view('frontend/shop-pubg-pc', $data);
    }
    public function getViewShopFo4() {
        $acc = Account::where(['type_account' => 8, 'status' => 1])
        ->orderBy('acc_id', 'desc')
        ->paginate(15);
        $accimg = Common::getImagesAll($acc);
        $data['accountList'] = Common::filterRankAll($acc);
        return view('frontend/shop-fo4', $data);
    }

    public function getViewShopFo4_V2() {
        $acc = Account::where(['type_account' => 8, 'status' => 1])
        ->orderBy('acc_id', 'desc')
        ->paginate(15);
        $accimg = Common::getImagesAll($acc);
        $data['accountList'] = Common::filterRankAll($acc);
        // $data['typeAccountList'] = TypeAccount::get();
        return view('frontend_v2/fifa/index', $data);
    }

    public function fetchDataAccount(Request $request){
        if ($request->ajax()){
            $type = $request->get('type');
            $acc = Account::where(['type_account' => $type, 'status' => 1])->paginate(16);
            $accimg = Common::getImagesAll($acc);
            $data['listAccount'] = Common::filterRankAll($acc);
            $pathView = $this->getPathViewWhenFetchAccount($type);
            return view($pathView, $data);
        }
    }

    public function getViewSuggest(Request $request) {
        return view('frontend/suggest-buy-acc');
    }

    private function getPathViewWhenFetchAccount($type) {
        switch($type) {
            case 1:
                $path = 'frontend/account/account-list';
                break;
            case 2:
                $path = 'frontend/account/account';
                break;
            case 3:
                $path = 'frontend/account/account-korea';
                break;
            case 4:
                $path = 'frontend/account/account-cf';
                break;
            case 5:
                $path = 'frontend/account/account-lienquan';
                break;
            case 6:
                $path = 'frontend/account/account-pubg-mobile';
                break;
            case 7:
                $path = 'frontend/account/account-pubg-pc';
                break;
            case 8:
                $path = 'frontend_v2/fifa/accounts';
                break;
            case 9:
                $path = 'frontend/account/account-ninja';
                break;
            case 10:
                $path = 'frontend/account/account-ngocrong';
                break;
            default:
            break;
        }
        return $path;
    }

    private function getStringOrder($sort) {
        $orderBy = [];
        switch($sort) {
            case 'acc-moi-dang':
                $orderBy = ['created_at', 'DESC'];
            break;
            case 'gia-cao-nhat':
                $orderBy = ['price', 'DESC'];
            break;
            case 'gia-thap-nhat':
                $orderBy = ['price', 'ASC'];
            break;
            default:
                $orderBy = ['acc_id', 'DESC'];
            break;
        }
        return $orderBy;
    }

    public function loadAccountList(Request $req) {
        $sPrice = $req->get('price');
        $sRank = $req->get('rank');
        $sType = (int)$req->get('loai');
        $sSort = $req->get('sort');
        $sChamp = $req->get('champ');
        $sSkin = $req->get('skin');

        $orderByStr = $this->getStringOrder($sSort);

        $isValid = false;
        if (isset($sRank)) {
            switch($sRank) {
                case 'chuarank':
                    $isValid = true;
                    break;
                case 'dong':
                    $isValid = true;
                break;
                case 'bac':
                    $isValid = true;
                break;
                case 'vang':
                    $isValid = true;
                break;
                case 'bk':
                    $isValid = true;
                break;
                case 'kc':
                    $isValid = true;
                break;
                case 'ct':
                    $isValid = true;
                break;
                case 'td':
                    $isValid = true;
                break;
                default:
                $isValid = false; break;
            }
        }
        $price = null;
        $price1 = null;
        $price2 = null;
        if (isset($sPrice)) {
            switch($sPrice) {
                case '20k':
                    $price = 20000;
                    $isValid = true;
                break;
                case '30k':
                    $price = 20000;
                    $isValid = true;
                break;
                case '40k':
                    $price = 20000;
                    $isValid = true;
                break;
                case '50k':
                    $price = 20000;
                    $isValid = true;
                break;
                case '<50k':
                    $price1 = 0;
                    $price2 = 50000;
                    $isValid = true;
                break;
                case '50k-100k':
                    $price1 = 50000;
                    $price2 = 100000;
                    $isValid = true;
                break;
                case '100k-200k':
                    $price1 = 100000;
                    $price2 = 200000;
                    $isValid = true;
                break;
                case '200k-500k':
                    $price1 = 200000;
                    $price2 = 500000;
                    $isValid = true;
                break;
                case '500k-1000k':
                    $price1 = 500000;
                    $price2 = 1000000;
                    $isValid = true;
                break;
                case '>1000k':
                    $price1 = 1000000;
                    $price2 = 100000000;
                    $isValid = true;
                break;
                default:
                $isValid = false; break;
            }
        }
        if ($sType == 2 || $sType == 3) {
            $acc = $this->queryIfTypeLienMinh($orderByStr, $sRank, $sPrice, $sType, $price, $price1, $price2, $sChamp, $sSkin, $isValid);
        } else {
            $acc = $this->queryIfTypeLienQuan($orderByStr, $sRank, $sPrice, $sType, $price, $price1, $price2, $isValid);
        }

        if(isset($acc)) {
            $accimg = Common::getImagesAll($acc);
            $data['listAccount'] = Common::filterRankAll($accimg);
            $pathView = $this->getPathViewWhenFetchAccount($sType);
            return view($pathView, $data);
        }
    }

    private function queryIfTypeLienQuan($orderByStr, $sRank, $sPrice, $sType, $price, $price1, $price2, $isValid) {
        if (!isset($sPrice) && !isset($sRank)) {
            $acc = Account::where(['type_account' => $sType, 'status' => 1])
            ->orderBy($orderByStr[0],$orderByStr[1])
            ->paginate(16);
        }

        if (!isset($sPrice) && isset($sRank)) {
            if ($isValid) {
                $acc = Account::query()
                ->where(['type_account' => $sType, 'status' => 1])
                ->where('rank', 'LIKE', "%{$sRank}%")
                ->orderBy($orderByStr[0],$orderByStr[1])
                ->paginate(16);
            }
        }
        if (isset($sPrice) && !isset($sRank)) {
            if ($isValid) {
                if (isset($price) && !isset($price1, $price2)) {
                    $acc = Account::query()
                    ->where('price', $price)
                    ->where(['type_account' => $sType, 'status' => 1])
                    ->orderBy($orderByStr[0],$orderByStr[1])
                    ->paginate(16);
                } else if (!isset($price) && isset($price1, $price2)){
                    $acc = Account::where(['type_account' => $sType, 'status' => 1])
                    ->where('price', '>=', $price1)
                    ->where('price', '<=', $price2)
                    ->orderBy($orderByStr[0],$orderByStr[1])
                    ->paginate(16);
                }
            }
        }

        if (isset($sPrice) && isset($sRank)) {
            if (isset($price)) {
                $acc = Account::query()
                    ->where('price', $price)
                    ->where('rank', 'LIKE', "%{$sRank}%")
                    ->orderBy($orderByStr[0],$orderByStr[1])
                    ->paginate(16);
            } else {
                $acc = Account::whereBetween('price', [$price1, $price2])
                    ->where(['type_account' => $sType, 'status' => 1])
                    ->where('rank', 'LIKE', "%{$sRank}%")
                    ->orderBy($orderByStr[0],$orderByStr[1])
                    ->paginate(16);
            }
        }
        return $acc;
    }
    private function queryIfTypeLienMinh($orderByStr, $sRank, $sPrice, $sType, $price, $price1, $price2, $sChamp, $sSkin, $isValid) {
        if (!isset($sPrice) && !isset($sRank)) {
            $acc = Account::where(['type_account' => $sType, 'status' => 1])
            ->orderBy($orderByStr[0],$orderByStr[1])
            ->where('url_champs', 'LIKE', "%{$sChamp}%")
            ->where('url_skins', 'LIKE', "%{$sSkin}%")
            ->paginate(16);
        }

        if (!isset($sPrice) && isset($sRank)) {
            if ($isValid) {
                $acc = Account::query()
                ->where(['type_account' => $sType, 'status' => 1])
                ->where('rank', 'LIKE', "%{$sRank}%")
                ->where('url_champs', 'LIKE', "%{$sChamp}%")
                ->where('url_skins', 'LIKE', "%{$sSkin}%")
                ->orderBy($orderByStr[0],$orderByStr[1])
                ->paginate(16);
            }
        }
        if (isset($sPrice) && !isset($sRank)) {
            if ($isValid) {
                if (isset($price) && !isset($price1, $price2)) {
                    $acc = Account::query()
                    ->where('price', $price)
                    ->where(['type_account' => $sType, 'status' => 1])
                    ->where('url_champs', 'LIKE', "%{$sChamp}%")
                    ->where('url_skins', 'LIKE', "%{$sSkin}%")
                    ->orderBy($orderByStr[0],$orderByStr[1])
                    ->paginate(16);
                } else if (!isset($price) && isset($price1, $price2)){
                    $acc = Account::where(['type_account' => $sType, 'status' => 1])
                    ->where('price', '>=', $price1)
                    ->where('price', '<=', $price2)
                    ->where('url_champs', 'LIKE', "%{$sChamp}%")
                    ->where('url_skins', 'LIKE', "%{$sSkin}%")
                    ->orderBy($orderByStr[0],$orderByStr[1])
                    ->paginate(16);
                }
            }
        }

        if (isset($sPrice) && isset($sRank)) {
            if (isset($price)) {
                $acc = Account::query()
                    ->where('price', $price)
                    ->where('rank', 'LIKE', "%{$sRank}%")
                    ->where('url_champs', 'LIKE', "%{$sChamp}%")
                    ->where('url_skins', 'LIKE', "%{$sSkin}%")
                    ->orderBy($orderByStr[0],$orderByStr[1])
                    ->paginate(16);
            } else {
                $acc = Account::whereBetween('price', [$price1, $price2])
                    ->where(['type_account' => $sType, 'status' => 1])
                    ->where('rank', 'LIKE', "%{$sRank}%")
                    ->where('url_champs', 'LIKE', "%{$sChamp}%")
                    ->where('url_skins', 'LIKE', "%{$sSkin}%")
                    ->orderBy($orderByStr[0],$orderByStr[1])
                    ->paginate(16);
            }
        }
        return $acc;
    }

    public function buyAccount(Request $request) {
        if ($request->ajax()) {
            if (Auth::guard('users_client')->guest()) {
                return response()->json([
                    'isLoggedIn' => false,
                    'status'  => false,
                    'msg' => 'Bạn chưa đăng nhập, vui lòng đăng nhập để mua tài khoản'
                ]);
            }
            $id_acc = $request->get('id');
            $accCurrent = Account::find($id_acc);
            if (!$accCurrent->exists()) {
                // nếu acc này không tồn tại
                return response()->json([
                    'isLoggedIn'=> true,
                    'status'  => false,
                    'msg' => 'Tài khoản này không tồn tại'
                ]);
            }
            $id = Auth::guard('users_client')->id();
            $user = UserClient::find($id);

            if ($user->money < $accCurrent->price) {
                //neu tien User < gia acc
                return response()->json([
                    'isLoggedIn'=> true,
                    'status'  => false,
                    'msg' => 'Tiền của bạn không đủ để mua acc, Vui lòng nạp thêm tiền vào tài khoản!'
                ]);
            }

            if ($accCurrent->status !== 1) {
                //Nếu trạng thái acc không phải đang bán
                return response()->json([
                    'isLoggedIn'=> true,
                    'status'  => false,
                    'msg' => 'Tài khoản này đã bán !'
                ]);
            }
            $user->money = $user->money - $accCurrent->price;
            //luu vao database.
            $user->save();

            //Update Account 
            $accCurrent->status = 0;
            $accCurrent->save();

            $history = new HistoryBought();
            $history->uid = $user->uid;
            $history->id_acc = $id_acc;
            $history->type_account = $accCurrent->type_account;
            $history->name = $user->name;
            $history->username = $accCurrent->username;
            $history->password = $accCurrent->password;
            $history->price = $accCurrent->price;
            $history->save();

            return response()->json([
                'isLoggedIn'=> true,
                'status' => true,
                'msg' => 'Mua acc thành công!'
            ]);
        }
    }

    public function buyAccountRandom(Request $request) {
        if ($request->ajax()) {
            if (Auth::guard('users_client')->guest()){
                return response()->json([
                    'status' => false,
                    'isLoggedIn' => false,
                    'msg' => 'Bạn chưa đăng nhập'
                ]);
            }
            if (empty($request->get('type'))) {
                return response()->json([
                    'status' => false,
                    'isLoggedIn' => true,
                    'msg' => 'Unauthozied'
                ]);
            }
        $price = $this->getTypeReturnPrice($request->get('type'));
        if ($price == false) {
            return response()->json([
                'status' => false,
                'isLoggedIn' => true,
                'msg' => 'Unauthozied'
            ]);
        }
        $id = Auth::guard('users_client')->id();
        $cUser = UserClient::find($id);
        if ($cUser->money < $price) {
            return response()->json([
                'isLoggedIn'=> true,
                'status'  => false,
                'msg' => 'Tiền của bạn không đủ để mua acc, Vui lòng nạp thêm tiền vào tài khoản!'
            ]);
        }
        $cUser->money = $cUser->money - $price;
        $cUser->save();
        $up = Common::usernamePasswordFake();
        return response()->json([
            'isLoggedIn'=> true,
            'status'  => true,
            'msg' => 'Tài khoản: ' . $up['username'] . '   Mật khẩu: ' . $up['password'],
            'price' => $price
        ]);

       }
    }

    private function getTypeReturnPrice($type){
        $isValid = false;
        switch($type) {
            case "lq-random-9k":
                $price = 9000;
                $isValid = true;
            break;
            case "lmht-random-9k":
                $price = 9000;
                $isValid = true;
            break;
            case "lq-random-25k":
                $price = 25000;
                $isValid = true;
            break;
            case "lmht-random-15k":
                $price = 15000;
                $isValid = true;
            break;
            case "lmht-random-50k":
                $price = 50000;
                $isValid = true;
            break;
            case "lq-random-50k":
                $price = 50000;
                $isValid = true;
            break;
            case "lq-random-100k":
                $price = 100000;
                $isValid = true;
            break;
            case "lmht-random-100k":
                $price = 100000;
                $isValid = true;
            break;

            default: $isValid = false;
            break;
        }

        if ($isValid == true) {
            return $price;
        } else {
            return false;
        }
    }

    public function logoutUser(Request $request) {
        $a = Auth::guard('users_client')->logout();
        return redirect()->intended('/');
    }
}