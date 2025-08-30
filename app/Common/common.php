<?php

namespace App\Common;
use Carbon\Carbon;
use App\Models\TypeAccount;

class Common 

{
    protected $common;
    public function __contructor(Common $common) {
        $this->common = $common;
    }
    public static function convertTypeAccountText($data) {
        for($i = 0 ; $i < sizeof($data) ; $i++) {
            if ($data[$i]->type_account == 1) {
                $data[$i]->type_account = 'Free Fire';
            } else if ($data[$i]->type_account == 2) {
                $data[$i]->type_account = 'LMHT';
            } else if ($data[$i]->type_account == 3) {
                $data[$i]->type_account = 'LMHT Hàn Quốc';
            } else if ($data[$i]->type_account == 4) {
                $data[$i]->type_account = 'Đột kích';
            } else if ($data[$i]->type_account == 5) {
                $data[$i]->type_account = 'Liên quân';
            } else if ($data[$i]->type_account == 6){
                $data[$i]->type_account = 'PUBG Mobile';
            } else if ($data[$i]->type_account == 7){
                $data[$i]->type_account = 'PUBG PC';
            } else if ($data[$i]->type_account == 8){
                $data[$i]->type_account = 'Fifa Online 4';
            }
        }
        return $data;
    }

    public static function getPathArrayImg($arrayPath){
        $stringPath = '';
        foreach ($arrayPath as $path) {
            $stringPath = $stringPath . '/images/account/'.$path . '|';
        }
        //tru di phan tu cuoi'
        return substr("$stringPath",0, strlen($stringPath)-1);
    }

    public static function convertStatusCard($data) {
        for($i = 0 ; $i < sizeof($data) ; $i++) {
            if ($data[$i]->status == 0) {
                $data[$i]->status = 'Chưa gửi';
            } else if ($data[$i]->status == 1) {
                $data[$i]->status = 'Thành công';
            } else if ($data[$i]->status == 2) {
                $data[$i]->status = 'Thất bại';
            }
        }
        return $data;
    }
    public static function jsonToArray($json) {
        return json_decode($json);
    }

    public static function formatTimerAbout($time) {
        Carbon::setLocale('vi');
        $dt = Carbon::create(2018, 10, 18, 14, 40, 16);
        $dt2 = Carbon::create(2018, 10, 18, 13, 40, 16);
        $now = Carbon::now();
        return $dt->diffForHumans($now);
    }

    public static function getArrRank(){
        $rank = [
            'chuarank' => "Chưa rank",
            'sat5' => "Sắt 5",
            'sat4' => "Sắt 4",
            'sat3' => "Sắt 3",
            'sat2' => "Sắt 2",
            'sat1' => "Sắt 1",

            'dong5' => "Đồng 5",
            'dong4' => "Đồng 4",
            'dong3' => "Đồng 3",
            'dong2' => "Đồng 2",
            'dong1' => "Đồng 1",

            'bac5' => "Bạc 5",
            'bac4' => "Bạc 4",
            'bac3' => "Bạc 3",
            'bac2' => "Bạc 2",
            'bac1' => "Bạc 1",

            'vang5' => "Vàng 5",
            'vang4' => "Vàng 4",
            'vang3' => "Vàng 3",
            'vang2' => "Vàng 2",
            'vang1' => "Vàng 1",

            'bk5' => "Bạch kim 5",
            'bk4' => "Bạch kim 4",
            'bk3' => "Bạch kim 3",
            'bk2' => "Bạch kim 2",
            'bk1' => "Bạch kim 1",

            'kc5' => "Kim cương 5",
            'kc4' => "Kim cương 4",
            'kc3' => "Kim cương 3",
            'kc2' => "Kim cương 2",
            'kc1' => "Kim cương 1",

            'ta' => "Tinh Anh",
            'ct' => "Cao thủ",
            'dct' => "Đại cao thủ",
            'td' => "Thách đấu",
        ];

        return $rank;
    }

    public static function getValueRankByKey($key) {
        $ranks = Common::getArrRank();
        if (empty($key)) {
            return '';
        }
        return $ranks[$key];
    }

    public static function filterRankAll($data){
        for($i = 0 ; $i < sizeof($data); $i++ ){
            $data[$i]['rank'] = Common::getValueRankByKey($data[$i]['rank']);
        }
        return $data;
    }
    public static function convertUrlImagesToArray($data){
        $arr = explode('|', $data);
        return $arr;
    }

    public static function filterRankOne($data){
        $data['rank'] = Common::getValueRankByKey($data['rank']);
        return $data;
    }


