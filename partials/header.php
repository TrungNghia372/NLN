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
                echo 'Trang Chủ';
            }
            ?></title>
</head>
<body>
<header>
        <nav class="navbar container">
            <div class="container-fluid">
                <a href="index.php"><img style="width: 80px;" src="img/logoCTN.png" class="navbar-brand w-75" alt=""></a>
                <form class="d-flex" method="GET" acction="">
                    <!-- Tìm kiếm -->
                    <input type="text" value="" name="name" class="form-control me-2" placeholder="Tìm kiếm" aria-label="Search">
                    <button type="submit" value="Tìm kiếm" class="btn btn-outline-success me-2"><i class="fa fa-search"></i></button>
                    <!-- Giỏ hàng -->
                    <button class="btn btn-outline-success" onclick="openCart()" type="button"><i class="fa fa-cart-shopping"></i></button>
                </form>
            </div>
        </nav>

        <nav class="navbar navbar-expand-lg bg-color">
            <div class="container-fluid container">
                <a class="navbar-brand me-2 px-2 nav-link btn btn-outline-success" href="/">Trang Chủ</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link me-2 btn btn-outline-success" aria-current="page" href="gioithieu.php">Giới Thiệu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-2 btn btn-outline-success" href="tintuc.php">Tin Tức</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-2 btn btn-outline-success" href="sanpham.php">Sản Phẩm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-success" href="lienhe.php">Liên Hệ</a>
                        </li>
                    </ul>
                    <div class="navbar-nav ml-auto">
                        <?php
                        if ((isset($_SESSION['username']) && ($_SESSION['username']) != 'admin') && (basename($_SERVER['PHP_SELF']) != 'logout.php')) {
                            echo '<p><div class="dropdown">
                            <button class="btn btn-outline-success" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user"></i>
                            </button>
                            <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="infor.php">Thông tin</a></li>
                            <li><a class="dropdown-item" href="order.php">Đơn hàng</a></li>
                            <li><a class="dropdown-item" href="logout.php">Đăng xuất</a></li>
                            </ul>
                            </div></p>';
                        } else {
                            echo '<a href="#" type="button" class="nav-link btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Đăng Nhập</a>
                            <a href="#" type="button" class="nav-link btn btn-outline-success ms-2" data-bs-toggle="modal" data-bs-target="#exampleModal1" data-bs-whatever="@mdo">Đăng Ký</a>';
                        }
                        ?>
                        <!-- ĐĂNG NHẬP -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-color">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Đăng Nhập</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form  method="POST" action="login.php">
                                            <div class="form-group mb-3">
                                                <label for="usernameInput"><i class="fas fa-user mb-3"></i> Tài khoản:</label>
                                                <input class="form-control" placeholder="" name="usernameLogin" />
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="usernameInput"><i class="fas fa-user mb-3"></i> Email:</label>
                                                <input type="email" class="form-control" placeholder="Nhập email" name="emailLogin" />
                                            </div>

                                            <div class="form-group">
                                                <label for="passwordInput"><i class="fa-solid fa-lock mb-3"></i> Mật khẩu:</label>
                                                <input type="password" class="form-control" placeholder="Nhập mật khẩu" name="passwordLogin"/>
                                                <div class="form-group form-check col-md-6">
                                                    <input type="checkbox" class="form-check-input">
                                                    <label class="form-check-label">Ghi nhớ đăng nhập</label>
                                                </div>
                                            </div>
 
                                            <div class="text-end">
                                                <button class="btn btn-success btn-block" id="loginBtn"><img style="width: 15px;" src="img/icon.png" alt=""> Đăng nhập</button>
                                            </div> 
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <p><a class="sign-in" href="#">Tạo tài khoản</a></p>
                                        <p><a class="sign-in" href="#">Quên Mật khẩu?</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ===== -->


                        <!-- ĐĂNG KÝ -->
                        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-color">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Đăng Ký</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    
                                    <div class="modal-body">
                                        <form action="register.php" method="POST">
                                            <div class="form-group mb-3">
                                                <label for="usernameInput"><i class="fas fa-user mb-3"></i> Tài khoản:</label>
                                                <input class="form-control" placeholder="" name="usernameRegister" required/>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="passwordInput"><i class="fa-solid fa-lock mb-3"></i> Email:</label>
                                                <input class="form-control" type="email" placeholder="VD: qtnghia2002@gmail.com" name="emailRegister" required/>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="passwordInput"><i class="fa-solid fa-lock mb-3"></i> Mật khẩu:</label>
                                                <input class="form-control" type="password" placeholder="Nhập mật khẩu" name="passwordRegister1" required/>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="passwordInput"><i class="fa-solid fa-lock mb-3"></i> Nhập lại mật khẩu:</label>
                                                <input class="form-control" type="password" placeholder="Nhập lại mật khẩu" name="passwordRegister2" required/>
                                            </div>

                                            <hr>
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-success btn-block mb-1" id="registerBtn">
                                                    <img style="width: 15px;" src="img/icon.png" alt=""> Đăng ký
                                                </button>
                                            </div>

                                        </form>  
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ====== -->
                    </div>
                </div>
            </div>
        </nav>
    </header>