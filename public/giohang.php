<?php
session_start();

define('TITLE', 'Giỏ Hàng');

include_once __DIR__ . '/../partials/header.php';

require_once __DIR__ . '/../partials/db_connect.php';
?>

<main>
    <?php
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        $error = false;
        $success = false;
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
        
                // Thêm sản phẩm vào giỏ hàng
                case 'add':
                        $id = intval($_GET['id']);
            
                        $query = "SELECT * FROM products WHERE `product_id` = :id";
                        $statement = $pdo->prepare($query);
                        $statement->bindValue(':id', $id, PDO::PARAM_INT);
                        $statement->execute();
            
                        if ($statement->rowCount() != 0) {
                            $row = $statement->fetch(PDO::FETCH_ASSOC);
                            $quantity = $_POST['quantity'][$row['product_id']];
            
                            if(!isset($_SESSION['cart'][$id])) {
            
                                $_SESSION['cart'][$id] = [
                                    'quantity' => $quantity,
                                    'product_id' => $row['product_id'],
                                    'name_product' => $row['name_product'],
                                    'price' => $row['price'],
                                ];   
            
                            } else {
                                if (is_numeric($_SESSION['cart'][$id]['quantity'])) {
                                    $_SESSION['cart'][$id]['quantity'] += $quantity;
                                }
                            }
            
                        }
                        break;
            
                    // Xóa sản phẩm khỏi giỏ hàng
                case 'delete':
                        if (isset($_GET['id'])) {
                            unset($_SESSION['cart'][$_GET['id']]);
                        }
                        break;
                    
                    // Submit sản phẩm trong giỏ hàng
                case 'submit':
                        if (isset($_POST['update_click'])) { // Cập nhật số lượng sản phẩm
                            
                            foreach ($_POST['quantity'] as $id => $quantity) {
                                if ($quantity == 0) {
                                    unset($_SESSION["cart"][$id]);
                                }
                                if (isset($_SESSION['cart'][$id])) {
                                    $_SESSION['cart'][$id]['quantity'] = $quantity;
                                }
                            }
            
                        } else if (isset($_POST['order_click'])) { // Hoàn thành đặt hàng
                            if (empty($_POST['name'])) {
                                $error = 'Vui lòng nhập tên người nhận!';
                            } else if (empty($_POST['phone'])) {
                                $error = 'Vui lòng nhập số điện thoại người nhận!';
                            } else if (empty($_POST['address'])) {
                                $error = 'Vui lòng nhập địa chỉ người nhận!';
                            } else if (empty($_POST['quantity'])) {
                                $error = 'Giỏ hàng rỗng!';
                            }

                            if ($error == false && !empty($_POST['quantity'])) { //Lưu dữ liệu giỏ hàng vào database
                                $productIds = array_keys($_POST['quantity']);
                                $placeholders = implode(',', array_fill(0, count($productIds), '?'));

                                $stmt = $pdo->prepare("SELECT * FROM `products` WHERE `product_id` IN ($placeholders)");
                                $stmt->execute($productIds);
                                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                $total = 0;
                                $orderProducts = array();

                                foreach ($products as $row) {
                                    $orderProducts[] = $row;
                                    $total += $row['price'] * $_POST['quantity'][$row['product_id']];
                                }

                                include __DIR__ . '/../other/customer_id.php';

                                $stmt = $pdo->prepare("INSERT INTO `orders` (`customer_id`, `name`, `phone`, `address`, `note`, `total`) VALUES (:customer_id, :name, :phone, :address, :note, :total)");
                                $stmt->bindParam(':customer_id', $customer_id);
                                $stmt->bindParam(':name', $_POST['name']);
                                $stmt->bindParam(':phone', $_POST['phone']);
                                $stmt->bindParam(':address', $_POST['address']);
                                $stmt->bindParam(':note', $_POST['note']);
                                $stmt->bindParam(':total', $total);
                                $stmt->execute();
                                $orderID = $pdo->lastInsertId();

                                $insertString = "";
                                foreach ($orderProducts as $key => $product) {
                                    $insertString .= "('".$orderID."', '".$product['product_id']."', '".$product['name_product']."', '".$product['image_url']."', '".$_POST['quantity'][$product['product_id']]."', '".$product['price']."'),";
                                }
                                $insertString = rtrim($insertString, ',');

                                $stmt = $pdo->prepare("INSERT INTO `orderItems` (`order_id`, `product_id`, `name_product`, `image_url`, `quantity`, `price`) VALUES $insertString");
                                $stmt->execute();
                                $success = 'Đặt hàng thành công.';
                            }
                        }
                        break;
                }                    
        }
    ?>
    <div class="container">
        <h1 class="text-center"><hr>Giỏ Hàng<hr></h1>
        <?php if (!empty($error)) { ?>
            <div class="notify_msg">
                <?=$error?> <a href="giohang.php">Quay lại giỏ hàng</a>
            </div>
        <?php } elseif (!empty($success)) { ?>
            <div class="notify_msg">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="notify_msg bg-color rounded col-8">

                        <h3 class="text-center"><hr>Thông Báo<hr></h3>
                        <div class="d-flex justify-content-center my-3">
                            <i class="fa-regular fa-circle-check fa-beat-fade fa-5x" style="color: #14e65d;"></i>
                        </div>
                        <p class="text-center"><?=$success?></p>
                        <div class="d-flex justify-content-center mb-3">
                            <a href="order.php" class="btn btn-outline-success">Đến đơn hàng</a> <a href="sanpham.php" class="btn btn-outline-success ms-2">Tiếp tục đặt hàng</a>
                        </div>

                    </div>
                </div>

            </div>
        <?php } else { ?>
            <form id="cart-form" action="giohang.php?action=submit" method="POST">
            <table class="table table-bordered text-center">
                <tr class="table-info">
                    <th class="col-1">STT</th>
                    <th class="col-4">Tên sản phẩm</th>
                    <th class="col-2">Ảnh sản phẩm</th>
                    <th class="col-1">Đơn giá</th>
                    <th class="col-1">Số lượng</th>
                    <th class="col-2">Thành tiền</th>
                    <th class="col-1">Xóa</th>
                </tr>

                <?php
                // Hiển thị sản phẩm đã thêm trong giỏ hàng
                $totalAmount = 0;
                if (!empty($_SESSION['cart'])) {
                    $num = 1;
                    foreach ($_SESSION['cart'] as $id => $product) {
                        $query = "SELECT * FROM products WHERE `product_id` = :id";
                        $statement = $pdo->prepare($query);
                        $statement->bindValue(':id', $id, PDO::PARAM_INT);
                        $statement->execute();

                        if ($statement->rowCount() != 0) {
                            $row = $statement->fetch(PDO::FETCH_ASSOC);
                            $subtotal = $product['quantity'] * $row['price'];
                            $totalAmount += $subtotal;
                            ?>
                            <tr>
                                <td class="col-1"><?= $num++ ?></td>
                                <td class="col-4"><?= $row['name_product'] ?></td>
                                <td class="col-2"><img class="w-100" src="<?= $row['image_url'] ?>"></td>
                                <td class="col-1"><?=number_format($row['price'],0,',','.')?>đ</td>
                                <td class="col-1"><input type="number" value="<?= $product['quantity'] ?>" name="quantity[<?=$product['product_id']?>]" style="width: 50px;"></td>
                                <td class="col-2"><?=number_format($subtotal,0,',','.')?>đ</td>
                                <td class="col-1"><a class="nav-link" href="giohang.php?action=delete&id=<?=$row['product_id']?>">Xóa</a></td>
                            </tr>
                            <?php
                        }
                    }
                }
                ?>

                <tr>
                    <td colspan="5" class="table-info"><b>Tổng tiền:</b></td>
                    <td colspan="2"><b><?=number_format($totalAmount,0,',','.')?>đ</b></td>
                </tr>
            </table>

            <div class="d-flex justify-content-end">
                <button type="submit" name="update_click" class="btn btn-success">Cập nhật</button>
            </div>

            <h3 class="text-center"><hr>Thông Tin Liên Lạc<hr></h3>
            
            <div class="row">
                <div class="col-lg-6">
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="name"><b>Họ và tên:</b></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ và tên">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="phone"><b>Số điện thoại:</b></label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="address"><b>Địa chỉ:</b></label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="note"><b>Ghi chú:</b></label>
                                <textarea class="form-control" id="note" name="note" rows="4" placeholder="Nhập ghi chú"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success" name="order_click">Đặt hàng</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <img class="w-100 rounded" src="img/img_cart.JPG" alt="">
                </div>
            </div>
        </form>
        <?php } ?>
    </div>
</main>

<?php
include_once __DIR__ . '/../partials/footer.php';
?>