    public static function getImagesAll($data) {
        for($i = 0 ; $i < sizeof($data); $i++ ){
            //img tuong
            $data[$i]['img_champs_1'] = '/images/champs_lmht/1_Web_0.jpg';
            $data[$i]['img_champs_2'] = '/images/champs_lmht/2_Web_0.jpg';
            $data[$i]['img_champs_3'] = '/images/champs_lmht/3_Web_0.jpg';

            //get Img Rank
            if ($data[$i]['rank']=='dong5' || $data[$i]['rank']=='dong4' || $data[$i]['rank']=='dong3' || $data[$i]['rank']=='dong2' || $data[$i]['rank']=='dong1') {
                $data[$i]['img_rank'] = 'images/rank/bronzei.png';
            } else if ($data[$i]['rank']=='bac5' || $data[$i]['rank']=='bac4' || $data[$i]['rank']=='bac3' || $data[$i]['rank']=='bac2' || $data[$i]['rank']=='bac1') {
                $data[$i]['img_rank'] = 'images/rank/silveri.png';
            } else if ($data[$i]['rank']=='vang5' || $data[$i]['rank']=='vang4' || $data[$i]['rank']=='vang3' || $data[$i]['rank']=='vang2' || $data[$i]['rank']=='vang1') {
                $data[$i]['img_rank'] = 'images/rank/goldi.png';
            } else if ($data[$i]['rank']=='bk5' || $data[$i]['rank']=='bk4' || $data[$i]['rank']=='bk3' || $data[$i]['rank']=='bk2' || $data[$i]['rank']=='bk1') {
                $data[$i]['img_rank'] = 'images/rank/platinumi.png';
            } else if ($data[$i]['rank']=='kc5' || $data[$i]['rank']=='kc4' || $data[$i]['rank']=='kc3' || $data[$i]['rank']=='kc2' || $data[$i]['rank']=='kc1') {
                $data[$i]['img_rank'] = 'images/rank/diamondi.png';
            } else if ($data[$i]['rank']=='ct') {
                $data[$i]['img_rank'] = 'images/rank/grandmaster.png';
            } else if ($data[$i]['rank']=='td') {
                $data[$i]['img_rank'] = 'images/rank/challenge.png';
            } else if ($data[$i]['rank']=='ta') {
                $data[$i]['img_rank'] = 'images/rank/tinhanh.png';
            } else if ($data[$i]['rank']=='sat5' || $data[$i]['rank']=='sat4' || $data[$i]['rank']=='sat3' || $data[$i]['rank']=='sat2' || $data[$i]['rank']=='sat1') {
                $data[$i]['img_rank'] = 'images/rank/iron.png';
            } else if ($data[$i]['rank']=='chuarank') {
                $data[$i]['img_rank'] = 'images/rank/unranked.png';
            }

            //img bgr
            if (isset($data[$i]['url_image'])) {
                $arrIMG = explode("|", $data[$i]['url_image']);
                $data[$i]['img_bgr'] = $arrIMG[0];
            }
        }

        return $data;
    }   

    public static function convertSeo($data) {
        $h2 = explode("|", $data->title_h2);
        $data->title_h2_1 = $h2[0];
        $data->title_h2_2 = $h2[1];
        $h3 = explode("|", $data->title_h3);
        $data->title_h3_1 = $h2[0];
        $data->title_h3_2 = $h2[1];
        $data->title_h3_3 = $h2[2];
        return $data;
    }

