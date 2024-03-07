<?php
require_once __DIR__ . '/../partials/db_connect.php';

function emailValid($email)
{
    // Biểu thức chính quy kiểm tra định dạng email
    $pattern = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12}).([a-zA-Z]{2,12})+$/";

    // Kiểm tra định dạng email
    return preg_match($pattern, $email) === 1;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ biểu mẫu
    $username = $_POST['usernameRegister'];
    $email = $_POST['emailRegister'];
    $password1 = $_POST['passwordRegister1'];
    $password2 = $_POST['passwordRegister2'];

    if (emailValid($email) === 1) {
        $error_message = 'Địa chỉ email không hợp lệ';
    }

    // Kiểm tra xem mật khẩu nhập lại có khớp không
    if ($password1 !== $password2) {
        die("Mật khẩu nhập lại không khớp");
    }

    // Kiểm tra xem người dùng đã tồn tại trong cơ sở dữ liệu hay chưa
    try {
        $query = "SELECT COUNT(*) AS count FROM customers WHERE username = :username";
        $statement = $pdo->prepare($query);
        $statement->execute([':username' => $username]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            die("Người dùng đã tồn tại");
        }

        // Mã hóa mật khẩu
        $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);

        // Thêm người dùng vào cơ sở dữ liệu
        $query = "INSERT INTO customers (username, email, password) VALUES (:username, :email, :password)";
        $statement = $pdo->prepare($query);
        $statement->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $hashedPassword
        ]);

        // Chuyển hướng người dùng đến trang đăng nhập hoặc trang thành công
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        die("Lỗi: " . $e->getMessage());
    }
}
?>