<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Notification;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $popup = Notification::where('is_active', true)->first();
            $view->with('popup', $popup);
        });

$listName = [
    "Nguyễn Hoài Nam", "Trần Hải Vippro", "Lê Quý Đôn", "Phạm Quốc Trường", "Ngô Hiệp Phát",
    "Đỗ Mạnh Quân", "Nguyễn Thái Phong", "Vũ Hoàng Sơn", "Trần Trường Sơn", "Lê Thanh Sơn",
    "Ngô Ngọc Sơn", "Bùi Tùng Pro", "Trịnh Bá Tùng", "Phạm Sơn Vip", "Đinh Anh Yêu Em",
    "Trần Minh Hiếu", "Phạm Xuân Tuấn", "Nguyễn Đình Trung", "Mai Khánh Hoa", "Lê Hoài Trung",
    "Vũ Cường Thịnh", "Phạm Gia Huy", "Nguyễn Minh Đạt", "Lê Hùng Thịnh", "Ngô Duy Thiên",
    "Trần Hải Long", "Phạm Kỳ Thiên", "Lê Yêu Lần Đầu", "Nguyễn Hạo Thiên", "Bùi Bạn Của Tớ",
    "Đỗ Anh Hạnh", "Trần Công Thành", "Mai Khánh Đạt", "Nguyễn Gia Linh", "Lê Thanh Mai",
    "Vũ Tuệ Mẫn", "Phạm Kim Oanh", "Nguyễn Tú Uyên", "Đinh Chan VCL", "Lê Diễm Phương",
    "Trần Kim Liên", "Phạm Bảo Quyên", "Nguyễn Diễm My", "Lê Tuệ Nhi", "Trần Thục Quyên",
    "Vũ Kim Ánh", "Phạm Kim Tiền", "Lê Ca", "Nguyễn Thảo Ly", "Phạm Nguyệt Cát",
    "Trần Quỳnh Chi", "Nguyễn Thu Trang", "Lê Thu Hiền", "Phạm Thu Thảo", "Đinh Lan Anh",
    "Nguyễn Lan Chi", "Phạm Ngọc Hoa", "Trần Bảo Ngọc", "Lê Bảo Kim", "Nguyễn Đoan Trang",
    "Vũ Thanh Trúc", "Trần Tuyết Vy", "Lê Tường Vi", "Phạm Kim Ngân", "Nguyễn Thanh Trúc",
    "Trần Thanh Thủy", "Phạm Quỳnh Chi", "Lê Quỳnh Hương", "Nguyễn Cát Tường", "Trịnh Minh Tuấn",
    "Phạm Đức Anh", "Nguyễn Bảo Long", "Vũ Trọng Nghĩa", "Lê Anh Tú", "Nguyễn Quốc Khánh",
    "Đặng Thanh Hải", "Phan Như Quỳnh", "Trần Đức Minh", "Nguyễn Trung Kiên", "Vũ Văn Hòa",
    "Phạm Khánh Linh", "Nguyễn Quốc Bảo", "Lê Anh Dũng", "Trần Hữu Tài", "Nguyễn Tấn Phát",
    "Đinh Gia Bảo", "Vũ Quốc Cường", "Nguyễn Khánh Huyền", "Lê Thái Dương", "Phạm Đức Thiện",
    "Trần Gia Hân", "Nguyễn Minh Khang", "Lê Hải Đăng", "Vũ Nhật Hào", "Nguyễn Minh Quân",
    "Phạm Tuấn Anh", "Trần Huy Hoàng", "Lê Ngọc Bích", "Nguyễn Hải Yến", "Vũ Khánh Vy",
    "Nguyễn Thùy Dương", "Lê Như Ngọc", "Phạm Ngọc Trâm", "Nguyễn Nhật Minh", "Trần Ái Nhi"
];
        $price = ['150,000', '230,000', '350,000', '180,000đ','450,000','320,000','260,000','245,000', '160,000','220,000'];
        $dateTime = Date('H');
        $phut = Date('i');
        $rd = rand(0, 15);
        if ($dateTime >= 7 && $dateTime <= 11) {
            $listName = array_slice($listName, 0);
        } else if ($dateTime >= 12 && $dateTime <= 15) {
            $listName = array_slice($listName, 9); 
        } else if ($dateTime >= 16 && $dateTime <= 19) {
            $listName = array_slice($listName, 19); 
        } else if ($dateTime >= 20 && $dateTime <= 22) {
            $listName = array_slice($listName, 22); 
        } else if ($dateTime >= 20 && $dateTime <= 22) {
            $listName = array_slice($listName, 30); 
        } else if ($dateTime >= 23) {
            $listName = array_slice($listName, 38); 
        } else {
            $listName = array_slice($listName, 50); 
        }
        $date = Date('d/m/Y');
        View::share('listName', $listName);
        View::share('date', $date);
        View::share('price', $price);
        View::share('phut', $phut);
        View::share('rd', $rd);

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
        
        $global_list = [
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
        View::share('global_list', $global_list);

        Schema::defaultStringLength(191);
    }

    private function getList() {
       
    }
}
