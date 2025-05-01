<?php

if (isset($_SESSION['id_khachhang'])) {
    $id_khachhang = $_SESSION['id_khachhang'];
} else {
    echo "<script>alert('Bạn chưa đăng nhập!'); window.location.href='index.php?quanly=dangnhap';</script>";
    exit();
}

// Xử lý hủy đơn hàng
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_order_id'])) {
    $order_id = intval($_POST['cancel_order_id']);

    // Kiểm tra đơn hàng có thuộc về khách hàng và đang ở trạng thái "Đang xử lý"
    $query = "SELECT trangthai_giohang FROM tbl_giohang WHERE id_giohang = $order_id AND id_khachhang = $id_khachhang";
    $result = mysqli_query($mysqli, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['trangthai_giohang'] == 1) {
            // Cập nhật trạng thái đơn hàng thành "Đã hủy" (trangthai_giohang = 3)
            $update_query = "UPDATE tbl_giohang SET trangthai_giohang = 3 WHERE id_giohang = $order_id";
            if (mysqli_query($mysqli, $update_query)) {
                echo "<script>alert('Đơn hàng đã được hủy thành công!');</script>";
            } else {
                echo "<script>alert('Lỗi: Không thể hủy đơn hàng.');</script>";
            }
        } else {
            echo "<script>alert('Đơn hàng không thể hủy vì không ở trạng thái đang xử lý.');</script>";
        }
    } else {
        echo "<script>alert('Đơn hàng không tồn tại hoặc không thuộc về bạn.');</script>";
    }
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
                $status_class = ($row['trangthai_giohang'] == 1) ? 'status-pending' : ($row['trangthai_giohang'] == 3 ? 'status-canceled' : 'status-completed');
                $status_text = ($row['trangthai_giohang'] == 1) ? 'Đang xử lý...' : ($row['trangthai_giohang'] == 3 ? 'Đã hủy' : 'Đã xử lý');
                $payment_method = ($row['pt_thanhtoan'] == 'chuyen_khoan') ? 'Chuyển Khoản' : 'Tiền Mặt';

                // Truy vấn thông tin vận chuyển từ tbl_vanchuyen
                $id_vanchuyen = $row['id_vanchuyen'];
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
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="<?php echo $toggle_class; ?>" <?php echo $onclick; ?>>
                            <td class="<?php echo $status_class; ?>"><?php echo $status_text; ?></td>
                            <td><?php echo htmlspecialchars($row['ma_giohang']); ?></td>
                            <td><?php echo htmlspecialchars($row['ngay_mua']); ?></td>
                            <td><?php echo number_format($row['tongtien'], 0, ',', '.') . ' VNĐ'; ?></td>
                            <td><?php echo $payment_method; ?></td>
                            <td>
                                <?php if ($row['trangthai_giohang'] == 1) { ?>
                                    <form method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?');">
                                        <input type="hidden" name="cancel_order_id" value="<?php echo $order_id; ?>">
                                        <button type="submit" class="cancel-order-btn">Hủy Đơn</button>
                                    </form>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr class="order-details" style="display: <?php echo $display_style; ?>;">
                            <td colspan="6">
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

<style>
.cancel-order-btn {
    background-color: #ff4d4d;
    color: white;
    border: none;
    padding: 8px 12px;
    cursor: pointer;
    border-radius: 4px;
}
.cancel-order-btn:hover {
    background-color: #cc0000;
}
.status-canceled {
    color: #ff4d4d; /* Màu đỏ cho trạng thái Đã hủy */
}
</style>