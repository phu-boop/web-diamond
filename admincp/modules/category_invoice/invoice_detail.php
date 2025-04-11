<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Truy vấn giỏ hàng và thông tin khách hàng
    $sql = "SELECT * FROM tbl_giohang, tbl_giohang_chitiet, tbl_dangky, tbl_vanchuyen,tbl_khuyenmai
            WHERE tbl_giohang.id_giohang = $id
            AND tbl_giohang.id_khachhang = tbl_dangky.id_dangky
            AND tbl_giohang.ma_giohang = tbl_giohang_chitiet.ma_giohang
            AND tbl_dangky.id_dangky = tbl_vanchuyen.id_dangky
            AND tbl_giohang.id_khuyenmai = tbl_khuyenmai.id_khuyenmai
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
                        <?php 
                        $i = 0; 
                        $tongtien = 0; 
                        while ($product_row = mysqli_fetch_assoc($query_list_sp)) { 
                            $i++;
                            $tongtien += $product_row['soluong'] * $product_row['giasp']; 
                        ?>
                        <tr>
                            <td id="product">
                                <img src="modules/productMNG/image_product/<?php echo $product_row['hinhanh']; ?>" alt="anh san phẩm">
                                <span><?php echo $product_row['tensanpham']; ?></span>
                            </td>
                            <td><?php echo number_format($product_row['giasp']); ?> VNĐ</td>
                            <td><?php echo $product_row['soluong']; ?></td>
                            <td><?php echo number_format($product_row['soluong'] * $product_row['giasp']); ?> VNĐ</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php while ($customer_row = mysqli_fetch_assoc($query_sql)) { ?>
                <div class="totals">
                    <p>
                        <p class="title">Tổng tiền:</p>
                        <span><?php echo number_format($tongtien); ?> VNĐ</span>
                    </p>
                    <?php
                    $thanhtien = $tongtien; // Initialize to avoid undefined variable
                    if (isset($customer_row['loai_khuyenmai']) && $customer_row['loai_khuyenmai'] == 'phantram') {
                        $thanhtien = $tongtien - $tongtien * $customer_row['giatri'] / 100;
                    ?>
                    <p>
                        <p class="title">Giảm giá:</p>
                        <span><?php echo $customer_row['giatri']; ?> %</span>
                    </p>
                    <?php
                    } elseif (isset($customer_row['loai_khuyenmai']) && $customer_row['loai_khuyenmai'] == 'codinh') {
                        $thanhtien = $tongtien - $customer_row['giatri'];
                    ?>
                    <p>
                        <p class="title">Giảm giá:</p>
                        <span><?php echo $customer_row['giatri']; ?> VNĐ</span>
                    </p>
                    <?php
                    } else {
                    ?>
                    <p>
                        <p class="title">Giảm giá:</p>
                        <span>0 VNĐ</span>
                    </p>
                    <?php } ?>
                    <p>
                        <p class="title">Thuế:</p>
                        <span>0 VNĐ</span>
                    </p>
                    <p>
                        <p class="title">Tổng cộng:</p>
                        <span>
                            <?php
                            if ($thanhtien == $customer_row['tongtien']) {
                                echo number_format($thanhtien);
                            } else {
                                echo "Đã có lỗi xảy ra";
                            }
                            ?> VNĐ
                        </span>
                    </p>
                </div>
            </div>
            <div class="customer-details">
                <div class="right">
                    <h3>Chi tiết khách hàng</h3>
                    <div class="customer-info">
                        <img src="../assets/images/avata.png" alt="Ảnh đại diện khách hàng" class="avatar">
                        <div class="details">
                            <div>
                                <p><strong><?php echo $customer_row['tenkhachhang']; ?></strong></p>
                                <p>Mã khách hàng: #<?php echo $customer_row['id_giohang']; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="customer-info">
                        <img src="../assets/images/cart.png" alt="">
                        <p><?php echo $i; ?> Sản phẩm</p>
                    </div>
                    <div class="contact">
                        <p>Email: <a href="mailto:<?php echo $customer_row['email']; ?>"><?php echo $customer_row['email']; ?></a></p>
                        <p>Điện thoại: <a href="tel:<?php echo $customer_row['dienthoai']; ?>"><?php echo $customer_row['dienthoai']; ?></a></p>
                    </div>
                </div>
                <div class="shipping-address">
                    <h3>Thông tin vận chuyển</h3>
                    <div class="contact">
                        <p>Người nhận: <?php echo $customer_row['ten']; ?></p>
                        <p>Số điện thoại: <?php echo $customer_row['sdt']; ?></p>
                        <p>Địa chỉ: <?php echo $customer_row['diachi']; ?></p>
                        <p>Ghi chú: <?php echo $customer_row['ghi_chu']; ?></p>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>