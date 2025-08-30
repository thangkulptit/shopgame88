<?php

use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [];
        for ($x = 0; $x <= 100; $x++) {
            array_push($array,  [
                    'type_account' => '1',
                    'username'     => 'username',
                    'password'     => 'password',
                    'url_image'    => '/images/account/1754162938x03.png|/images/account/1754162938x14.png',
                    'price'        => '150000',
                    'content'      => 'Trang Thong tin',
                    'status'       => 1,
                    'count_champs'       => '90',
                    'count_skins'       => '90',
                    'count_ngoc'       => '90',
                    'rank'       => 'kc1',
                    'price' => '1230',
                    'vip_level' => '2',
                    'vip_name' => 'Vip map1401',
                    'vip_main' => 'SIÊU PHẨM VIP 8888',
                ]);
        }

        DB::table('accounts')->insert($array);
    }
}
