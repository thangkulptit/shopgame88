<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'fullname' => 'ADMIN',
            'email'    => env('ADMIN_EMAIL', 'admin@gmail.com'),
            'password' => bcrypt(env('ADMIN_PASSWORD', 'admin@123')),
        ]);
    }
}
