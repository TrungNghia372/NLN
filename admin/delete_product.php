<?php
require_once __DIR__ . '/../partials/db_connect.php';

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    if (isset($_GET['id']) && is_numeric($_GET['id']) && ($_GET['id']) > 0) {
        $id = $_GET['id'];

        $delete_product = "DELETE FROM products WHERE product_id = :id";
        $stmt_delete = $pdo->prepare($delete_product);
        if ($stmt_delete->execute([':id' => $id])) {
            echo '<p>Xóa sản phẩm thành công.</p>';
        } else {
            echo '<p>Có lỗi xảy ra khi xóa sản phẩm.</p>';
        }
    }
}