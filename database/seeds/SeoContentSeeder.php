<?php

use Illuminate\Database\Seeder;

class SeoContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seo_content')->insert(
            [
                [
                    'title'=>'Shop Liên Quân - Mua Bán Acc Liên Quân Giá Rẻ, Uy Tín Hàng Đầu Vn',
                    'description' => 'Shop liên quân, nơi mua bán acc liên quân giá rẻ uy tín hàng đầu việt nam, acc liên quân cực vip chỉ có 20k, 30k, 40k, 50k',
                    'keywords' => 'shop liên quân, mua acc liên quân, mua nick liên quân, bán acc lq, shop lq, acc lien quan gia re',
                    'domain' => 'lienquanshop.com',
                    'content_seo' => 'dsiaojdsioadjioasjidosajiosdaiod jsaio jio Shop liên quân giá rẻ uy tín hàng đầu việt nam',
                    'title_h2' => 'Tiêu đề h2 1| Tiêu đề H2 2',
                    'title_h3' => 'Tiêu đề h3 1| Tiêu đề H3 2 | Tiêu đề H3 3' 
                ],
            ]
    );
    }
}
