<?php
session_start();

define('TITLE', 'Đăng Nhập');

$loggedin = false;
$error_message = false;

require_once __DIR__ . '/../partials/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!empty($_POST['usernameLogin']) && !empty($_POST['passwordLogin'])) {

        $username = $_POST['usernameLogin'];
        $email = $_POST['emailLogin'];
        $password = $_POST['passwordLogin'];

        if ($username == 'admin' && (strtolower($email) == 'me@example.com') && ($password == 'testpass')) {
            $_SESSION['username'] = 'admin';
            $loggedin = true;

            header("Location: admin.php");
            exit();
        }

        $query = "SELECT * FROM customers WHERE username = :username AND email = :email";
        $statement = $pdo->prepare($query);
        $statement->execute([':username' => $username, ':email' => $email]);

        $user = $statement->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            $loggedin = true;
            $_SESSION['loggedin'] = $loggedin;
            $_SESSION['username'] = $username;

            header("Location: index.php");
            exit();
        } else {
            $error_message = 'Tài khoản, email hoặc mật khẩu không chính xác! Vui lòng nhập đăng nhập lại';
        }
    } else {
        $error_message = 'Vui lòng nhập đầy đủ thông tin!';
    }
}

if ($error_message) {
    include __DIR__ . '/../partials/show_error.php';
}

