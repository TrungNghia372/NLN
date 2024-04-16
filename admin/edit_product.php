<?php 
require_once __DIR__ . '/../partials/db_connect.php';

if (isset($_GET['action']) && $_GET['action'] == 'edit') {
    if (isset($_GET['id']) && is_numeric($_GET['id']) && ($_GET['id']) > 0) {
        $id = $_GET['id'];

        $select_product = 'SELECT * FROM products WHERE product_id = :id';
     
        $stmt_select = $pdo->prepare($select_product);
        $stmt_select->execute([':id' => $id]);
        $row_select = $stmt_select->fetch();
    
        $name1 = '';
        if (!empty($row_select)) {
            if ($row_select['category_id'] == 1) {
                $name1 = "Xương rồng";
            } else if ($row_select['category_id'] == 2) {
                $name1 = "Sen đá";
            } else if ($row_select['category_id'] == 3) {
                $name1 = "Tiểu cảnh";
            } else if ($row_select['category_id'] == 4) {
                $name1 = "Chậu";
            }
        }
    }
} else if (isset($_GET['action']) && $_GET['action'] == 'submit') {
    if (isset($_GET['id']) && is_numeric($_GET['id']) && ($_GET['id']) > 0) {
        $id = $_GET['id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name_product'];
            $quantity = $_POST['quantity_product'];
            $price = $_POST['price_product'];
            $description = $_POST['description_product'];
            $img = 'img/' . basename($_POST['img_product']);
            $category = $_POST['select_category'];

            if (!empty($name) && !empty($quantity) && !empty($price) && !empty($description) && !empty($img) && !empty($category)) {
                $edit_product = 'UPDATE products SET name_product=:name, description=:description, price=:price, image_url=:img, quantity=:quantity, category_id=:category WHERE product_id=:id';
    
                $stmt_edit = $pdo->prepare($edit_product);
                $stmt_edit->execute([
                    ':name' => $name,
                    ':description' => $description,
                    ':price' => $price,
                    ':img' => $img,
                    ':quantity' => $quantity,
                    ':category' => $category,
                    ':id' => $id
                ]);
    
                echo '<p>Cập nhật thông tin sản phẩm thành công.</p>';
            } else {
                echo '<p>Cập nhật thông tin sản phẩm thất bại.</p>';
            }
        }
    }
}