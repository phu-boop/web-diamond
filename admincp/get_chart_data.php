<?php
include "config/config.php"; // Kết nối CSDL

// Truy vấn lấy doanh thu theo ngày (7 ngày gần nhất)
$queryDaily = "SELECT DATE(ngay_mua) as ngay, SUM(tongtien) as doanhthu 
               FROM tbl_giohang 
               WHERE trangthai_giohang
               GROUP BY DATE(ngay_mua) 
               ORDER BY ngay_mua ASC 
               LIMIT 7";

$resultDaily = mysqli_query($mysqli, $queryDaily);
if (!$resultDaily) {
    echo json_encode(['error' => 'Lỗi truy vấn MySQL (Daily): ' . mysqli_error($mysqli)]);
    exit;
}

// Truy vấn lấy doanh thu theo tháng (6 tháng gần nhất)
$queryMonthly = "SELECT DATE_FORMAT(ngay_mua, '%Y-%m') as thang, SUM(tongtien) as doanhthu 
                 FROM tbl_giohang 
                 WHERE trangthai_giohang
                 GROUP BY YEAR(ngay_mua), MONTH(ngay_mua) 
                 ORDER BY ngay_mua ASC 
                 LIMIT 6";

$resultMonthly = mysqli_query($mysqli, $queryMonthly);
if (!$resultMonthly) {
    echo json_encode(['error' => 'Lỗi truy vấn MySQL (Monthly): ' . mysqli_error($mysqli)]);
    exit;
}

// Truy vấn lấy doanh thu theo năm (3 năm gần nhất)
$queryYearly = "SELECT YEAR(ngay_mua) as nam, SUM(tongtien) as doanhthu 
                FROM tbl_giohang 
                WHERE trangthai_giohang
                GROUP BY YEAR(ngay_mua) 
                ORDER BY ngay_mua ASC 
                LIMIT 3";

$resultYearly = mysqli_query($mysqli, $queryYearly);
if (!$resultYearly) {
    echo json_encode(['error' => 'Lỗi truy vấn MySQL (Yearly): ' . mysqli_error($mysqli)]);
    exit;
}

// Xử lý dữ liệu
$daily = ['labels' => [], 'values' => []];
$monthly = ['labels' => [], 'values' => []];
$yearly = ['labels' => [], 'values' => []];

while ($row = mysqli_fetch_assoc($resultDaily)) {
    $daily['labels'][] = $row['ngay'];
    $daily['values'][] = (float) $row['doanhthu'];
}

while ($row = mysqli_fetch_assoc($resultMonthly)) {
    $monthly['labels'][] = $row['thang'];
    $monthly['values'][] = (float) $row['doanhthu'];
}

while ($row = mysqli_fetch_assoc($resultYearly)) {
    $yearly['labels'][] = $row['nam'];
    $yearly['values'][] = (float) $row['doanhthu'];
}

// Kiểm tra dữ liệu có hay không
if (empty($daily['labels']) || empty($monthly['labels']) || empty($yearly['labels'])) {
    echo json_encode(['error' => 'Không có dữ liệu để hiển thị biểu đồ.']);
    exit;
}

// Trả về JSON
echo json_encode(['daily' => $daily, 'monthly' => $monthly, 'yearly' => $yearly]);
?>
