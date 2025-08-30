<?php

use Illuminate\Database\Seeder;

class UserClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrUser = [
            [
                'uid' => '1111114511111111',
                'name' => 'Tran Thang',
                'email' => 'thang22619971@gmail.com',
                'username' => 'boyjaxx1',
                'password' => bcrypt('123456'),
                'avatar' => 'abc/img',
                'avatar_original' => 'abc/img',
                'name_social' => 'Tran Thang',
                'money' => 0,
                'key'=>'0'
            ],
            [
                'uid' => '11111123411111',
                'name' => 'Tran Thang',
                'email' => 'thang22619972@gmail.com',
                'username' => 'boyjaxx2',
                'password' => bcrypt('123456'),
                'avatar' => 'abc/img',
                'avatar_original' => 'abc/img',
                'name_social' => 'Tran Thang',
                'money' => 0,
                'key'=>'0'
            ],
            [
                'uid' => '11111132311111',
                'name' => 'Tran Thang',
                'email' => 'thang22619973@gmail.com',
                'username' => 'boyjaxx3',
                'password' => bcrypt('123456'),
                'avatar' => 'abc/img',
                'avatar_original' => 'abc/img',
                'name_social' => 'Tran Thang',
                'money' => 0,
                'key'=>'0'
            ],
            [
                'uid' => '11111999111111',
                'name' => 'Tran Thang',
                'email' => 'thang22619974@gmail.com',
                'username' => 'boyjaxx4',
                'password' => bcrypt('123456'),
                'avatar' => 'abc/img',
                'avatar_original' => 'abc/img',
                'name_social' => 'Tran Thang',
                'money' => 0,
                'key'=>'0'
            ],
            [
                'uid' => '1111111111141111',
                'name' => 'Tran Thang',
                'email' => 'thang22619975@gmail.com',
                'username' => 'boyjaxx5',
                'password' => bcrypt('123456'),
                'avatar' => 'abc/img',
                'avatar_original' => 'abc/img',
                'name_social' => 'Tran Thang',
                'money' => 0,
                'key'=>'0'
            ],

        ];

        DB::table('user_clients')->insert($arrUser);
    }
}
