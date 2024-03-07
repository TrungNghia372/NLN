<?php
    // Lấy id của khách hàng
    $username = $_SESSION['username'];
    $query = 'SELECT customer_id FROM customers WHERE `username` = :username';
    $statement = $pdo->prepare($query);
    $statement->execute([':username' => $username]);
    $row = $statement->fetch();
    $customer_id = $row['customer_id'];
?>