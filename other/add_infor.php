<?php 
require_once __DIR__ . '/../partials/db_connect.php';

if (isset($_GET['action']) && $_GET['action'] == 'add') {
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $gender = $_POST['gender'];
            $phone = $_POST['phone'];
            $national_id = $_POST['national_id'];
            $date = $_POST['date_of_birth'];
            $email = $_POST['email'];
            $address = $_POST['address'];
    
            if (empty($name) || empty($gender) || empty($phone) || 
                    empty($national_id) || empty($date) || empty($email) || empty($address)) {
                echo '<p>Vui lòng nhập đầy đủ thông tin.</p>';
            } else {
                $add_ifor = "INSERT INTO customerInfor (full_name, gender, phone, national_id, date_of_birth, email, address, customer_id)
                            VALUE (:name, :gender, :phone, :national_id, :date, :email, :address, :customer_id)";
                $stmt_add_infor = $pdo->prepare($add_ifor);
                $stmt_add_infor->execute([
                    ':name' => $name,
                    ':gender' => $gender,
                    ':phone' => $phone,
                    ':national_id' => $national_id,
                    ':date' => $date,
                    ':email' => $email,
                    ':address' => $address,
                    ':customer_id' => $customer_id
                ]);
    
                echo '<p>Thêm thông tin thành công.</p>';
            }
        }
    
}
?>