<?php

include_once __DIR__ . '/../admin/header.php';

require_once __DIR__ . '/../partials/db_connect.php';

?>

<main>
    <div class="container">
        <div class="row mt-3">
            <hr>

            <div class="col-lg-3">
                <div class="row text-center">
                    <h3 class="mt-1">Thông báo<hr></h3>
                    <?php
                        include_once __DIR__ . '/../admin/add_product.php';
                        include_once __DIR__ . '/../admin/edit_product.php';
                        include_once __DIR__ . '/../admin/delete_product.php';
                    ?>
                    <h3><hr></h3>
                </div>
                <div class="row">
                    <div class="list-group">
                        <div class="bg-color rounded-top">
                            <hr class="mb-0"><h1 class="fs-5 text-center">Admin Menu</h1><hr class="mt-0">
                        </div>
                        <a href="" class="list-group-item list-group-item-action">Xác nhận đơn hàng</a>
                        <a href="" class="list-group-item list-group-item-action">S</a>
                        <a href="" class="list-group-item list-group-item-action">T</a>
                        <a href="" class="list-group-item list-group-item-action">C</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="d-flex justify-content-end">
                        <a href="" type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#add_product" data-bs-whatever="@mdo">Thêm sản phẩm</a>

                        <div class="modal fade" id="add_product" tabindex="-1" aria-labelledby="add_product" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-color">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm sản phẩm</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <?php
                                        $category = "SELECT * FROM categories";
                                        $stmt_category = $pdo->prepare($category);
                                        $stmt_category->execute();
                                    ?>
                                    <div class="modal-body">
                                        <form action="admin.php?action=add" method="POST">
                                            
                                            <div class="mb-3 mt-3">
                                                    <div class="form-group row">
                                                        <label  class="form-label col-sm-4 mt-1"><b>Tên sản phẩm:</b></label>
                                                        <div class="col-sm-8">
                                                            <input name="name_product" class="form-control">
                                                        </div>
                                                    </div>
                                            </div>

                                            <div class="mb-3">
                                                    <div class="form-group row">
                                                        <div class="col-4"><label  class="form-label mt-1"><b>Số lượng:</b></label></div>
                                                        <div class="col-2">
                                                            <input name="quantity_product" class="form-control">
                                                        </div>

                                                        <div class="col-3"><label  class="form-label mt-1"><b>Giá:</b></label></div>
                                                        <div class="col-3">
                                                            <input name="price_product" class="form-control">
                                                        </div>
                                                    </div>
                                            </div>

                                            <div class="mb-3">
                                                    <div class="form-group row">
                                                        <label class="form-label col-sm-4 mt-1"><b>Mô tả:</b></label>
                                                        <div class="col-sm-8">
                                                            <textarea class="form-control" id="note" name="description_product" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                            </div>

                                            <div class="mb-3 mt-3">
                                                    <div class="form-group row">
                                                        <label  class="form-label col-sm-4 mt-1"><b>Ảnh sản phẩm:</b></label>
                                                        <div class="col-sm-8">
                                                            <input type="file" class="form-control" name="img_product" id="fileToUpload">
                                                        </div>
                                                    </div>
                                            </div>

                                            <div class="mb-3 mt-3">
                                                    <div class="form-group row">
                                                        <label  class="form-label col-sm-4 mt-1" name="Select_Category" for="Select_Category"><b>Danh mục:</b></label>
                                                        <div class="col-sm-8">
                                                        <select class="form-control" name="select_category" id="Select_Category">
                                                            <?php
                                                                while ($row_category = $stmt_category->fetch()) {
                                                            ?>
                                                                <option value="<?=$row_category['category_id']?>"><?=$row_category['name_categories']?></option>
                                                            <?php
                                                                }
                                                            ?>
                                                        </select>
                                                        </div>
                                                    </div>
                                            </div>


                                            <hr>
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-success btn-block mb-1" id="AddBtn">
                                                    <img style="width: 15px;" src="img/icon.png" alt=""> Xác nhận
                                                </button>
                                            </div>
                                        </form> 

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-3">
                </div>

                <?php 
                    if (isset($_GET['action']) && $_GET['action'] == 'edit') { 
                        include_once __DIR__ . '/../admin/edit_form.php';
                    } else {
                ?>
                <div class="row">
                    <table class="table table-bordered text-center">
                        <tr class="table-info">
                            <th class="col-4">Tên sản phẩm</th>
                            <th class="col-2">Ảnh sản phẩm</th>
                            <th class="col-2">Đơn giá</th>
                            <th class="col-2">Số lượng</th>
                            <th class="col-1">Sửa</th>
                            <th class="col-1">Xóa</th>
                        </tr>

                        <?php
                            $item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:9;
                            $current_page = !empty($_GET['page'])?$_GET['page']:1;
                            $offset = ($current_page - 1) * $item_per_page;

                            $show_products = "SELECT * FROM products LIMIT :limit OFFSET :offset";
                            $stmt_show_products = $pdo->prepare($show_products);
                            $stmt_show_products->bindValue(':limit', $item_per_page, PDO::PARAM_INT);
                            $stmt_show_products->bindValue(':offset', $offset, PDO::PARAM_INT);
                            $stmt_show_products->execute();

                            while ($row_show_products = $stmt_show_products->fetch()) {
                        ?>

                        <tr>
                            <td class="col-4"><?= $row_show_products['name_product'] ?></td>
                            <td class="col-2"><img class="w-100" src="<?= $row_show_products['image_url'] ?>"></td>
                            <td class="col-2"><?=number_format(htmlspecialchars($row_show_products['price']), 0, ',', '.')?>đ</td>
                            <td class="col-2"><?=htmlspecialchars($row_show_products['quantity'])?></td>
                            <td class="col-1"><a class="btn btn-outline-success mt-4" href="admin.php?action=edit&id=<?=$row_show_products['product_id']?>">Sửa</a></td>
                            <td class="col-1"><a class="btn btn-outline-success mt-4" href="admin.php?action=delete&id=<?=$row_show_products['product_id']?>">Xóa</a></td>
                        </tr>

                        <?php } ?>
                    </table>

                    <?php 
                        include __DIR__ . '/../admin/pagination.php';
                    ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
<main>