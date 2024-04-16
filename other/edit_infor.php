<?php
if (isset($_GET['action']) && $_GET['action'] == 'edit_infor') {
    $select_infor = "SELECT * FROM customerInfor WHERE `customer_id` = :id";
    $stmt_select_infor = $pdo->prepare($select_infor);
    $stmt_select_infor->execute([':id' => $customer_id]);
    
} else if (isset($_GET['action']) && $_GET['action'] == 'save') {
    if (isset($_GET['id']) && is_numeric($_GET['id']) && ($_GET['id']) > 0) {
        $id = $_GET['id'];

        if  ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $gender = $_POST['gender'];
            $phone = $_POST['phone'];
            $national_id = $_POST['national_id'];
            $date = $_POST['date_of_birth'];
            $email = $_POST['email'];
            $address = $_POST['address'];

            if (!empty($name) && !empty($gender) && !empty($phone) && !empty($national_id) && !empty($date) && !empty($email) && !empty($address)) {
                $edit_ifor = 'UPDATE customerInfor 
                                SET full_name=:full_name, gender=:gender, phone=:phone, national_id=:national_id, date_of_birth=:date, email=:email, address=:address
                                WHERE customer_id=:id';

                $stmt_edit_form = $pdo->prepare($edit_ifor);
                $stmt_edit_form->execute([
                    ':full_name' => $name,
                    ':gender' => $gender,
                    ':phone' => $phone,
                    ':national_id' => $national_id,
                    ':date' => $date,
                    ':email' => $email,
                    ':address' => $address, 
                    ':id' => $id,
                ]);

                echo '<p>Cập nhật thông tin thành công.</p>';
            } else {
                echo '<p>Cập nhật thông tin thất bại.</p>';
            }
        }
    }
}


?>
