<?php

define('TITLE', 'Logout');

// Kiểm tra xem phiên làm việc đã được khởi động hay chưa
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Khởi động phiên làm việc nếu chưa tồn tại
}

// if (isset($_SESSION['admin']) && (basename($_SERVER['PHP_SELF']) == 'admin.php')) {
//     unset($_SESSION['admin']);

//     header("Location: admin.php");
//     exit();
// } else
if (isset($_SESSION['username'])) {
    unset($_SESSION['username']);
}

header("Location: index.php");
exit();
// session_destroy();