    public static function getBookHome(){
        $domain = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $data = [
            [
                'flag' => 0,
                'type' => 'lq',
                'url' => $domain.'shop-lien-quan.html',
                'url_bgr' => '/images/thump_book/lqm.jpg',
                'title' => 'Shop Acc Liên Quân',
                'hienco' => 1523,
                'daban' => 10254,
            ],
            [
                'flag' => 0,
                'type' => 'lmht',
                'url' => $domain.'shop-acc-lmht.html',
                'url_bgr' => '/images/thump_book/lmht.jpg',
                'title' => 'Shop Acc Liên Minh',
                'hienco' => 1320,
                'daban' => 12456,
            ],
            [
                'flag' => 0,
                'type' => 'freefire',
                'url' => $domain.'shop-acc-free-fire.html',
                'url_bgr' => '/images/thump_book/freefire.jpg',
                'title' => 'Shop Acc Free Fire',
                'hienco' => 1523,
                'daban' => 2546,
            ],
            [
                'flag' => 0,
                'type' => 'cf',
                'url' => $domain.'shop-acc-dot-kich.html',
                'url_bgr' => '/images/thump_book/cf.jpg',
                'title' => 'Shop Acc Đột Kích',
                'hienco' => 2561,
                'daban' => 3515,
            ],
            [
                'flag' => 0,
                'type' => 'lmhtkr',
                'url' => $domain.'shop-acc-lol-han-quoc.html',
                'url_bgr' => '/images/thump_book/lmhtkr.jpg',
                'title' => 'Acc Hàn Quốc Lv30',
                'hienco' => 154,
                'daban' => 825,
            ],
            [
                'flag' => 0,
                'type' => 'pubg',
                'url' => $domain.'shop-acc-pubg-pc.html',
                'url_bgr' => '/images/thump_book/pubg-pc.jpg',
                'title' => 'Shop Acc PUBG PC',
                'hienco' => 2535,
                'daban' => 1534,
            ],
            [
                'flag' => 0,
                'type' => 'pubgmb',
                'url' => $domain.'shop-acc-pubg-mobile.html',
                'url_bgr' => '/images/thump_book/pubgmb.jpg',
                'title' => 'Shop Acc Pubg Mobile',
                'hienco' => 2535,
                'daban' => 1563,
            ],
            [
                'flag' => 0,
                'type' => 'ffo4',
                'url' => $domain.'shop-acc-fifa-online.html',
                'url_bgr' => '/images/thump_book/ffo4.jpg',
                'title' => 'Shop Acc FifaOnline4',
                'hienco' => 6352,
                'daban' => 4857,
            ],
            [
                'flag' => 1,
                'type' => 'lq-random-9k',
                'url' => $domain,
                'url_bgr' => '/images/thump_book/lq-random-9k.jpg',
                'title' => 'Random Liên Quân 9k',
                'hienco' => 26532,
                'daban' => 15424,
            ],
            [
                'flag' => 1,
                'type' => 'lq-random-25k',
                'url' => $domain,
                'url_bgr' => '/images/thump_book/thumblqrandom25k.jpg',
                'title' => 'Random Liên Quân 25k',
                'hienco' => 25642,
                'daban' => 14243,
            ],
            [
                'flag' => 1,
                'type' => 'lq-random-50k',
                'url' => $domain,
                'url_bgr' => '/images/thump_book/lq-random-50k.jpg',
                'title' => 'Random Liên Quân 50k',
                'hienco' => 21235,
                'daban' => 10564,
            ],
            [
                'flag' => 1,
                'type' => 'lq-random-100k',
                'url' => $domain,
                'url_bgr' => '/images/thump_book/lq-random-100k.jpg',
                'title' => 'Random Liên Quân 100k',
                'hienco' => 25342,
                'daban' => 15235,
            ],
            [
                'flag' => 1,
                'type' => 'lmht-random-9k',
                'url' => $domain,
                'url_bgr' => '/images/thump_book/lq-random-9k.jpg',
                'title' => 'Random Liên Minh 9k',
                'hienco' => 15354,
                'daban' => 25421,
            ],
            [
                'flag' => 1,
                'type' => 'lmht-random-15k',
                'url' => $domain,
                'url_bgr' => '/images/thump_book/rdlmht15k.jpg',
                'title' => 'Random Liên Minh 15k',
                'hienco' => 25365,
                'daban' => 21332,
            ],
            [
                'flag' => 1,
                'type' => 'lmht-random-50k',
                'url' => $domain,
                'url_bgr' => '/images/thump_book/rdlmht50k.jpg',
                'title' => 'Random Liên Minh 50k',
                'hienco' => 11242,
                'daban' => 2321,
            ],
            [
                'flag' => 1,
                'type' => 'lmht-random-100k',
                'url' => $domain,
                'url_bgr' => '/images/thump_book/rdlmht100k.jpg',
                'title' => 'Random Liên Minh 100k',
                'hienco' => 2423,
                'daban' => 1214,
            ]
            ];
            return $data;
    }

    public static function usernamePasswordFake(){
        $username = Common::getRdName(8);
        $password = Common::getRdName(8);
        $array = ['username' => $username, 'password' => $password ];
        
        return $array;
        // $array = array(
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        //     [ 'username' => 'anhyeulove231', 'password' => 'Minhlagi1!'],
        // );
    }
    public static function getRdName($n) { 
        $characters = '0123456789qwertyuiopasdfghjklzxcvbnmA'; 
        $randomString = ''; 
      
        for ($i = 0; $i < $n; $i++) { 
            $index = rand(0, strlen($characters) - 1); 
            $randomString .= $characters[$index]; 
        } 
      
        return $randomString; 
    }
}
