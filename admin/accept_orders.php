<?php

require_once __DIR__ . '/../partials/db_connect.php';

if (isset($_GET['action']) && $_GET['action'] == 'accept' && isset($_GET['status'])) {
    $pay = "";
    $status = $_GET['status'];    

    $item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:10;
    $current_page = !empty($_GET['page'])?$_GET['page']:1;
    $offset = ($current_page - 1) * $item_per_page;
    
    $num = $offset + 1;
    
    // Xác nhận đơn hàng
    $select_orders = "SELECT * FROM `orders` WHERE `status` = :status LIMIT :limit OFFSET :offset";
    $stmt_select_orders = $pdo->prepare($select_orders);
    $stmt_select_orders->bindValue(':status', $status, PDO::PARAM_STR);
    $stmt_select_orders->bindValue(':limit', $item_per_page, PDO::PARAM_INT);
    $stmt_select_orders->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt_select_orders->execute();   

    
?>

<?php if ($status == 1) { ?>
    <h4 class="text-center">ĐƠN HÀNG ĐÃ XÁC NHẬN<hr></h4>
<?php } else if ($status == 0) { ?>
    <h4 class="text-center">ĐƠN HÀNG CHƯA XÁC NHẬN<hr></h4>
<?php } ?>

    <table class="table table-bordered text-center">
            <tr>
                <th class="col-1">STT</th>
                <th class="col-2">Khách hàng</th>
                <th class="col-1">Tổng tiền</th>
                <th class="col-1">Thời gian</th>
                <th class="col-1">Thanh toán</th>
                <th class="col-1">Chi tiết</th>
                <th class="col-1">Xác nhận</th>
                <!-- <th class="col-1">Hủy</th> -->
            </tr>

        <?php
            while ($row_select_orders = $stmt_select_orders->fetch()) { 
                if ($row_select_orders['pay'] == 0) {
                    $pay = "❌";
                } else if ($row_select_orders['pay'] == 1) {
                    $pay = "✔";
                }
        ?>
            <tr>
                <td class="col-1"> <?= $num++ ?> </td>
                <td class="col-2"><?= $row_select_orders['name'] ?> </td>
                <td class="col-1"> <?=number_format($row_select_orders['total'], 0, ',', '.')?>đ</td>
                <td class="col-1"> <?= $row_select_orders['create_time'] ?> </d>
                <td class="col-1"> <?= $pay ?> </td>
                <td class="col-1"> <button class="btn btn-outline-success btn-block" data-bs-toggle="modal" data-bs-target="#exampleModal2_<?=$row_select_orders['order_id']?>" data-bs-whatever="@mdo"> Xem </button> </td>               
                <td class="col-1">
                    <a href="admin.php?action=accept&status=0&id=<?= $row_select_orders['order_id'] ?> " type="button" class="btn btn-outline-success ms-2">Duyệt</a>

                    <?php 
                        if (isset($_GET['action']) && $_GET['action'] == 'accept' && isset($_GET['status']) && $_GET['status'] == 0 && isset($_GET['id'])) {
                            $id = $_GET['id'];

                            $update_order_status = "UPDATE orders SET `status` = 1 WHERE order_id = :id";
                            $stmt_update_status = $pdo->prepare($update_order_status);
                            $stmt_update_status->execute([
                                ':id' => $id
                            ]);

                        }
                    ?>
                </td>

                <div class="modal fade" id="exampleModal2_<?=$row_select_orders['order_id']?>" tabindex="-1" aria-labelledby="exampleModal2_<?=$row_select_orders['order_id']?>" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header bg-color">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Chi tiết đơn hàng</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <b>Mã đơn hàng: <?= $row_select_orders['order_id']?></b>
                                </div>
                                <div class="row">
                                    <div class="col-4"> <p> <b>Khách hàng: </b> <?= $row_select_orders['name'] ?> </p></div>
                                    <div class="col-4"> <p> <b>Số điện thoại: </b> <?= $row_select_orders['phone'] ?> </p></div>
                                    <div class="col-4"> <p> <b>Địa chỉ: </b> <?= $row_select_orders['address'] ?> </p></div>
                                </div>
                                <div class="row">
                                    <div class="col-8"> <p> <b>Thời gian đặt hàng: </b> <?= $row_select_orders['create_time'] ?> </p></div>
                                    <div class="col-4"> <p> <b>Tổng tiền: </b> <?= $row_select_orders['total'] ?> </p></div>
                                </div>
                                <div class="row">
                                    <div class="col-8"> <p> <b>Ghi chú: </b> <?= $row_select_orders['note'] ?> </p></div>
                                    <div class="col-4"> <p> <b>Thanh toán: </b> <?= $pay ?> </p></div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-md-1 border"><b>STT</b></div>
                                    <div class="col-md-3 border"><b>Tên</b></div>
                                    <div class="col-md-2 border"><b>Ảnh</b></div>
                                    <div class="col-md-2 border"><b>Đơn giá</b></div>
                                    <div class="col-md-2 border"><b>Số lượng</b></div>
                                    <div class="col-md-2 border"><b>Thành tiền</b></div>
                                </div>

                                <?php
                                    $num_order_item = 1;
                                    $id = $row_select_orders['order_id'];

                                    $select_order_item = "SELECT * FROM `orderItems` WHERE  `order_id` = :id";
                                    $stmt_select_order_item = $pdo->prepare($select_order_item);
                                    $stmt_select_order_item->execute([':id' => $id]); 

                                    while ($row_select_order_item = $stmt_select_order_item->fetch()) {
                                        $total = $row_select_order_item['quantity'] * $row_select_order_item['price']
                                ?>

                                <div class="row text-center">
                                    <div class="col-md-1 border"> <?= $num_order_item++ ?> </div>
                                    <div class="col-md-3 border"> <?= $row_select_order_item['name_product'] ?> </div>
                                    <div class="col-md-2 border"> <img class="w-100" src="<?= $row_select_order_item['image_url'] ?>"> </div>
                                    <div class="col-md-2 border"> <?= $row_select_order_item['price'] ?> </div>
                                    <div class="col-md-2 border"> <?= $row_select_order_item['quantity'] ?> </div>
                                    <div class="col-md-2 border"> <?= $total ?> </div>
                                </div>

                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>                 
                <!-- <td class="col-1"> <a href="" type="button" class="btn btn-outline-success ms-2" >Hủy</a> </td> -->
            </tr>
     
    <?php } ?>
    </table>
    
    <?php 
        include __DIR__ . '/../admin/pagination.php';
    ?>

<?php } ?>
<meta http-equiv="refresh" content="60">