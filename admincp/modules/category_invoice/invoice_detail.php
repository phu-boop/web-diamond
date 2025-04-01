<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Truy vấn giỏ hàng và thông tin khách hàng
    $sql = "SELECT * FROM tbl_giohang, tbl_giohang_chitiet, tbl_dangky, tbl_vanchuyen 
            WHERE tbl_giohang.id_giohang = $id
            AND tbl_giohang.id_khachhang = tbl_dangky.id_dangky
            AND tbl_giohang.ma_giohang = tbl_giohang_chitiet.ma_giohang
            AND tbl_dangky.id_dangky = tbl_vanchuyen.id_dangky
            LIMIT 1";

    $query_sql = mysqli_query($mysqli, $sql);
    if (!$query_sql) {
        die("Lỗi truy vấn giỏ hàng: " . mysqli_error($mysqli));
    }

    // Truy vấn danh sách sản phẩm trong giỏ hàng
    $sql_list_sp = "SELECT tbl_sanpham.*, tbl_giohang_chitiet.soluong 
                    FROM tbl_sanpham, tbl_giohang, tbl_giohang_chitiet
                    WHERE tbl_giohang.id_giohang = $id
                    AND tbl_giohang.ma_giohang = tbl_giohang_chitiet.ma_giohang
                    AND tbl_giohang_chitiet.id_sanpham = tbl_sanpham.id_sanpham";

    $query_list_sp = mysqli_query($mysqli, $sql_list_sp);
    if (!$query_list_sp) {
        die("Lỗi truy vấn sản phẩm: " . mysqli_error($mysqli));
    }

    // Cập nhật trạng thái giỏ hàng
    $sql_status = "UPDATE tbl_giohang SET trangthai_giohang = 0 WHERE id_giohang = $id";
    mysqli_query($mysqli, $sql_status);
}
?>

<div class="page_detail">
        <div class="order-details">
            <h3>Chi tiết đơn hàng</h3>
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
                <?php $i = 0; while ($product_row = mysqli_fetch_assoc($query_list_sp)) {  $i++; ?>
                    <tr>
                        <td><img src="modules/productMNG/image_product/<?php echo $product_row['hinhanh']; ?>" alt="Oneplus 10"><?php echo $product_row['tensanpham']; ?></td>
                        <td><?php echo $product_row['giasp']; ?></td>
                        <td><?php echo $product_row['soluong']; ?></td>
                        <td><?php echo $product_row['soluong'] * $product_row['giasp']; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <div class="totals">
                <p>Tổng tiền trước thuế: <span>$2093</span></p>
                <p>Giảm giá: <span>$2</span></p>
                <p>Thuế: <span>$28</span></p>
                <p>Tổng cộng: <span>$2113</span></p>
            </div>
        </div>

        <div class="customer-details">
            <h4>Chi tiết khách hàng</h4>
            <?php while ($customer_row = mysqli_fetch_assoc($query_sql)) { ?>
                <div class="right">
                    <div class="customer-info">
                        <img src="https://via.placeholder.com/50" alt="Ảnh đại diện khách hàng" class="avatar">
                        <div class="details">
                            <p><strong> <?php echo $customer_row['tenkhachhang']; ?></strong></p>
                            <p>Mã khách hàng: #<?php echo $customer_row['id_giohang']; ?></p>
                            <p><?php echo $i; ?> Sản phẩm </p>
                            <div class="contact">
                                <p>Email: <a href="mailto:<?php echo $customer_row['email']; ?>"><?php echo $customer_row['email']; ?></a></p>
                                <p>Điện thoại: <a href="tel:<?php echo $customer_row['dienthoai']; ?>"><?php echo $customer_row['dienthoai']; ?></a></p>
                            </div>
                        </div>
                    </div>
                    <div class="shipping-address">
                        <p><?php echo $customer_row['diachi']; ?></p>
                        <p><?php echo $customer_row['ten']; ?></p>
                        <p><?php echo $customer_row['sdt']; ?></p>
                        <p><?php echo $customer_row['ghi_chu']; ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
</div>
