<?php
include "../../../admincp/config/config.php"; 
session_start();
header('Content-type: text/html; charset=utf-8');
// Tạo giỏ hàng mới
$tong_tien = 0;
$chi_tiet_don_hang = "";
$id_khuyenmai = isset($_GET['promotion_id']) ? (int) $_GET['promotion_id'] : 0;
foreach ($_SESSION['cart'] as $key => $value) {
    $quantity = $value['soluong'];
    $price = $value['giasp']; 
    $total = $quantity * $price;
    $tong_tien += $total;
}
// Áp dụng khuyến mãi nếu có
$giam_gia = 0;
if ($id_khuyenmai > 0) {
    $sql_km = "SELECT * FROM tbl_khuyenmai WHERE id_khuyenmai = '$id_khuyenmai'";
    $query_km = mysqli_query($mysqli, $sql_km);
    if ($row_km = mysqli_fetch_assoc($query_km)) {
        $loai_km = $row_km['loai_khuyenmai']; // 'phantram' hoặc 'codinh'
        $giatri_km = $row_km['giatri'];
        $toithieu_km = $row_km['toithieu_khuyenmai'];

        // Kiểm tra nếu tổng tiền đủ điều kiện giảm giá
        if ($tong_tien >= $toithieu_km) {
            if ($loai_km == 'phantram') {
                $giam_gia = ($tong_tien * $giatri_km) / 100;
            } else if ($loai_km == 'codinh') {
                $giam_gia = $giatri_km;
            }
        }
    }
}

// Tính tổng tiền sau khi giảm giá
$tong_sau_giam = max(0, $tong_tien - $giam_gia);
$_SESSION['tong_tien']=$tong_sau_giam ;

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
if (isset($_SESSION['tong_tien']) && is_numeric($_SESSION['tong_tien']) && $_SESSION['tong_tien'] > 0) {
    $amount = $_SESSION['tong_tien'];  // Lấy số tiền từ session
} else {
    echo 'Lỗi: Số tiền thanh toán không hợp lệ hoặc chưa được thiết lập.';
    exit();
}
$orderId = time() ."";
$redirectUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";
$ipnUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";
$extraData = "";

    $requestId = time() . "";
    $requestType = "captureWallet";
    //$extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
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
    // In toàn bộ kết quả trả về từ MoMo API
    if (isset($jsonResult['payUrl'])) {
        header('Location: ' . $jsonResult['payUrl']);
        exit();
    } else {
        // Trường hợp không có payUrl, thông báo lỗi
        echo "Yêu cầu bị từ chối vì số tiền giao dịch nhỏ hơn số tiền tối thiểu cho phép là 1000 VND hoặc lớn hơn số tiền tối đa cho phép là 50000000 VND.";
        echo "vui lòng thanh toán Vnpay";
        exit();
    }
?>