<?php include_once __DIR__ . '/../partials/header.php'; ?>

<main>
        <img class="d-block w-100 my-3" src="img/carousel_1.jpg" alt="">
        <div class="bg-color mt-3">
            <div class="col-md-8 offset-md-2">
                <div class="row text-center">
                    <div class="col-md fs-4 mt-3">
                        <p class="bg-service py-4"><i class="fa-solid fa-award"></i> Đa Dạng Sản Phẩm</p>
                    </div>
    
                    <div class="col-md fs-4 mt-3">
                        <p class="bg-service py-4"><i class="fa-solid fa-truck-fast"></i> Giao Hàng Tận Nơi</p>
                    </div>
    
                    <div class="col-md fs-4 mt-3">
                        <p class="bg-service py-4"><i class="fa-solid fa-rotate"></i> Đổi Trả Miễn Phí</p>
                    </div>
    
                    <div class="col-md fs-4 mt-3">
                        <p class="bg-service py-4"><i class="fa-solid fa-gift"></i> Quà Tặng Hấp Dẫn</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <h1 class="text-center mt-3"><hr>Sản Phẩm Mới <hr></h1>

            <div class="row">
                <?php
                    require_once __DIR__ . '/../partials/db_connect.php';
                    $query = 'SELECT * FROM products ORDER BY date_entered DESC LIMIT 4 OFFSET 0';
                    $statement = $pdo->prepare($query);
	                $statement->execute();
                    while ($row = $statement->fetch()) { 
                ?>
                <div class="col-lg-3 col-md-6 col-xs-12 mb-3">
                    <div class="d-flex justify-content-center">
                        <div class="card ms-2" style="width: 18rem;">
                        <img src="<?=htmlspecialchars($row['image_url'])?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h6 class="card-title"><?=htmlspecialchars($row['name_product'])?></h6>
                                <p class="card-text"><?=number_format($row['price'],0,',','.')?>đ</p>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal2_<?=htmlspecialchars($row['product_id'])?>" data-bs-whatever="@mdo">Đặt hàng</button>
                                </div>

                                <!-- Scrollable modal -->
                                <div class="modal fade" id="exampleModal2_<?=$row['product_id']?>" tabindex="-1" aria-labelledby="exampleModalLabel2 " aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <!-- =================== -->
                                                <div class="modal-content">
                                                        <div class="modal-header bg-color">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Sản Phẩm</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form>
                                                                <img class="w-100" src="<?=$row['image_url']?>" alt="">
                                                                <h5 class="mt-3"><?=$row['name_product']?></h5>
                                                                <p><?=htmlspecialchars($row['description'])?></p>
                                                                <p class="card-text">Giá: <?=number_format($row['price'],0,',','.')?>đ</p>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form id="add-to-cart-form" action="giohang.php?action=add&id=<?=$row['product_id']?>" method="POST">
                                                                <div class="row">
                                                                    <label for="quantity" class="col-3 col-form-label d-flex">Số lượng:</label>
                                                                    <div class="col-5">
                                                                        <input type="number" class="form-control" id="quantity" name="quantity[<?=$row['product_id']?>]" min="1" value="1" inputmode="numeric" pattern="[0-9]+">
                                                                    </div>
                                                                    <div class="col-4 d-flex justify-content-end">
                                                                        <button class="btn btn-success btn-block"><i class="fa-solid fa-cart-shopping"></i> Đặt hàng</button>
                                                                    </div>                                                                    
                                                                </div>
                                                                
                                                            </form>
                                                        </div>
                                                    </div>
                                                <!-- =================== -->
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>

            <div class="row">
                <div class="text-center">
                    <a href="sanpham.php" class="btn btn-success pt-2"><h5>Xem thêm sản phẩm</h5></a>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12">
                    <img src="img/carousel_3.jpg" class="w-100 my-3 rounded" alt="">
                </div>
            </div>

            <h1 class="text-center mt-3"><hr>Sản Phẩm Nổi Bật<hr></h1>

            <div class="row">
            <?php
                    require_once __DIR__ . '/../partials/db_connect.php';
                    $query = 'SELECT * FROM products ORDER BY quantity DESC LIMIT 4 OFFSET 0';
                    $statement = $pdo->prepare($query);
	                $statement->execute();
                    while ($row = $statement->fetch()) { 
                ?>
                <div class="col-lg-3 col-md-6 col-xs-12 mb-3">
                    <div class="d-flex justify-content-center">
                        <div class="card ms-2" style="width: 18rem;">
                        <img src="<?=$row['image_url']?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h6 class="card-title"><?=htmlspecialchars($row['name_product'])?></h6>
                                <p class="card-text"><?=number_format($row['price'],0,',','.')?>đ</p>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal2_<?=htmlspecialchars($row['product_id'])?>" data-bs-whatever="@mdo">Đặt hàng</button>
                                </div>

                                <!-- Scrollable modal -->
                                <div class="modal fade" id="exampleModal2_<?=$row['product_id']?>" tabindex="-1" aria-labelledby="exampleModalLabel2 " aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <!-- =================== -->
                                                <div class="modal-content">
                                                        <div class="modal-header bg-color">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Sản Phẩm</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form>
                                                                <img class="w-100" src="<?=$row['image_url']?>" alt="">
                                                                <h5 class="mt-3"><?=$row['name_product']?></h5>
                                                                <p><?=htmlspecialchars($row['description'])?></p>
                                                                <p class="card-text">Giá: <?=number_format($row['price'],0,',','.')?>đ</p>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form id="add-to-cart-form" action="giohang.php?action=add&id=<?=$row['product_id']?>" method="POST">
                                                                <div class="row">
                                                                    <label for="quantity" class="col-3 col-form-label d-flex">Số lượng:</label>
                                                                    <div class="col-5">
                                                                        <input type="number" class="form-control" id="quantity" name="quantity[<?=$row['product_id']?>]" min="1" value="1" inputmode="numeric" pattern="[0-9]+">
                                                                    </div>
                                                                    <div class="col-4 d-flex justify-content-end">
                                                                        <button class="btn btn-success btn-block"><i class="fa-solid fa-cart-shopping"></i> Đặt hàng</button>
                                                                    </div>                                                                    
                                                                </div>
                                                                
                                                            </form>
                                                        </div>
                                                    </div>
                                                <!-- =================== -->
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>

            <div class="row">
                <div class="text-center">
                    <a href="sanpham.php" class="btn btn-success pt-2"><h5>Xem thêm sản phẩm</h5></a>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <img src="img/img1.JPG" class="w-100 img-fluid rounded mt-3" alt="">
                </div>
    
                <div class="col-md-6 col-xs-12">
                    <img src="img/img2.JPG" class="w-100 img-fluid rounded mt-3" alt="">
                </div>
            </div>
              
            
            <h1 class="text-center mt-3"><hr>Tin Tức<hr></h1>
            <div class="row">
                <div class="col-xl-3 col-md-6 col-xs-12 mb-3">
                    <div class="d-flex justify-content-center">
                        <a href="tintuc.php" class="nav-link">
                            <div class="card" style="width: 18rem;">
                                <img src="img/news_1.JPG" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h6 class="card-title">Hướng dẫn chi tiết cách trồng và chăm sóc cây cảnh để bàn.</h6>
                                    <p class="card-text">Cây cảnh để bàn dùng để trang trí, tăng thêm tài lộc và may mắn theo phong thủy 
                                        đang là xu hướng được phần lớn giới công sở, văn phòng ưa chuộng hiện nay...</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 col-xs-12 mb-3">
                    <div class="d-flex justify-content-center">
                        <a href="tintuc.php" class="nav-link">
                            <div class="card" style="width: 18rem;">
                                <img src="img/news_2.JPG" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h6 class="card-title">Top những cây cảnh được ưa chuộng nhất.</h6>
                                    <p class="card-text">Ngày nay, cây cảnh mini để bàn đã không còn khó tìm kiếm như vài năm về trước. 
                                        Tuy nhiên, để lựa chọn một loại cây có giá trị, mang nhiều ý nghĩa quả thật...</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 col-xs-12 mb-3">
                    <div class="d-flex justify-content-center">
                        <a href="tintuc.php" class="nav-link">
                            <div class="card" style="width: 18rem;">
                                <img src="img/news_3.JPG" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h6 class="card-title">Ý nghĩa bất ngờ của cây xương rồng</h6>
                                    <p class="card-text">Ý nghĩa của cây xương rồng ở trong cuộc sống. Với khả năng cây sống trong môi trường khắc nghiệt, 
                                        cây xương rồng cũng thể hiện sự bền bỉ,...</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                </div>

                <div class="col-xl-3 col-md-6 col-xs-12 mb-3">
                    <div class="d-flex justify-content-center">
                        <a href="tintuc.php" class="nav-link">
                            <div class="card" style="width: 18rem;">
                                <img src="img/news_4.JPG" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h6 class="card-title">Những tác dụng của cây xương rồng</h6>
                                    <p class="card-text">Theo y học cổ truyền có vị đắng, tính hàn và có chứa độc tố. 
                                        Vậy cây xương rồng có tác dụng gì trong đời sống con người? Dưới đây là 5 tác dụng của xương rồng...</p>
                                </div>
                          </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="text-center">
                    <a href="tintuc.php" class="btn btn-success pt-2"><h5>Xem thêm</h5></a>
                </div>
            </div>
            <hr>
        </div>
    </main>


<?php include_once __DIR__ . '/../partials/footer.php'; ?>