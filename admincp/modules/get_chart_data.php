<?php
include "../config/config.php"; // Kết nối CSDL

// Truy vấn lấy doanh thu theo ngày
$query = "SELECT DATE(ngay_mua) as ngay, SUM(tong_tien) as doanhthu 
          FROM tbl_giohang 
          WHERE trangthai_giohang = 1 
          GROUP BY DATE(ngay_mua)";

$result = mysqli_query($mysqli, $query);

// Kiểm tra lỗi truy vấn
if (!$result) {
    echo json_encode(['error' => 'Lỗi truy vấn MySQL: ' . mysqli_error($mysqli)]);
    exit;
}

$labels = [];
$values = [];

while ($row = mysqli_fetch_assoc($result)) {
    $labels[] = $row['ngay'];
    $values[] = (float) $row['doanhthu']; // Ép kiểu tránh lỗi JSON
}

// Trả về JSON
echo json_encode(['labels' => $labels, 'values' => $values]);
?>
