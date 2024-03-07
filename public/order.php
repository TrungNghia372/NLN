<?php
session_start();
define('TITLE', 'Đơn Hàng');

include_once __DIR__ . '/../partials/header.php';

require_once __DIR__ . '/../partials/db_connect.php';

include __DIR__ . '/../other/customer_id.php';
?>

<div class="container">
    <?php
        $query = 'SELECT * FROM orders WHERE `customer_id` = :id';
        $statement = $pdo->prepare($query);
        $statement->execute([':id' => $customer_id]);
    ?>

    <h1 class="text-center"><hr>Đơn Hàng<hr></h1>
    <?php while ($row = $statement->fetch()) { ?>
    <div class="row mb-2">
        <div class="col-2"></div>
        <div class="col-8 bg-color rounded">
            <div class="row">
                <div class="col-4  my-2">
                    <img src="img/order.JPG" class="rounded float-start card-img-top" alt="...">
                </div>
                <div class="col-8 my-2">

                    <?php $id = $row['order_id'] ?>
                    <div class="row">
                        <div class="col-6">
                            <h4>#Đơn hàng <?=$id?></h4>
                        </div>
                        <div class="col-6">
                            <p><b>Thời gian:</b> <?=htmlspecialchars($row['create_time'])?></p>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="row">
                            <div class="col-7">
                                <p><b>Tên:</b> <?=htmlspecialchars($row['name'])?></p>
                            </div>

                            <div class="col-5">
                                <p><b>Số điện thoại:</b> <?=htmlspecialchars($row['phone'])?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-7">
                                <p><b>Địa chỉ:</b> <?=htmlspecialchars($row['address'])?></p>
                            </div>

                            <div class="col-5">
                                <p><b>Tổng tiền:</b> <?=number_format(htmlspecialchars($row['total']), 0, ',', '.')?>đ</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-7">
                                <p><b>Ghi chú:</b> <?=htmlspecialchars($row['note'])?></p>
                            </div>

                            <div class="col-5">
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-success btn-block" data-bs-toggle="modal" data-bs-target="#exampleModal2_<?=$row['order_id']?>" data-bs-whatever="@mdo"> Xem chi tiết</button>
                                    <!-- <button class="btn btn-success btn-block ms-2" name="delete_order" type="submit">Xóa</button> -->
                                </div> 
                                <div class="modal fade" id="exampleModal2_<?=$row['order_id']?>" tabindex="-1" aria-labelledby="exampleModalLabel2_<?=$row['order_id']?>" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                        <!-- =================== -->
                                        <div class="modal-content">
                                            <div class="modal-header bg-color">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Chi tiết đơn hàng</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <table class="table table-bordered text-center">
                                                    <tr class="table-info">
                                                        <th class="col-1">STT</th>
                                                        <th class="col-4">Tên sản phẩm</th>
                                                        <th class="col-2">Ảnh sản phẩm</th>
                                                        <th class="col-1">Đơn giá</th>
                                                        <th class="col-1">Số lượng</th>
                                                        <th class="col-2">Thành tiền</th>
                                                    </tr>

                                                    <?php
                                                        $num = 1;

                                                        $detail = "SELECT * FROM orderItems WHERE order_id = $id";
                                                        $stmt_detail = $pdo->prepare($detail);
                                                        $stmt_detail->execute();

                                                        while ($row = $stmt_detail->fetch()) {
                                                            $subtotal = $row['quantity'] * $row['price'];
                                                    ?>

                                                    <tr>
                                                        <td class="col-1"> <?= $num++ ?> </td>
                                                        <td class="col-4"> <?=htmlspecialchars($row['name_product'])?> </td>
                                                        <td class="col-2"> <img class="w-100" src="<?= $row['image_url'] ?>"> </td>
                                                        <td class="col-1"> <?=number_format(htmlspecialchars($row['price']), 0, ',', '.')?>đ </td>
                                                        <td class="col-1"> <?=htmlspecialchars($row['quantity'])?> </td>
                                                        <td class="col-2">  <?=number_format(htmlspecialchars($subtotal), 0, ',', '.')?>đ </td>
                                                    </tr>

                                                    <?php } ?>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- =================== -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    
</div>

<?php
include_once __DIR__ . '/../partials/footer.php';
?>