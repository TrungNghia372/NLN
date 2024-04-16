<?php
    define('TITLE', 'Thông Tin');

    include_once __DIR__ . '/../partials/header.php';

    require_once __DIR__ . '/../partials/db_connect.php';

    include_once __DIR__ . '/../other/customer_id.php';
?>

<div class="container">
    <h1 class="text-center"><hr>Thông Tin<hr></h1>

    <?php 
    include_once __DIR__ . '/../other/edit_infor.php';
    include_once __DIR__ . '/../other/add_infor.php';
    if (isset($_GET['action']) && $_GET['action'] == 'edit_infor') {
        include_once __DIR__ . '/../other/infor_edit_form.php';
    } else if (isset($_GET['action']) && $_GET['action'] == 'add_infor') {
        include_once __DIR__ . '/../other/infor_add_form.php';
    } else {
        $select_infor = "SELECT * FROM customerInfor WHERE `customer_id` = :id";
        $stmt_select_infor = $pdo->prepare($select_infor);
        $stmt_select_infor->execute([':id' => $customer_id]);

        // Nếu id của khách hàng chưa có trong cơ sở dữ liệu thì sẽ hiển thị ra form trống
        if ($stmt_select_infor->rowCount()==0) {
    ?>
        <div class="row">
            <div class="col-4 border text-center">
                <img class="rounded w-75 my-3" src="avatar/avatar1.png" alt="">
            </div>

            <div class="col-6 border pt-3">
                <div class="row mt-2">
                    <div class="col-6">
                        <p><b>Họ & tên:</b>  </p>
                    </div>
                    <div class="col-6">
                        <p><b>Giới tính:</b>  </p>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-6">
                        <p><b>Số điện thoại:</b>  </p>
                    </div>
                    <div class="col-6">
                        <p><b>Số CCCD:</b>  </p>
                    </div>
                </div>

                <div class="row mt-2">
                    <p><b>Ngày sinh:</b>  </p>
                </div>

                <div class="row mt-2">
                    <p><b>Email:</b>  </p>
                </div>

                <div class="row mt-2">
                    <p><b>Địa chỉ:</b>  </p>
                </div>
            </div>

            <div class="col-2 border text-center">
                <a href="infor.php?action=add_infor" type="button" class="btn btn-outline-success mt-3">Thêm thông tin</a>
                <!-- <a href="infor.php?action=edit_infor" type="button" class="btn btn-outline-success mt-3">Chỉnh sửa thông tin</a> -->
                <a href="infor.php?action=pass" type="button" class="btn btn-outline-success mt-3">Đổi mật khẩu</a>
                <a href="order.php" type="button" class="btn btn-outline-success mt-3">Đơn hàng</a>
            </div>
        </div>
    <?php
        } else {
        // Ngược lại nếu có thì sẽ hiển thị ra thông tin của khách hàng
        while ($row_select_infor = $stmt_select_infor->fetch()) {
    ?>

        <div class="row">
            <div class="col-4 border text-center">
                <img class="rounded w-75 my-3" src="avatar/avatar1.png" alt="">
            </div>

            <div class="col-6 border pt-3">
                <div class="row mt-2">
                    <div class="col-6">
                        <p><b>Họ & tên:</b> <?= $row_select_infor['full_name'] ?></p>
                    </div>
                    <div class="col-6">
                        <p><b>Giới tính:</b> <?= $row_select_infor['gender'] ?> </p>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-6">
                        <p><b>Số điện thoại:</b> <?= $row_select_infor['phone'] ?></p>
                    </div>
                    <div class="col-6">
                        <p><b>Số CCCD:</b> <?= $row_select_infor['national_id'] ?> </p>
                    </div>
                </div>

                <div class="row mt-2">
                    <p><b>Ngày sinh:</b> <?= $row_select_infor['date_of_birth'] ?> </p>
                </div>

                <div class="row mt-2">
                    <p><b>Email:</b> <?= $row_select_infor['email'] ?> </p>
                </div>

                <div class="row mt-2">
                    <p><b>Địa chỉ:</b> <?= $row_select_infor['address'] ?> </p>
                </div>
            </div>

            <div class="col-2 border text-center">
                <!-- <a href="infor.php?action=add_infor" type="button" class="btn btn-outline-success mt-3">Thêm thông tin</a> -->
                <a href="infor.php?action=edit_infor" type="button" class="btn btn-outline-success mt-3">Chỉnh sửa thông tin</a>
                <a href="infor.php?action=pass" type="button" class="btn btn-outline-success mt-3">Đổi mật khẩu</a>
                <a href="order.php" type="button" class="btn btn-outline-success mt-3">Đơn hàng</a>
            </div>
            <?php }}} ?>
        </div>
        
</div>

<?php
    include_once __DIR__ . '/../partials/footer.php';
?>