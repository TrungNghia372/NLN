<?php 
define('TITLE', 'Liên Hệ');

include_once __DIR__ . '/../partials/header.php'; 
?>

<main>
<h1 class="container text-center"><hr>Liên Hệ<hr></h1>

<div class="container bg-color mt-3 rounded">
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="row">
                <div class="col-md m-3 pt-3 text-center bg-service">
                    <i class="fa-solid fa-map-location-dot icon fs-1"></i>
                    <h2>Địa chỉ</h2>
                    <p>Khu II, Đại học Cần Thơ</p>
                </div>


                <div class="col-md m-3 pt-3 text-center bg-service">
                    <i class="fa-solid fa-phone icon fs-1"></i>
                    <h2>Điện thoại</h2>
                    <p>0326 117 003</p>
                </div>
            </div>


            <div class="row">
                <div class="col-md m-3 pt-3 text-center bg-service">
                    <i class="fa-solid fa-envelope icon fs-1"></i>
                    <h2>Email</h2>
                    <p>cactustn372@gmail.com</p>
                </div>

                
                <div class="col-md m-3 pt-3 text-center bg-service">
                    <i class="fa-solid fa-clock icon fs-1"></i>
                    <h2>Giờ làm việc</h2>
                    <p>8h - 20h</p>
                </div>
            </div>
        </div>


        <div class="col-md-6 col-xs-12">
            <form name="lienhe" action="#" method="post" enctype="application/x-www-form-urlencoded">
                <h1 class="text-center mt-3">Góp ý</h1>
                <div class="forms text-center">
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" name="form-label "><b>Email</b></label>
                        <input required type="email" class="form-control" id="exampleFormControlInput1" placeholder="nghiab2005725@student.ctu.edu.vn">
                      </div>
                      <div class="mb-2">
                        <label for="exampleFormControlTextarea1" class="form-label"><b>Nội dung góp ý</b></label>
                        <textarea required class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                      </div>
                      <div class="mb-2"><input type="submit" class="btn btn-success" value="Gửi"></div>      
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <iframe class="mb-3" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.8415184086434!2d105.76842661397495!3d10.029933692830644!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0895a51d60719%3A0x9d76b0035f6d53d0!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBD4bqnbiBUaMah!5e0!3m2!1svi!2s!4v1669381459729!5m2!1svi!2s" width="allowfullscreen" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="mb-3"></div>
</div>
</main>


<?php include_once __DIR__ . '/../partials/footer.php'; ?>