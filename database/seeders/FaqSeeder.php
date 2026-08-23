<?php

declare(strict_types=1);

namespace Database\Seeders;

use FuteBus\Core\Models\FaqCategory;
use FuteBus\Core\Models\FaqQuestion;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'slug'        => 'futa-bus-lines',
                'name'        => ['vi' => 'FUTA Bus Lines', 'en' => 'FUTA Bus Lines'],
                'description' => [
                    'vi' => 'Khách hàng dễ dàng tìm kiếm các thông tin bao gồm: giá vé, hành trình, quy định...v.v.',
                    'en' => 'Quickly find information about fares, journeys, travel rules and more.',
                ],
                'image' => 'images/faq/futabus-topic.png',
            ],
            [
                'slug'        => 'futa-app',
                'name'        => ['vi' => 'FUTA App', 'en' => 'FUTA App'],
                'description' => [
                    'vi' => 'Khách hàng dễ dàng tìm kiếm thông tin về sử dụng App, thanh toán, khuyến mãi...v.v.',
                    'en' => 'Find information about using the app, payments, promotions and more.',
                ],
                'image' => 'images/faq/futa-app-topic.png',
            ],
            [
                'slug'        => 'trung-chuyen',
                'name'        => ['vi' => 'Trung chuyển', 'en' => 'Transfer Service'],
                'description' => [
                    'vi' => 'Cập nhật các thông tin về quy định trung chuyển cụ thể.',
                    'en' => 'See the latest detailed information and rules for transfer services.',
                ],
                'image' => 'images/faq/transfer-service-topic.png',
            ],
        ];

        foreach ($categories as $index => $data) {
            FaqCategory::updateOrCreate(
                ['slug' => $data['slug']],
                [...$data, 'is_active' => true, 'sort_order' => $index + 1],
            );
        }

        $category = FaqCategory::where('slug', 'futa-bus-lines')->firstOrFail();

        foreach ($this->futabusQuestions() as $index => $item) {
            FaqQuestion::updateOrCreate(
                [
                    'faq_category_id' => $category->id,
                    'sort_order'      => $index + 1,
                ],
                [
                    'question'  => ['vi' => $item[0], 'en' => $item[2]],
                    'answer'    => ['vi' => $item[1], 'en' => $item[3]],
                    'is_active' => true,
                ],
            );
        }

        $appCategory = FaqCategory::where('slug', 'futa-app')->firstOrFail();

        foreach ($this->futaAppQuestions() as $index => $item) {
            FaqQuestion::updateOrCreate(
                [
                    'faq_category_id' => $appCategory->id,
                    'sort_order'      => $index + 1,
                ],
                [
                    'question'  => ['vi' => $item[0], 'en' => $item[2]],
                    'answer'    => ['vi' => $item[1], 'en' => $item[3]],
                    'is_active' => true,
                ],
            );
        }

        $transferCategory = FaqCategory::where('slug', 'trung-chuyen')->firstOrFail();

        foreach ($this->transferQuestions() as $index => $item) {
            FaqQuestion::updateOrCreate(
                [
                    'faq_category_id' => $transferCategory->id,
                    'sort_order'      => $index + 1,
                ],
                [
                    'question'  => ['vi' => $item[0], 'en' => $item[2]],
                    'answer'    => ['vi' => $item[1], 'en' => $item[3]],
                    'is_active' => true,
                ],
            );
        }
    }

    private function futabusQuestions(): array
    {
        return [
            [
                'Khách hàng có thể biết khi chuyến xe đã mua có sự thay đổi như thế nào?',
                ['Công ty sẽ chủ động liên hệ để thông báo thay đổi chuyến đi và hướng giải quyết thỏa đáng trong thời gian nhanh nhất có thể.'],
                'How will I know if my booked trip changes?',
                ['We will proactively contact you about trip changes and provide the quickest appropriate solution.'],
            ],
            [
                'Chính sách mua vé dành cho trẻ em như thế nào?',
                ['Trẻ em từ 6 tuổi trở lên mua vé tương đương giá vé người lớn.', 'Trẻ em dưới 6 tuổi, cao dưới 1,3 m và nặng dưới 30 kg có thể đi kèm người lớn; mỗi người lớn chỉ kèm một trẻ.'],
                'What is the ticket policy for children?',
                ['Children aged six and over require an adult ticket.', 'One eligible child under six may accompany each adult.'],
            ],
            [
                'Tôi có thể mua vé của FUTA Bus Lines bằng các hình thức nào?',
                ['Mua trực tiếp tại văn phòng vé Phương Trang.', 'Mua trên website, FUTA App hoặc ứng dụng liên kết.', 'Giữ chỗ qua Tổng đài và thanh toán trực tuyến bằng QR code.'],
                'How can I buy FUTA Bus Lines tickets?',
                ['Buy at a ticket office, on the website or an approved app, or reserve through the call centre.'],
            ],
            [
                'Mua vé online có thể thanh toán bằng hình thức nào?',
                ['Thanh toán bằng VISA/Mastercard, thẻ ATM nội địa có Internet Banking, ví MoMo, ZaloPay, ShopeePay, VNPAY hoặc FUTA Pay.'],
                'Which payment methods are available online?',
                ['VISA, Mastercard, eligible domestic ATM cards and supported electronic wallets are accepted.'],
            ],
            [
                'Khách hàng thường xuyên có được ưu đãi không?',
                ['Công ty thường có ưu đãi qua các ứng dụng liên kết. Thông tin khuyến mãi được cập nhật tại website và fanpage của Công ty.'],
                'Are frequent travellers eligible for promotions?',
                ['Partner-app promotions are offered regularly and announced on our website and fanpage.'],
            ],
            [
                'Mua vé qua website/app có được chọn vị trí chỗ ngồi không?',
                ['Anh/Chị có thể chủ động lựa chọn vị trí chỗ ngồi khi mua vé qua website hoặc ứng dụng.'],
                'Can I select a seat on the website or app?',
                ['Yes. You can select an available seat during online booking.'],
            ],
            [
                'Có thể chọn chỗ ngồi qua các hình thức mua vé khác không?',
                ['Có thể yêu cầu vị trí khi giữ chỗ qua hotline 1900 6067 hoặc mua trực tiếp tại văn phòng vé.'],
                'Can I select a seat through other sales channels?',
                ['Request a seat through 1900 6067 or at an official ticket office.'],
            ],
            [
                'Làm sao kiểm tra lại thông tin chuyến đi đã mua?',
                ['Kiểm tra SMS hoặc email nếu đặt trên website.', 'Kiểm tra Lịch sử mua vé trong FUTA App.', 'Vé qua ứng dụng liên kết hiển thị ngay trong ứng dụng.', 'Vé qua tổng đài được xác nhận bằng Zalo FUTA Bus Lines.'],
                'How can I review my booking?',
                ['Check the confirmation SMS, email, app booking history or the Zalo confirmation sent by FUTA.'],
            ],
            [
                'Đặt vé qua Trung tâm Tổng đài có thể thanh toán thế nào?',
                ['Thanh toán tiền mặt tại văn phòng vé hoặc thanh toán trực tuyến qua QR code được gửi về Zalo cá nhân.'],
                'How can I pay for a call-centre booking?',
                ['Pay at a ticket office or use the QR payment link sent to your Zalo account.'],
            ],
            [
                'Đã thanh toán online nhưng chưa nhận được xác nhận thì làm gì?',
                ['Vui lòng liên hệ ngay Tổng đài 1900 6067 gặp Bộ phận Online hoặc nhắn tin với nhân viên chăm sóc khách hàng trên website.'],
                'What if payment succeeds but no confirmation arrives?',
                ['Call 1900 6067 and ask for Online Support, or contact customer support through the website.'],
            ],
            [
                'Tôi có thể mua vé chiều đi lẫn chiều về trên website không?',
                ['Anh/Chị có thể chủ động mua vé một chiều hoặc khứ hồi ngay trên website.'],
                'Can I buy a return ticket on the website?',
                ['Yes. Both one-way and return bookings are supported.'],
            ],
            [
                'Giá vé hiển thị trên website/app đã bao gồm những phí gì?',
                ['Giá vé đã bao gồm thuế VAT, phí bảo hiểm du lịch và không phát sinh thêm phụ phí.'],
                'What fees are included in the displayed fare?',
                ['The fare includes VAT and travel insurance with no additional service surcharge.'],
            ],
            [
                'Có phụ phí nào ngoài giá vé hiển thị không?',
                ['Không có phụ phí ngoài tổng giá vé hiển thị, trừ phí hàng hóa khi hành lý vượt quá 20 kg.'],
                'Are there charges beyond the displayed fare?',
                ['No, except applicable cargo charges when baggage exceeds 20 kg.'],
            ],
            [
                'Giá vé dịp Lễ, Tết thay đổi như thế nào?',
                ['Giá vé dịp Lễ, Tết thay đổi theo quy định của cơ quan quản lý có thẩm quyền.'],
                'How do fares change during holidays?',
                ['Holiday fares are adjusted in accordance with regulations issued by the competent authorities.'],
            ],
            [
                'Dịch vụ đi kèm trên xe gồm những gì?',
                ['Dịch vụ miễn phí gồm khăn, nước, dép trên xe giường nằm, mền, Wi-Fi và tivi trên xe limousine phù hợp.', 'Dịch vụ trung chuyển được áp dụng trong khu vực cho phép của từng văn phòng.'],
                'Which onboard services are included?',
                ['Complimentary amenities may include water, towels, blankets, Wi-Fi and eligible transfer services.'],
            ],
            [
                'Trong trường hợp cần hủy vé, tôi phải làm gì?',
                [
                    'Vé giấy hoặc vé mua tại văn phòng cần mang đầy đủ liên vé đến quầy.',
                    'Vé online cần mã vé và giấy tờ tùy thân trùng tên vé.',
                    'Thời hạn và phí hủy phụ thuộc số lượng vé và thời điểm trước giờ khởi hành.',
                    'Vé mua trên FUTA App có thể hủy trong mục Lịch sử nếu đáp ứng điều kiện.',
                ],
                'How do I cancel a ticket?',
                ['Cancellation method, deadline and fee depend on the purchase channel, ticket quantity and departure time.'],
            ],
            [
                'Tôi vô tình xóa thông tin xác nhận vé thì phải làm gì?',
                ['Vui lòng liên hệ Tổng đài 1900 6067 và gặp Bộ phận Online để được hỗ trợ.'],
                'What if I delete my ticket confirmation?',
                ['Call 1900 6067 and ask for Online Support.'],
            ],
            [
                'Tôi đến bến xe hoặc văn phòng trễ giờ thì có được chuyển chuyến không?',
                ['Vé đã thanh toán: liên hệ nhân viên tại bến xe hoặc văn phòng để được hướng dẫn.', 'Vé chưa thanh toán: có thể đăng ký chuyến tiếp theo tùy tình trạng chỗ.'],
                'What happens if I arrive late?',
                ['Ask station staff for assistance with paid tickets; unpaid reservations may be rebooked subject to availability.'],
            ],
            [
                'Danh sách phòng vé trực thuộc FUTA Bus Lines ở đâu?',
                ['Anh/Chị có thể tham khảo tại mục “Mạng lưới văn phòng” trên website.'],
                'Where can I find FUTA ticket offices?',
                ['See the Office Network section on the website.'],
            ],
            [
                'Mua vé online nhưng nhập sai thông tin hoặc nhầm ngày thì làm gì?',
                ['Liên hệ Tổng đài 1900 6067 gặp Bộ phận Online. Vé đã thanh toán được hỗ trợ đổi một lần nếu cùng tuyến, cùng giá và chuyến mới còn chỗ.'],
                'What if my online booking details or date are wrong?',
                ['Call 1900 6067. An eligible paid ticket may be changed once, subject to route, fare and seat availability.'],
            ],
            [
                'Tôi có thể mang thú cưng trên xe không?',
                ['Theo quy định, FUTA Bus Lines không nhận vận chuyển động vật sống hoặc thú cưng trên xe.'],
                'Can I bring a pet on board?',
                ['Live animals and pets are not accepted on FUTA Bus Lines coaches.'],
            ],
            [
                'Tôi có thể hút thuốc hoặc ăn thực phẩm nặng mùi trên xe không?',
                ['Để đảm bảo sức khỏe và vệ sinh chung, vui lòng không hút thuốc hoặc sử dụng thực phẩm nặng mùi trên xe.'],
                'Can I smoke or eat strong-smelling food on board?',
                ['No. Smoking and strong-smelling food are prohibited for health and cleanliness.'],
            ],
        ];
    }

    private function futaAppQuestions(): array
    {
        return [
            [
                'APP FUTA được dùng với mục đích gì?',
                [
                    'APP FUTA hỗ trợ khách hàng mua vé xe mọi lúc, mọi nơi với nhiều phương thức thanh toán tiện lợi.',
                    'Người dùng có thể quản lý lịch sử mua vé trên ứng dụng, kiểm tra lịch trình xe chạy, vị trí '
                        .'giường, giá vé và cập nhật các chương trình khuyến mãi của Công ty.',
                ],
                'What is the FUTA App used for?',
                [
                    'The FUTA App lets customers buy coach tickets anywhere, at any time, with convenient payment methods.',
                    'Users can manage booking history, check schedules, seats, fares and current promotions.',
                ],
            ],
            [
                'Tôi đặt vé trên App FUTA có được hủy và hoàn tiền không?',
                [
                    'Nếu vé mua trên FUTA App chưa được đổi thành vé giấy, vào mục “Lịch sử”, chọn vé và bấm “Hủy”.',
                    'Hủy trên ứng dụng sẽ hủy tất cả vé cùng một mã vé và không thể tách riêng.',
                    'Từ 1 đến 3 vé phải hủy trước giờ khởi hành ít nhất 24 giờ; phí hủy vé ngày thường là 10%.',
                    'Tiền được hoàn về tài khoản thanh toán ban đầu trong 7–15 ngày, tùy thời gian xử lý của ngân hàng.',
                    'Không hỗ trợ hủy những vé đã có sự thay đổi trước đó.',
                ],
                'Can FUTA App tickets be cancelled and refunded?',
                [
                    'If the ticket has not been exchanged for a paper ticket, open History, select it and tap Cancel.',
                    'All tickets under the same booking code are cancelled together and cannot be separated.',
                    'For one to three tickets, cancel at least 24 hours before departure. A 10% fee applies to regular-day tickets.',
                    'Refunds return to the original payment account in 7–15 days. Previously changed tickets cannot be cancelled.',
                ],
            ],
            [
                'Tại sao tiền trong Ví FUTA không thể rút về tài khoản?',
                [
                    'FUTAPay hiện hỗ trợ cùng Ngân hàng SHB. Tiền có thể được rút về tài khoản nếu nguồn tiền nạp '
                        .'trước đó xuất phát từ thẻ hoặc tài khoản SHB của chính khách hàng.',
                    'Nếu không sử dụng SHB, số dư hiện chỉ có thể dùng để mua vé trên FUTA App. Công ty đang ghi '
                        .'nhận nhu cầu để mở rộng hỗ trợ thêm ngân hàng.',
                    'Vui lòng liên hệ Tổng đài 1900 6067 và gặp Bộ phận Online để được tư vấn chi tiết.',
                ],
                'Why can I not withdraw my FUTA Wallet balance?',
                [
                    'FUTAPay currently supports withdrawals for funds originally added from the customer’s own SHB account or card.',
                    'Balances funded through other banks can currently be used for FUTA App ticket purchases only.',
                    'Call 1900 6067 and ask for Online Support for more details.',
                ],
            ],
        ];
    }

    private function transferQuestions(): array
    {
        return [
            [
                'Dịch vụ trung chuyển được áp dụng tại khu vực nào?',
                [
                    'Dịch vụ trung chuyển hiện được áp dụng tại các tỉnh, thành có văn phòng vé Phương Trang hỗ trợ dịch vụ này.',
                    'Anh/Chị có thể liên hệ Trung tâm Tổng đài 1900 6067 để được tư vấn thêm.',
                ],
                'Where is the transfer service available?',
                [
                    'Transfer service is available in provinces and cities where eligible Phuong Trang ticket offices operate.',
                    'Call 1900 6067 for details.',
                ],
            ],
            [
                'Thông tin về dịch vụ trung chuyển tận nơi tại TPHCM là gì?',
                [
                    'Phương Trang hỗ trợ trung chuyển tận nơi tại TPHCM cho các tuyến đi Đà Lạt, Nha Trang, '
                        .'Phan Thiết/Mũi Né, Phan Rang, Buôn Ma Thuột, Tây Ninh và các tỉnh miền Trung. Các tuyến '
                        .'miền Tây hiện chưa được hỗ trợ.',
                    'Đăng ký trước ít nhất 04 giờ so với giờ khởi hành; phạm vi trung chuyển từ 5 đến 7,5 km tại '
                        .'những điểm thuận tiện.',
                    'Các tuyến xuất bến tại Bến xe Miền Đông mới được hỗ trợ tại các quận nội ô TPHCM và phải '
                        .'đăng ký trước ít nhất 24 giờ.',
                    'Vui lòng liên hệ Tổng đài Trung chuyển 1900 6918 để được hỗ trợ.',
                ],
                'How does door-to-door transfer service work in Ho Chi Minh City?',
                [
                    'Service is available for selected routes to Da Lat, Nha Trang, Phan Thiet, Phan Rang, Buon Ma Thuot, Tay Ninh and central provinces.',
                    'Register at least four hours before departure. New Eastern Bus Station routes require 24-hour advance registration.',
                    'Call 1900 6918 for assistance.',
                ],
            ],
            [
                'Dịch vụ trung chuyển có mất phí không?',
                ['Dịch vụ trung chuyển là dịch vụ miễn phí đi kèm dành cho khách hàng.'],
                'Is there a fee for the transfer service?',
                ['Transfer service is a complimentary service for eligible passengers.'],
            ],
            [
                'Đăng ký trung chuyển cho chuyến xuất bến tại Bến xe Miền Đông mới như thế nào?',
                [
                    'Nếu có nhu cầu trung chuyển trong nội ô TPHCM, vui lòng liên hệ Tổng đài Trung chuyển '
                        .'1900 6918 để cập nhật điểm đón trước giờ khởi hành ít nhất 24 giờ.',
                ],
                'How do I request transfer service for a New Eastern Bus Station departure?',
                ['Call 1900 6918 to register an eligible inner-city pick-up point at least 24 hours before departure.'],
            ],
            [
                'Tại sao xe trung chuyển đón sớm hơn nhiều so với giờ xe tuyến khởi hành?',
                [
                    'Đây là dịch vụ trung chuyển công cộng kết hợp với các hãng xe tại Bến xe. Anh/Chị cần chuẩn '
                        .'bị hành lý trước 3–4 giờ; tài xế sẽ liên hệ để thông báo thời gian đón cụ thể.',
                ],
                'Why is transfer pick-up much earlier than the coach departure?',
                ['The shared transfer service coordinates multiple operators. Be ready three to four hours early; the driver will confirm the pick-up time.'],
            ],
            [
                'Tôi để quên vật dụng cá nhân trên xe trung chuyển thì phải làm gì?',
                ['Vui lòng liên hệ 1900 6667 và gặp Bộ phận Chăm sóc Khách hàng để được hỗ trợ.'],
                'What should I do if I leave an item on a transfer vehicle?',
                ['Call 1900 6667 and ask for Customer Care.'],
            ],
            [
                'Tôi có được liên hệ để cập nhật điểm đón trung chuyển không?',
                [
                    'Nhân viên tại tỉnh, thành sẽ liên hệ để tư vấn điểm đón. Tuy nhiên, Anh/Chị nên chủ động '
                        .'liên hệ văn phòng vé trực thuộc để cung cấp điểm đón và tránh trường hợp không thể liên lạc.',
                ],
                'Can I contact FUTA to update my transfer pick-up point?',
                ['Yes. Contact the relevant ticket office proactively so the pick-up point can be confirmed reliably.'],
            ],
            [
                'Cần liên hệ trước bao lâu để cập nhật điểm đón hoặc điểm trung chuyển?',
                [
                    'Tại TPHCM, các tuyến từ Bến xe Miền Tây hoặc Bến xe An Sương cần đăng ký trước ít nhất 04 '
                        .'giờ; phạm vi trung chuyển từ 5 đến 7,5 km tùy địa điểm.',
                    'Các tuyến từ Bến xe Miền Đông mới cần đăng ký trước ít nhất 24 giờ; phạm vi tùy địa điểm và '
                        .'không gồm khu vực Nhà Bè, Cần Giờ.',
                    'Liên hệ 1900 6067 hoặc 1900 6918 để được hỗ trợ tại TPHCM.',
                    'Tại các tỉnh, thành có hỗ trợ trung chuyển, đăng ký trước ít nhất 04 giờ; phạm vi thông thường '
                        .'từ 8 đến 10 km tùy địa điểm. Liên hệ 1900 6067 hoặc văn phòng vé trực thuộc.',
                ],
                'How early should I update a transfer pick-up point?',
                [
                    'Most eligible services require four-hour advance registration. New Eastern Bus Station services require 24 hours.',
                    'Call 1900 6067, 1900 6918 or the relevant ticket office for the exact service area.',
                ],
            ],
            [
                'Gần đến giờ xuất bến nhưng tôi vẫn chưa được đón thì phải làm gì?',
                [
                    'Do đặc thù dịch vụ trung chuyển công cộng, Anh/Chị cần chuẩn bị hành lý trước 3–4 giờ so '
                        .'với giờ khởi hành. Trong khoảng thời gian này, tài xế sẽ liên hệ thông báo giờ đón cụ thể.',
                ],
                'What should I do if pick-up has not occurred close to departure?',
                ['Be ready three to four hours before departure. The transfer driver will contact you with the specific pick-up time.'],
            ],
        ];
    }
}
