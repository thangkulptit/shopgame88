<?php

use Illuminate\Database\Seeder;

class AccountRandomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('account_random')->insert([
            [
                'type_account' => '1',
                'username'     => 'username',
                'password'     => 'password',
                'url_image'    => 'url/image/',
                'price'        => '150000',
                'content'      => 'Trang Thong tin',
                'status'       => '1',
            ],
 
            [
                'type_account' => '2',
                'username'     => 'username',
                'password'     => 'password',
                'url_image'    => 'url/image/',
                'price'        => '150000',
                'content'      => 'Trang Thong tin',
                'status'       => '1',
            ],
            [
                'type_account' => '3',
                'username'     => 'username',
                'password'     => 'password',
                'url_image'    => 'url/image/',
                'price'        => '150000',
                'content'      => 'Trang Thong tin',
                'status'       => '1',
            ],
            [
                'type_account' => '4',
                'username'     => 'username',
                'password'     => 'password',
                'url_image'    => 'url/image/',
                'price'        => '150000',
                'content'      => 'Trang Thong tin',
                'status'       => '1',
            ],
            [
                'type_account' => '5',
                'username'     => 'username',
                'password'     => 'password',
                'url_image'    => 'url/image/',
                'price'        => '150000',
                'content'      => 'Trang Thong tin',
                'status'       => '1',
            ],
            [
                'type_account' => '1',
                'username'     => 'username',
                'password'     => 'password',
                'url_image'    => 'url/image/',
                'price'        => '150000',
                'content'      => 'Trang Thong tin',
                'status'       => '1',
            ],
            [
                'type_account' => '2',
                'username'     => 'username',
                'password'     => 'password',
                'url_image'    => 'url/image/',
                'price'        => '150000',
                'content'      => 'Trang Thong tin',
                'status'       => '1',
            ],
            [
                'type_account' => '3',
                'username'     => 'username',
                'password'     => 'password',
                'url_image'    => 'url/image/',
                'price'        => '150000',
                'content'      => 'Trang Thong tin',
                'status'       => '1',
            ],
            [
                'type_account' => '4',
                'username'     => 'username',
                'password'     => 'password',
                'url_image'    => 'url/image/',
                'price'        => '150000',
                'content'      => 'Trang Thong tin',
                'status'       => '1',
            ],
            [
                'type_account' => '5',
                'username'     => 'username',
                'password'     => 'password',
                'url_image'    => 'url/image/',
                'price'        => '150000',
                'content'      => 'Trang Thong tin',
                'status'       => '1',
            ]
            ]
        );
    }
}

// $table->bigIncrements('acc_id');
//             $table->string('type_account');
//             $table->string('username');
//             $table->string('password');
//             $table->string('url_image');
//             $table->float('price', 8, 2);
//             $table->string('content');
//             $table->Integer('status');
//             $table->timestamps();