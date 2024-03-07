<?php

define('TITLE', 'Logout');

// Kiểm tra xem phiên làm việc đã được khởi động hay chưa
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Khởi động phiên làm việc nếu chưa tồn tại
}

// if (isset($_SESSION['loggedin'])) {
//     unset($_SESSION['loggedin']);
// }

session_destroy();

header("Location: index.php");
exit();