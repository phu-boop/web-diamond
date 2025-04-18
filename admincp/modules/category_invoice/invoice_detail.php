<?php
// Giả định đã kết nối mysqli (biến $mysqli được thiết lập trong file include khác)
// Kiểm tra ID đơn hàng
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo '<p>Lỗi: ID đơn hàng không hợp lệ.</p>';
    exit;
}
$id = (int)$_GET['id'];

// Truy vấn thông tin giỏ hàng và khách hàng
$sql = "SELECT 
            g.id_giohang,
            g.ma_giohang,
            g.tongtien,
            g.trangthai_giohang,
            dk.tenkhachhang,
            dk.email,
            dk.dienthoai,
            vc.ten AS ten_nguoi_nhan,
            vc.sdt AS sdt_vanchuyen,
            vc.diachi,
            vc.ghi_chu,
            km.loai_khuyenmai,
            km.giatri
        FROM 
            tbl_giohang AS g
            INNER JOIN tbl_dangky AS dk ON g.id_khachhang = dk.id_dangky
            INNER JOIN tbl_vanchuyen AS vc ON dk.id_dangky = vc.id_dangky
            INNER JOIN tbl_giohang_chitiet AS gct ON g.ma_giohang = gct.ma_giohang
            LEFT JOIN tbl_khuyenmai AS km ON g.id_khuyenmai = km.id_khuyenmai
        WHERE 
            g.id_giohang = ?";
$stmt = mysqli_prepare($mysqli, $sql);
if (!$stmt) {
    echo '<p>Lỗi truy vấn: ' . htmlspecialchars(mysqli_error($mysqli)) . '</p>';
    exit;
}
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$order = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$order) {
    echo '<p>Lỗi: Không tìm thấy đơn hàng.</p>';
    exit;
}

// Truy vấn danh sách sản phẩm trong giỏ hàng
$sql_products = "SELECT 
                    sp.tensanpham,
                    sp.giasp,
                    sp.hinhanh,
                    gct.soluong
                 FROM 
                    tbl_sanpham AS sp
                    INNER JOIN tbl_giohang_chitiet AS gct ON sp.id_sanpham = gct.id_sanpham
                    INNER JOIN tbl_giohang AS g ON g.ma_giohang = gct.ma_giohang
                 WHERE 
                    g.id_giohang = ?";
$stmt_products = mysqli_prepare($mysqli, $sql_products);
if (!$stmt_products) {
    echo '<p>Lỗi truy vấn: ' . htmlspecialchars(mysqli_error($mysqli)) . '</p>';
    exit;
}
mysqli_stmt_bind_param($stmt_products, 'i', $id);
mysqli_stmt_execute($stmt_products);
$result_products = mysqli_stmt_get_result($stmt_products);
$products = [];
while ($row = mysqli_fetch_assoc($result_products)) {
    $products[] = $row;
}
mysqli_stmt_close($stmt_products);

// Cập nhật trạng thái giỏ hàng
$sql_status = "UPDATE tbl_giohang SET trangthai_giohang = 0 WHERE id_giohang = ?";
$stmt_status = mysqli_prepare($mysqli, $sql_status);
if (!$stmt_status) {
    echo '<p>Lỗi truy vấn: ' . htmlspecialchars(mysqli_error($mysqli)) . '</p>';
    exit;
}
mysqli_stmt_bind_param($stmt_status, 'i', $id);
mysqli_stmt_execute($stmt_status);
mysqli_stmt_close($stmt_status);

// Tính toán tổng tiền và thành tiền
$total_price = 0;
$product_count = 0;
foreach ($products as $product) {
    $total_price += $product['giasp'] * $product['soluong'];
    $product_count++;
}

$final_price = $total_price;
$discount_display = "0 VNĐ";
if ($order['loai_khuyenmai'] == 'phantram') {
    $final_price = $total_price * (1 - $order['giatri'] / 100);
    $discount_display = $order['giatri'] . " %";
} elseif ($order['loai_khuyenmai'] == 'codinh') {
    $final_price = $total_price - $order['giatri'];
    $discount_display = number_format($order['giatri']) . " VNĐ";
}
?>

<div class="container_detail">
    <div class="content_fake">
        <div class="page_detail">
            <div class="order-details">
                <h2>Chi tiết đơn hàng</h2>
                <table class="order-table">
                    <thead>
                        <tr>
                            <th>SẢN PHẨM</th>
                            <th>GIÁ</th>
                            <th>SỐ LƯỢNG</th>
                            <th>TỔNG CỘNG</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($products)): ?>
                            <tr>
                                <td colspan="4">Không có sản phẩm trong đơn hàng.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td class="product">
                                        <img src="modules/productMNG/image_product/<?php echo htmlspecialchars($product['hinhanh']); ?>" alt="Ảnh sản phẩm" width="50">
                                        <span><?php echo htmlspecialchars($product['tensanpham']); ?></span>
                                    </td>
                                    <td><?php echo number_format($product['giasp']); ?> VNĐ</td>
                                    <td><?php echo htmlspecialchars($product['soluong']); ?></td>
                                    <td><?php echo number_format($product['giasp'] * $product['soluong']); ?> VNĐ</td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="totals">
                    <div class="total-item">
                        <span class="title">Tổng tiền:</span>
                        <span><?php echo number_format($total_price); ?> VNĐ</span>
                    </div>
                    <div class="total-item">
                        <span class="title">Giảm giá:</span>
                        <span><?php echo $discount_display; ?></span>
                    </div>
                    <div class="total-item">
                        <span class="title">Thuế:</span>
                        <span>0 VNĐ</span>
                    </div>
                    <div class="total-item">
                        <span class="title">Tổng cộng:</span>
                        <span>
                            <?php
                            if (round($final_price) == round($order['tongtien'])) {
                                echo number_format($final_price);
                            } else {
                                echo "Lỗi tính toán tổng tiền";
                            }
                            ?> VNĐ
                        </span>
                    </div>
                </div>
            </div>
            <div class="customer-details">
                <div class="right">
                    <h3>Chi tiết khách hàng</h3>
                    <div class="customer-info">
                        <img src="../assets/images/avata.png" alt="Ảnh đại diện khách hàng" class="avatar">
                        <div class="details">
                            <p><strong><?php echo htmlspecialchars($order['tenkhachhang']); ?></strong></p>
                            <p>Mã đơn hàng: #<?php echo htmlspecialchars($order['id_giohang']); ?></p>
                        </div>
                    </div>
                    <div class="customer-info">
                        <img src="../assets/images/cart.png" alt="Giỏ hàng">
                        <p><?php echo $product_count; ?> Sản phẩm</p>
                    </div>
                    <div class="contact">
                        <p>Email: <a href="mailto:<?php echo htmlspecialchars($order['email']); ?>"><?php echo htmlspecialchars($order['email']); ?></a></p>
                        <p>Điện thoại: <a href="tel:<?php echo htmlspecialchars($order['dienthoai']); ?>"><?php echo htmlspecialchars($order['dienthoai']); ?></a></p>
                    </div>
                </div>
                <div class="shipping-address">
                    <h3>Thông tin vận chuyển</h3>
                    <div class="contact">
                        <p>Người nhận: <?php echo htmlspecialchars($order['ten_nguoi_nhan']); ?></p>
                        <p>Số điện thoại: <?php echo htmlspecialchars($order['sdt_vanchuyen']); ?></p>
                        <p>Địa chỉ: <?php echo htmlspecialchars($order['diachi']); ?></p>
                        <p>Ghi chú: <?php echo htmlspecialchars($order['ghi_chu'] ?: 'Không có'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>