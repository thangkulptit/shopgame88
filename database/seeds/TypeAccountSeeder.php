<?php

use Illuminate\Database\Seeder;

class TypeAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_accounts')->insert(
            [
                [
                    'name'=>'Đột kích'
                ],
            ]
    );
    }
}
