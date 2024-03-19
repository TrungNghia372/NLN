<?php
    if (isset($_GET['action']) && $_GET['action'] == 'accept' && isset($_GET['status'])) {
        $stmt_total_orders = $pdo->prepare("SELECT COUNT(*) AS total FROM `orders` WHERE `status` = $status");

        $stmt_total_orders->execute();
        $total_orders = $stmt_total_orders->fetchColumn(); // Tổng số đơn hàng
        $total_pages = ceil($total_orders / $item_per_page); // Tổng số trang
    } else {
        $stmt_total_products = $pdo->prepare("SELECT COUNT(*) AS total FROM `products`");

        $stmt_total_products->execute();
        $total_products = $stmt_total_products->fetchColumn(); // Tổng số sản phẩm
        $total_pages = ceil($total_products / $item_per_page); // Tổng số trang
    }

    $param = "";

?>

<div class="d-flex justify-content-center">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php if (isset($_GET['action']) && $_GET['action'] == 'accept' && isset($_GET['status'])) { ?>

                <?php if ($current_page > 1) {
                    $pre_page = $current_page - 1;
                ?>
                    <a class="page-item page-link" href="?<?=$param?>action=accept&status=<?=$status?>&per_page=<?=$item_per_page?>&page=<?=$pre_page?>"><<</a>
                <?php } ?>

                <?php for ($num = 1; $num <= $total_pages; $num++) {?>
                    <?php if ($num > $current_page - 3 && $num < $current_page + 3 ) {?>
                        <a class="page-item page-link" href="?<?=$param?>action=accept&status=<?=$status?>&per_page=<?=$item_per_page?>&page=<?=$num?>"><?=$num?></a>
                    <?php } ?>
                <?php } ?>      
                                                                        
                <?php if ($current_page <= $total_pages - 1) {
                    $next_page = $current_page + 1;
                ?>
                    <a class="page-item page-link" href="?<?=$param?>action=accept&status=<?=$status?>&per_page=<?=$item_per_page?>&page=<?=$next_page?>">>></a>
                <?php } ?>

            <?php    } else {   ?>

                <?php if ($current_page > 1) {
                    $pre_page = $current_page - 1;
                ?>
                    <a class="page-item page-link" href="?<?=$param?>&per_page=<?=$item_per_page?>&page=<?=$pre_page?>"><<</a>
                <?php } ?>

                <?php for ($num = 1; $num <= $total_pages; $num++) {?>
                    <?php if ($num > $current_page - 3 && $num < $current_page + 3 ) {?>
                        <a class="page-item page-link" href="?<?=$param?>&per_page=<?=$item_per_page?>&page=<?=$num?>"><?=$num?></a>
                    <?php } ?>
                <?php } ?>      
                                                                        
                <?php if ($current_page <= $total_pages - 1) {
                    $next_page = $current_page + 1;
                ?>
                    <a class="page-item page-link" href="?<?=$param?>&per_page=<?=$item_per_page?>&page=<?=$next_page?>">>></a>
                <?php } ?>

            <?php    }  ?>
        </ul>
    </nav>
</div>
