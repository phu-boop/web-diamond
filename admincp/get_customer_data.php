<?php
header('Content-Type: application/json');
include "config/config.php";

// Lấy số lượng khách hàng theo ngày
$query_daily = "SELECT DATE(ngay_mua) as date, COUNT(DISTINCT id_khachhang) as count 
                FROM tbl_giohang 
                GROUP BY DATE(ngay_mua) 
                ORDER BY date ASC
                LIMIT 7";
$result = $mysqli->query($query_daily);

$daily = ["labels" => [], "values" => []];
while ($row = $result->fetch_assoc()) {
    $daily["labels"][] = $row['date'];
    $daily["values"][] = (int)$row['count'];
}

// Lấy số lượng khách hàng theo tháng
$query_monthly = "SELECT DATE_FORMAT(ngay_mua, '%Y-%m') as month, COUNT(DISTINCT id_khachhang) as count 
                  FROM tbl_giohang 
                  GROUP BY DATE_FORMAT(ngay_mua, '%Y-%m') 
                  ORDER BY month ASC";
$result = $mysqli->query($query_monthly);

$monthly = ["labels" => [], "values" => []];
while ($row = $result->fetch_assoc()) {
    $monthly["labels"][] = $row['month'];
    $monthly["values"][] = (int)$row['count'];
}

// Lấy số lượng khách hàng theo năm
$query_yearly = "SELECT YEAR(ngay_mua) as year, COUNT(DISTINCT id_khachhang) as count 
                 FROM tbl_giohang 
                 GROUP BY YEAR(ngay_mua) 
                 ORDER BY year ASC";
$result = $mysqli->query($query_yearly);

$yearly = ["labels" => [], "values" => []];
while ($row = $result->fetch_assoc()) {
    $yearly["labels"][] = $row['year'];
    $yearly["values"][] = (int)$row['count'];
}

// Trả về JSON
echo json_encode([
    "daily" => $daily,
    "monthly" => $monthly,
    "yearly" => $yearly
]);

$mysqli->close();
?>
