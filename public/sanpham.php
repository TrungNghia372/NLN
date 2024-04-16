<?php 

define('TITLE', 'Sản Phẩm');

include_once __DIR__ . '/../partials/header.php'; 

require_once __DIR__ . '/../partials/db_connect.php';
?>
<main>
        <!-- Carousel -->
        <div id="carouselExampleCaptions" class="carousel slide mt-3" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/carousel_3.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-md-block">
                        <h3 class="bg-product rounded">Khám phá Vẻ Độc Đáo Của Xương Rồng - Sen Đá Tại CactusTN</h3>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="img/carousel_2.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-md-block">
                        <h3 class="bg-product rounded">Mang Vẻ Đẹp Thiên Nhiên Vào Góc Nhỏ Với Tiểu Cảnh</h3>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="img/carousel_1.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-md-block">
                        <h3 class="bg-product rounded">Thúc Đẩy Sự Hài Hòa Và Sự Sống Tươi Mới Với Cây Cảnh Độc Đáo</h3>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="container">
            <div class="row mt-3">
                    <h1 class="text-center"><hr>Sản Phẩm<hr></h1>
                    <div class="col-lg-3">
                        <div class="row">
                            <div class="list-group">
                                <div class="bg-color rounded-top">
                                    <hr class="mb-0"><h1 class="fs-5 text-center">Danh mục sản phẩm</h1><hr class="mt-0">
                                </div>
                                <a href="sanpham.php?category_id=1" class="list-group-item list-group-item-action">Xương rồng</a>
                                <a href="sanpham.php?category_id=2" class="list-group-item list-group-item-action">Sen đá</a>
                                <a href="sanpham.php?category_id=3" class="list-group-item list-group-item-action">Tiểu cảnh</a>
                                <a href="sanpham.php?category_id=4" class="list-group-item list-group-item-action">Chậu</a>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="list-group">
                                <div class="bg-color rounded-top">
                                    <hr class="mb-0"><h1 class="fs-5 text-center">Giá</h1><hr class="mt-0">
                                </div>
                                <a href="sanpham.php?price=1" class="list-group-item list-group-item-action">Dưới 30.000đ</a>
                                <a href="sanpham.php?price=2" class="list-group-item list-group-item-action">Từ 30.000đ -> 60.000đ</a>
                                <a href="sanpham.php?price=3" class="list-group-item list-group-item-action">Từ 60.000đ -> 100.000đ</a>
                                <a href="sanpham.php?price=4" class="list-group-item list-group-item-action">Trên 100.000đ</a>
                            </div>
                        </div>

                        <div class="row me-2 bg-color mt-3 rounded">
                            <img src="img/img_categories.JPG" class="my-3">
                        </div>
                    </div>

                    <div class="col-lg-9 bg-color">
                        <div class="row mb-3 mt-3">
                            <?php
                                $search = isset($_GET['name']) ? $_GET['name'] : "";
                                $category_id = isset($_GET['category_id']) ? $_GET['category_id'] : "";
                                $price = isset($_GET['price']) ? $_GET['price'] : "";


                                $item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:9;
                                $current_page = !empty($_GET['page'])?$_GET['page']:1;
                                $offset = ($current_page - 1) * $item_per_page;

                                if ($search) {
                                    $query = 'SELECT * FROM products WHERE `name_product` LIKE :search ORDER BY product_id ASC LIMIT '.$item_per_page.' OFFSET '.$offset;
                                    $statement = $pdo->prepare($query);
                                    $searchTerm = '%' . $search . '%';
                                    $statement->bindParam(':search', $searchTerm);
                                    $statement->execute();
                                } else {
                                    if ($category_id) {
                                        $query = 'SELECT * FROM products WHERE category_id = :category_id ORDER BY product_id ASC LIMIT '.$item_per_page.' OFFSET '.$offset.'';
                                        $statement = $pdo->prepare($query);
                                        $statement->execute([':category_id' => $category_id]);
                                    } else if ($price == 1) {
                                        $query = 'SELECT * FROM products WHERE price < 30000 ORDER BY product_id ASC LIMIT '.$item_per_page.' OFFSET '.$offset.'';
                                        $statement = $pdo->prepare($query);
                                        $statement->execute();
                                    } else if ($price == 2) {
                                        $query = 'SELECT * FROM products WHERE price > 30000 AND price < 60000 ORDER BY product_id ASC LIMIT '.$item_per_page.' OFFSET '.$offset.'';
                                        $statement = $pdo->prepare($query);
                                        $statement->execute();
                                    } else if ($price == 3) {
                                        $query = 'SELECT * FROM products WHERE price > 60000 AND price < 100000 ORDER BY product_id ASC LIMIT '.$item_per_page.' OFFSET '.$offset.'';
                                        $statement = $pdo->prepare($query);
                                        $statement->execute();
                                    } else if ($price == 4) {
                                        $query = 'SELECT * FROM products WHERE price > 100000 ORDER BY product_id ASC LIMIT '.$item_per_page.' OFFSET '.$offset.'';
                                        $statement = $pdo->prepare($query);
                                        $statement->execute();
                                    } else {
                                        $query = 'SELECT * FROM products ORDER BY product_id ASC LIMIT :limit OFFSET :offset';
                                        $statement = $pdo->prepare($query);
                                        $statement->bindValue(':limit', $item_per_page, PDO::PARAM_INT);
                                        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
                                        $statement->execute();
                                    }                                    
                                }
                            ?>

                            <?php while ($row = $statement->fetch()) { ?>
                            <div class="col-xl-4 col-lg-6 col-xs-12">
                                <div class="d-flex justify-content-center">
                                    <div class="card mt-3" style="width: 18rem;">
                                        <img src="<?=htmlspecialchars($row['image_url'])?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h6 class="card-title"><?=htmlspecialchars($row['name_product'])?></h6>
                                            <p class="card-text"><?=number_format(htmlspecialchars($row['price']), 0, ',', '.')?>đ</p>
                                            <div class="d-flex justify-content-end">
                                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal2_<?=$row['product_id']?>" data-bs-whatever="@mdo">Đặt hàng</button>
                                            </div>

                                            <!-- Scrollable modal -->
                                            <div class="modal fade" id="exampleModal2_<?=$row['product_id']?>" tabindex="-1" aria-labelledby="exampleModalLabel2_<?=$row['product_id']?>" aria-hidden="true">
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
                                                                <p><?=$row['description']?></p>
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <p class="card-text">Giá: <?=number_format(htmlspecialchars($row['price']), 0, ',', '.')?>đ</p>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <p>Số lượng: <?=$row['quantity']?></p>
                                                                    </div>
                                                                </div>
                                                                
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form id="add-to-cart-form" action="giohang.php?action=add&id=<?=$row['product_id']?>" method="POST">
                                                                <div class="row">
                                                                    <label for="quantity" class="col-3 col-form-label d-flex">Số lượng:</label>
                                                                    <div class="col-5">
                                                                        <input type="number" class="form-control" id="quantity" name="quantity[<?=$row['product_id']?>]" min="1" value="1">
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

                        <!-- Phân trang -->
                        <?php 
                            include __DIR__ . '/../other/pagination.php';
                        ?>
                    </div>
            </div>
        </div>

</main>

<?php include_once __DIR__ . '/../partials/footer.php'; ?>