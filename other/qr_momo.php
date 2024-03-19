<?php
if (empty($_POST['name'])) {
    $error = 'Vui lòng nhập tên người nhận!';
} else if (empty($_POST['phone'])) {
    $error = 'Vui lòng nhập số điện thoại người nhận!';
} else if (empty($_POST['address'])) {
    $error = 'Vui lòng nhập địa chỉ người nhận!';
} else if (empty($_POST['quantity'])) {
    $error = 'Giỏ hàng rỗng!';
}

if ($error == false && !empty($_POST['quantity'])) { //Lưu dữ liệu giỏ hàng vào database
    $productIds = array_keys($_POST['quantity']);
    $placeholders = implode(',', array_fill(0, count($productIds), '?'));

    $stmt = $pdo->prepare("SELECT * FROM `products` WHERE `product_id` IN ($placeholders)");
    $stmt->execute($productIds);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $total = 0;
    $orderProducts = array();

    foreach ($products as $row) {
        $orderProducts[] = $row;
        $total += $row['price'] * $_POST['quantity'][$row['product_id']];
    }

    include __DIR__ . '/../other/customer_id.php';
    $payValue = true;
    $statusValue = false;

    $stmt = $pdo->prepare("INSERT INTO `orders` (`customer_id`, `name`, `phone`, `address`, `note`, `pay`, `status`, `total`) VALUES (:customer_id, :name, :phone, :address, :note, :pay, :status, :total)");
    $stmt->bindParam(':customer_id', $customer_id);
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':phone', $_POST['phone']);
    $stmt->bindParam(':address', $_POST['address']);
    $stmt->bindParam(':note', $_POST['note']);
    $stmt->bindParam(':pay', $payValue, PDO::PARAM_BOOL);
    $stmt->bindParam(':status', $statusValue, PDO::PARAM_BOOL);
    $stmt->bindParam(':total', $total);
    $stmt->execute();
    $orderID = $pdo->lastInsertId();

    $insertString = "";
    foreach ($orderProducts as $key => $product) {
        $insertString .= "('".$orderID."', '".$product['product_id']."', '".$product['name_product']."', '".$product['image_url']."', '".$_POST['quantity'][$product['product_id']]."', '".$product['price']."'),";
    }
    $insertString = rtrim($insertString, ',');

    $stmt = $pdo->prepare("INSERT INTO `orderItems` (`order_id`, `product_id`, `name_product`, `image_url`, `quantity`, `price`) VALUES $insertString");
    $stmt->execute();
    
    $success = 'Đặt hàng thành công.';

    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    
    
    $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
    
    
    $partnerCode = 'MOMOBKUN20180529';
    $accessKey = 'klm05TvNBzhg7h7j';
    $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
    $orderInfo = "Thanh toán qua MoMo";
    $amount = $total;
    $orderId = time() ."";
    $redirectUrl = "http://ct271.localhost/giohang.php?action=submit";
    $ipnUrl = "http://ct271.localhost/giohang.php?action=submit";
    $extraData = "";
    $requestId = time() . "";
    $requestType = "captureWallet";
       
        //before sign HMAC SHA256 signature
    $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
    $signature = hash_hmac("sha256", $rawHash, $secretKey);
    $data = array('partnerCode' => $partnerCode,
        'partnerName' => "Test",
        "storeId" => "MomoTestStore",
        'requestId' => $requestId,
        'amount' => $amount,
        'orderId' => $orderId,
        'orderInfo' => $orderInfo,
        'redirectUrl' => $redirectUrl,
        'ipnUrl' => $ipnUrl,
        'lang' => 'vi',
        'extraData' => $extraData,
        'requestType' => $requestType,
        'signature' => $signature);
    $result = execPostRequest($endpoint, json_encode($data));
    $jsonResult = json_decode($result, true);  // decode json
    
    //Just a example, please check more in there
    ?>
    <script type="text/javascript">
        window.location.href = "<?php echo $jsonResult['payUrl']; ?>";
    </script>
    <?php
    
}