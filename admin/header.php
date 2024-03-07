<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="img/logoCTN.png">
    <script src="JavaScript/cart.js"></script>
    <title><?php
            if (defined('TITLE')) {
                echo TITLE;
            } else {
                echo 'Admin';
            }
            ?></title>
</head>
<body>
<header>
    <nav class="navbar bg-color">
        <div class="container container-fluid">
            <a href="admin.php"><img src="img/logoCTN.png" class="navbar-brand w-50" alt=""></a>

            
            <div class="d-flex">
                <a href="admin.php" class="navbar-nav nav-link px-2 me-2 btn btn-outline-success">Trang chủ</a>
                <a href="logout.php" class="navbar-nav nav-link px-2 me-2 btn btn-outline-success">Đăng xuất</a>
            </div>
        </div>
    </nav>
<header>