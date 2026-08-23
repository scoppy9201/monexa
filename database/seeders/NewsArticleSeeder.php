<?php

declare(strict_types=1);

namespace Database\Seeders;

use FuteBus\Core\Models\NewsArticle;
use FuteBus\Core\Models\NewsCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsArticleSeeder extends Seeder
{
    public function run(): void
    {
        $categories = collect([
            ['name_vi' => 'FUTA Bus Lines', 'name_en' => 'FUTA Bus Lines', 'slug' => 'futa-bus-lines'],
            ['name_vi' => 'FUTA City Bus', 'name_en' => 'FUTA City Bus', 'slug' => 'futa-city-bus'],
            ['name_vi' => 'Khuyến mãi', 'name_en' => 'Promotions', 'slug' => 'khuyen-mai'],
            ['name_vi' => 'Giải thưởng', 'name_en' => 'Awards', 'slug' => 'giai-thuong'],
            ['name_vi' => 'Trạm dừng', 'name_en' => 'Rest stops', 'slug' => 'tram-dung'],
        ])->mapWithKeys(function (array $category, int $index) {
            $model = NewsCategory::updateOrCreate(
                ['slug' => $category['slug']],
                [...$category, 'sort_order' => $index + 1, 'is_active' => true],
            );

            return [$category['slug'] => $model->id];
        });

        $articles = [
            ['Trải nghiệm dịch vụ trung chuyển đón trả điểm tại TP.HCM từ ngày 26/03', 'futa-bus-lines', 'images/banners/home-banner.jpg'],
            ['Trung chuyển miễn phí từ Bến xe Miền Đông mới', 'futa-bus-lines', 'images/popular-routes/ho-chi-minh-city.png'],
            ['Văn phòng Ngô Gia Tự - Phan Rang cập nhật địa chỉ mới', 'futa-bus-lines', 'images/popular-routes/da-nang.png'],
            ['Văn phòng Phương Trang 486 - 486A Lê Văn Lương chính thức hoạt động', 'futa-bus-lines', 'images/about/futabus-fleet.png'],
            ['Cảnh báo tình trạng lừa đảo vé xe dịp lễ Quốc khánh', 'futa-bus-lines', 'images/service-quality/ticket-offices.png'],
            ['Đón diện mạo mới của xe buýt Bạc Liêu - hiện đại, êm ái', 'futa-city-bus', 'images/about/futa-city-bus-fleet.png'],
            ['5 tuyến xe buýt quen thuộc chính thức chuyển đổi diện mạo mới', 'futa-city-bus', 'images/futa-ecosystem/city-bus.png'],
            ['Đi xe buýt Phương Trang miễn phí trên 88 tuyến tại TP.HCM', 'futa-city-bus', 'images/popular-routes/ho-chi-minh-city.png'],
            ['Ưu đãi đặt vé trực tuyến dành cho khách hàng thành viên', 'khuyen-mai', 'images/faq/futa-app-topic.png'],
            ['Mua vé sớm - hành trình vui, nhận ngay ưu đãi hấp dẫn', 'khuyen-mai', 'images/about/futa-application.png'],
            ['FUTA Bus Lines được vinh danh thương hiệu vận tải uy tín', 'giai-thuong', 'images/service-quality/passengers.png'],
            ['Chất lượng là danh dự - hành trình phục vụ khách hàng', 'giai-thuong', 'images/service-quality/travel-illustration.png'],
            ['Trạm dừng Phúc Lộc nâng cấp không gian phục vụ', 'tram-dung', 'images/about/phuc-loc-rest-stop.png'],
            ['Khám phá tiện ích tại hệ thống trạm dừng FUTA', 'tram-dung', 'images/faq/customer-support.png'],
            ['Hướng dẫn đặt vé xe trực tuyến nhanh chóng và an toàn', 'futa-bus-lines', 'images/faq/futabus-topic.png'],
            ['Ứng dụng FUTA cập nhật trải nghiệm mua vé mới', 'futa-bus-lines', 'images/about/futa-application.png'],
            ['FUTA Express mở rộng mạng lưới giao nhận toàn quốc', 'futa-bus-lines', 'images/about/futa-express-delivery.png'],
            ['Kết nối hành trình xanh cùng FUTA Bus Lines', 'futa-city-bus', 'images/about/philosophy-sustainable-growth.png'],
        ];

        foreach ($articles as $index => [$title, $category, $image]) {
            NewsArticle::updateOrCreate(
                ['slug' => Str::slug($title)],
                [
                    'news_category_id' => $categories[$category],
                    'title'            => $title,
                    'summary'          => 'Cập nhật thông tin mới nhất từ FUTA Bus Lines, mang đến hành trình thuận tiện, an toàn và trải nghiệm tốt hơn cho khách hàng.',
                    'image'            => $image,
                    'status'           => 'published',
                    'is_featured'      => $index < 5,
                    'sort_order'       => $index + 1,
                    'published_at'     => now()->subDays($index),
                ],
            );
        }

        $images = collect($articles)->pluck(2)->values();

        foreach (range(1, 36) as $index) {
            $title = "Bản tin hành trình FUTA Bus Lines số {$index}";

            NewsArticle::updateOrCreate(
                ['slug' => "ban-tin-hanh-trinh-futa-{$index}"],
                [
                    'news_category_id' => $categories[$index % 3 === 0 ? 'khuyen-mai' : 'futa-bus-lines'],
                    'title'            => $title,
                    'summary'          => 'Những thông tin mới về lịch trình, dịch vụ và trải nghiệm dành cho hành khách trên toàn hệ thống FUTA Bus Lines.',
                    'image'            => $images[($index - 1) % $images->count()],
                    'status'           => 'published',
                    'is_featured'      => false,
                    'sort_order'       => count($articles) + $index,
                    'published_at'     => now()->subDays(count($articles) + $index),
                ],
            );
        }
    }
}
