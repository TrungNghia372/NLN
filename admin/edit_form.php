<?php
require_once __DIR__ . '/../partials/db_connect.php';

if (isset($row_select) && !empty($row_select)) {
?>

<form action="admin.php?action=submit&id=<?=$row_select['product_id']?>" method="POST">                                            
        <div class="mb-3 mt-3">
                <div class="form-group row">
                    <label  class="form-label col-sm-4 mt-1"><b>Tên sản phẩm:</b></label>
                    <div class="col-sm-8">
                        <input name="name_product" class="form-control" value="<?= $row_select['name_product'] ?>">
                    </div>
                </div>
        </div>

        <div class="mb-3">
                <div class="form-group row">
                    <div class="col-4"><label  class="form-label mt-1"><b>Số lượng:</b></label></div>
                    <div class="col-2">
                        <input name="quantity_product" class="form-control" value="<?= $row_select['quantity'] ?>">
                    </div>

                    <div class="col-3"><label  class="form-label mt-1"><b>Giá:</b></label></div>
                    <div class="col-3">
                        <input name="price_product" class="form-control" value="<?= $row_select['price'] ?>">
                    </div>
                </div>
        </div>

        <div class="mb-3">
                <div class="form-group row">
                    <label class="form-label col-sm-4 mt-1"><b>Mô tả:</b></label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="note" name="description_product" rows="3"><?= $row_select['description'] ?></textarea>
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
                        <option value="<?=$row_select['category_id']?>"><?=$name1?><hr></option>
                        <?php
                            $category = "SELECT * FROM categories";
                            $stmt_category = $pdo->prepare($category);
                            $stmt_category->execute();
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
            <button type="submit" class="btn btn-success btn-block mb-1" id="editBtn">
                <img style="width: 15px;" src="img/icon.png" alt=""> Xác nhận
            </button>
        </div>
    </form>

<?php } ?>