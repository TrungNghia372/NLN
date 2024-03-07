<?php
// Phân trang
    if ($search) {
        $stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM `products` WHERE `name_product` LIKE '%" . $search . "%'"); //Lấy số lượng sản phẩm
    } else {
        if ($category_id) {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM `products` WHERE `category_id` = $category_id");
        } else if ($price == 1) {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM `products` WHERE `price` < 30000");
        } else if ($price == 2) {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM `products` WHERE `price` > 30000 AND `price` < 60000");
        } else if ($price == 3) {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM `products` WHERE `price` > 60000 AND `price` < 100000");
        } else if ($price == 4) {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM `products` WHERE `price` > 100000");
        } else {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM `products`");
        }
    }
        $stmt->execute();
        $totalRecords = $stmt->fetchColumn();
        $totalPages = ceil($totalRecords / $item_per_page); //Tổng số trang = Tổng sản phẩm / Tổng sản phẩm trên một trang
    
    $param = "";
    $param_id = "";
    $param_price ="";
    if ($search) {
        $param = "name=".$search;
    } else if ($category_id) {
        $param_id = "category_id=".$category_id;
    } else if ($price) {
        $param_price = "price=".$price;
    }
?>
<div class="d-flex justify-content-center">
    <nav aria-label="Page navigation example">
        <ul class="pagination">

            <?php if ($current_page > 1) {
                $pre_page = $current_page - 1;
            ?>
                <a class="page-item page-link" href="?<?=$param_price?><?=$param_id?><?=$param?>&per_page=<?=$item_per_page?>&page=<?=$pre_page?>"><<</a>
            <?php } ?>

            <?php for ($num = 1; $num <= $totalPages; $num++) {?>
                <?php if ($num > $current_page - 3 && $num < $current_page + 3 ) {?>
                    <a class="page-item page-link" href="?<?=$param_price?><?=$param_id?><?=$param?>&per_page=<?=$item_per_page?>&page=<?=$num?>"><?=$num?></a>
                <?php } ?>
            <?php } ?>      
                                                                      
            <?php if ($current_page <= $totalPages - 1) {
                $next_page = $current_page + 1;
            ?>
                <a class="page-item page-link" href="?<?=$param_price?><?=$param_id?><?=$param?>&per_page=<?=$item_per_page?>&page=<?=$next_page?>">>></a>
            <?php } ?>
            
        </ul>
    </nav>
</div>