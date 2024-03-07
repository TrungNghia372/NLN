<?php
define('TITLE', 'Giới Thiệu');
include_once __DIR__ . '/../partials/header.php';

require_once __DIR__ . '/../partials/db_connect.php';

echo '<div class="container">
    <h1 class="text-center"><hr>Giới Thiệu<hr></h1>

    <div class="row">
        <div class="col-lg-8 col-xs-12 justify">
            <p>
                Chào mừng bạn đến với <b>CactusTN</b>. <br> <br>
                Nơi mà bạn có thể khám phá và chọn lựa những loại cây mọng nước độc đáo 
                và đẹp mắt để tạo điểm nhấn cho không gian sống của mình.
            </p>

            <p>
                Trang web của chúng tôi được thiết kế đẹp mắt và dễ sử dụng, 
                tạo cảm giác thân thiện và thuận tiện cho việc mua sắm trực tuyến. 
                Ngay từ trang chủ, bạn sẽ bị cuốn hút bởi những hình ảnh tuyệt đẹp 
                của cây xương rồng và sen đá, với những dáng vẻ độc đáo và màu sắc tươi sáng.
            </p>

            <p>
                Chúng tôi tự hào mang đến cho bạn một bộ sưu tập đa dạng với nhiều loại 
                cây xương rồng và sen đá khác nhau. Bạn có thể dễ dàng tìm kiếm và lựa chọn cây theo 
                kích thước, màu sắc, hình dạng và kiểu dáng. Mỗi loại cây đều được mô tả chi tiết, 
                cung cấp thông tin về cách chăm sóc, yêu cầu ánh sáng và nước, giúp bạn chọn cây phù hợp 
                với điều kiện và phong cách của không gian sống của mình.
            </p>

            <p>
                Ngoài ra, chúng tôi cung cấp các sản phẩm đi kèm như chậu và phụ kiện trang trí, 
                giúp bạn hoàn thiện không gian cây trồng của mình một cách tinh tế và ấn tượng. 
                Chúng tôi cam kết mang đến cho bạn những sản phẩm chất lượng cao, cây xương rồng 
                và sen đá được chọn lọc kỹ càng và chăm sóc cẩn thận để đảm bảo sức khỏe và sự phát 
                triển của cây.
            </p>

            <p>
                Chúng tôi hiểu rằng cây xương rồng và sen đá không chỉ là những cây trang trí đẹp mắt, 
                mà còn mang ý nghĩa phong thủy và tinh thần. Vì vậy, chúng tôi luôn sẵn lòng hỗ trợ bạn 
                với các thông tin và tư vấn về ý nghĩa của từng loại cây, cũng như cách chăm sóc và tận 
                hưởng sự tươi mới mà chúng mang lại.
            </p>

            <p>
                Hãy ghé thăm trang web của chúng tôi ngay bây giờ và khám phá bộ sưu tập độc đáo của 
                cây xương rồng và sen đá. Chắc chắn bạn sẽ tìm thấy những cây yêu thích và tạo nên 
                điểm nhấn đặc biệt cho không gian sống của mình.
            </p>
        </div>

        <div class="col-lg-4 col-xs-12 text-center">
            <img class="w-100" src="img/introduce.jpg" alt="">
        </div>
    </div>
</div>';

include_once __DIR__ . '/../partials/footer.php';