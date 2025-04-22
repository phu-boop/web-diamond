<?php

if (isset($_SESSION['id_khachhang'])) {
    $id_khachhang = $_SESSION['id_khachhang'];
} else {
    echo "<script>alert('Bạn chưa đăng nhập!'); window.location.href='index.php?quanly=dangnhap';</script>";
    exit();
}

// Lấy tất cả đơn hàng của khách hàng
$query = "SELECT * FROM tbl_giohang WHERE id_khachhang = $id_khachhang ORDER BY ngay_mua DESC";
$result = mysqli_query($mysqli, $query);
?>

<div class="order-history-wrapper">
    <h1>Đơn Hàng Đã Đặt</h1>
    <div class="order-container">
        <?php if (mysqli_num_rows($result) > 0) { ?>
            <?php while ($row = mysqli_fetch_assoc($result)) { 
                $order_id = $row['id_giohang'];
                $status_class = ($row['trangthai_giohang'] == 1) ? 'status-pending' : 'status-completed';
                $status_text = ($row['trangthai_giohang'] == 1) ? 'Đang xử lý...' : 'Đã hoàn thành';
                $payment_method = ($row['pt_thanhtoan'] == 'chuyen_khoan') ? 'Chuyển Khoản' : 'Tiền Mặt';

                // Truy vấn thông tin vận chuyển từ tbl_vanchuyen
                $id_vanchuyen = $row['id_vanchuyen']; // Giả định tbl_giohang có cột id_vanchuyen
                $shipping_query = "SELECT * FROM tbl_vanchuyen WHERE id_vanchuyen = $id_vanchuyen AND id_dangky = $id_khachhang LIMIT 1";
                $shipping_result = mysqli_query($mysqli, $shipping_query);
                $shipping_info = null;
                if ($shipping_result && mysqli_num_rows($shipping_result) > 0) {
                    $shipping_info = mysqli_fetch_assoc($shipping_result);
                }

                // Truy vấn chi tiết sản phẩm trong đơn hàng dựa trên ma_giohang
                $ma_giohang = $row['ma_giohang'];
                $detail_query = "SELECT sp.tensanpham, sp.giasp, sp.hinhanh, ghct.soluong 
                                FROM tbl_giohang_chitiet ghct 
                                JOIN tbl_sanpham sp ON ghct.id_sanpham = sp.id_sanpham 
                                WHERE ghct.ma_giohang = '$ma_giohang'";
                $detail_result = mysqli_query($mysqli, $detail_query);

                // Xác định trạng thái hiển thị của chi tiết đơn hàng
                $display_style = ($row['trangthai_giohang'] == 1) ? 'table-row' : 'none';
                $toggle_class = ($row['trangthai_giohang'] == 1) ? '' : 'toggle-row';
                $onclick = ($row['trangthai_giohang'] == 1) ? '' : 'onclick="this.classList.toggle(\'active\'); this.nextElementSibling.style.display = (this.nextElementSibling.style.display === \'none\') ? \'table-row\' : \'none\';"';
            ?>
                <table class="order-table">
                    <thead>
                        <tr>
                            <th>Trạng Thái</th>
                            <th>Mã Đơn Hàng</th>
                            <th>Ngày Mua</th>
                            <th>Tổng Tiền</th>
                            <th>Phương Thức Thanh Toán</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="<?php echo $toggle_class; ?>" <?php echo $onclick; ?>>
                            <td class="<?php echo $status_class; ?>"><?php echo $status_text; ?></td>
                            <td><?php echo htmlspecialchars($row['ma_giohang']); ?></td>
                            <td><?php echo htmlspecialchars($row['ngay_mua']); ?></td>
                            <td><?php echo number_format($row['tongtien'], 0, ',', '.') . ' VNĐ'; ?></td>
                            <td><?php echo $payment_method; ?></td>
                        </tr>
                        <tr class="order-details" style="display: <?php echo $display_style; ?>;">
                            <td colspan="5">
                                <!-- Phần thông tin vận chuyển -->
                                <div class="shipping-info">
                                    <h4><i class="fa-solid fa-truck"></i> Thông Tin Vận Chuyển</h4>
                                    <?php if ($shipping_info) { ?>
                                        <p><strong>ID Vận Chuyển:</strong> <?php echo htmlspecialchars($shipping_info['id_vanchuyen']); ?></p>
                                        <p><strong>Tên Người Nhận:</strong> <?php echo htmlspecialchars($shipping_info['ten']); ?></p>
                                        <p><strong>Số Điện Thoại:</strong> <?php echo htmlspecialchars($shipping_info['sdt']); ?></p>
                                        <p><strong>Địa Chỉ:</strong> <?php echo htmlspecialchars($shipping_info['diachi']); ?></p>
                                    <?php } else { ?>
                                        <p>Không có thông tin vận chuyển.</p>
                                    <?php } ?>
                                </div>

                                <!-- Phần chi tiết sản phẩm -->
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Ảnh</th>
                                            <th>Tên Sản Phẩm</th>
                                            <th>Giá</th>
                                            <th>Số Lượng</th>
                                            <th>Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (mysqli_num_rows($detail_result) > 0) { ?>
                                            <?php while ($detail_row = mysqli_fetch_assoc($detail_result)) { 
                                                $subtotal = $detail_row['giasp'] * $detail_row['soluong'];
                                            ?>
                                                <tr>
                                                    <td><img src="admincp/modules/productMNG/image_product/<?php echo htmlspecialchars($detail_row['hinhanh']); ?>" alt="Product Image"></td>
                                                    <td><?php echo htmlspecialchars($detail_row['tensanpham']); ?></td>
                                                    <td><?php echo number_format($detail_row['giasp'], 0, ',', '.') . ' VNĐ'; ?></td>
                                                    <td><?php echo $detail_row['soluong']; ?></td>
                                                    <td><?php echo number_format($subtotal, 0, ',', '.') . ' VNĐ'; ?></td>
                                                </tr>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="5" class="no-orders">Không có sản phẩm trong đơn hàng này!</td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            <?php } ?>
        <?php } else { ?>
            <p class="no-orders">Bạn chưa có đơn hàng nào!</p>
        <?php } ?>
    </div>
</div>