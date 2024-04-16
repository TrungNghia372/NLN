<?php    while ($row_select_infor = $stmt_select_infor->fetch()) { ?>
<form action="infor.php?action=save&id=<?= $row_select_infor['customer_id'] ?>" method="POST">
        <div class="row">
            <div class="col-4 border text-center">
                <img class="rounded w-75 my-3" src="avatar/avatar1.png" alt="">
            </div>

            <div class="col-6 border pt-3">
                <div class="row mt-2">
                    <div class="col-2"><label  class="form-label mt-1"><b>Họ & tên:</b></label></div>
                    <div class="col-4">
                        <input name="name" class="form-control" value="<?= $row_select_infor['full_name'] ?>">
                    </div>

                    <div class="col-2"><label  class="form-label mt-1"><b>Giới tính:</b></label></div>
                    <div class="col-4">
                        <input name="gender" class="form-control" value="<?= $row_select_infor['gender'] ?>">
                    </div>
                </div>

                <div class="row mt-2">
                <div class="col-2"><label  class="form-label mt-1"><b>Sđt:</b></label></div>
                    <div class="col-4">
                        <input name="phone" class="form-control" value="<?= $row_select_infor['phone'] ?>">
                    </div>

                    <div class="col-2"><label  class="form-label mt-1"><b>Số CCCD:</b></label></div>
                    <div class="col-4">
                        <input name="national_id" class="form-control" value="<?= $row_select_infor['national_id'] ?>">
                    </div>
                </div>

                <div class="row mt-2">
                <div class="col-2"><label  class="form-label mt-1"><b>Ngày sinh:</b></label></div>
                    <div class="col-4">
                        <input name="date_of_birth" class="form-control" value="<?= $row_select_infor['date_of_birth'] ?>">
                    </div>
                </div>

                <div class="row mt-2">
                <div class="col-2"><label  class="form-label mt-1"><b>Email:</b></label></div>
                    <div class="col-6">
                        <input name="email" class="form-control" value="<?= $row_select_infor['email'] ?>">
                    </div>
                </div>

                <div class="row mt-2">
                <div class="col-2"><label  class="form-label mt-1"><b>Địa chỉ:</b></label></div>
                    <div class="col-6">
                        <input name="address" class="form-control" value="<?= $row_select_infor['address'] ?>">
                    </div>
                </div>
            </div>

            <div class="col-2 border text-center">
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-outline-success btn-block mt-3" id="editBtn">Lưu</button>
                        <a href="infor.php" class="btn btn-outline-success btn-block mt-3">Hủy</a>
                    </div>
                </div>
            </div>       
</form>

<?php } ?>
