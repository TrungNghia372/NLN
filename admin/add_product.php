<?php
require_once __DIR__ . '/../partials/db_connect.php';

if (isset($_GET['action']) && $_GET['action'] == 'add') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $name = $_POST['name_product'];
        $quantity = $_POST['quantity_product'];
        $price = $_POST['price_product'];
        $description = $_POST['description_product'];
        $img = 'img/' . basename($_POST['img_product']);
        $category = $_POST['select_category'];
    
        if (empty($name) || empty($quantity) || empty($price) || 
                        empty($description) || empty($img) || empty($category)) {
            echo '<p>Vui lòng nhập đầy đủ thông tin.</p>';
        } else {
            $add_product = "INSERT INTO products (name_product, description, price, image_url, quantity, category_id) 
                        VALUES (:name, :description, :price, :img, :quantity, :category)";

            $stmt_add = $pdo->prepare($add_product);
            $stmt_add->execute([
                ':name' => $name,
                ':description' => $description,
                ':price' => $price,
                ':img' => $img,
                ':quantity' => $quantity,
                ':category' => $category
            ]);

            echo '<p>Thêm sản phẩm thành công.</p>';
        }
    }
}