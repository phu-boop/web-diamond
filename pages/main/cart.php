<div class="container">
    

            <div class="btn-container">
                    <a href="index.php" class="btn btn-primary">🔙 Tiếp tục mua hàng</a>
                    <?php if(isset($_SESSION['dangky'])): ?>
                        <a href="pages/main/payment.php" class="btn btn-success">🛍 Thanh toán</a>
                    <?php else: ?>
                        <a href="?quanly=dangky" class="btn btn-success">🛍 Đăng ký mua hàng</a>
                    <?php endif; ?>
                    <a href="pages/main/add_cart.php?xoatatca" class="btn btn-danger">🛍 Xóa tất cả</a>
            </div>
    <h2>🛒 Giỏ hàng của bạn</h2>
    <?php if (!empty($_SESSION['cart'])){ ?>
        <table>
            <thead>
                <tr>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Mã S</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng tiền</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $tongTien = 0;
                foreach ($_SESSION['cart'] as $item): 
                    $thanhTien = $item['soluong'] * $item['giasp'];
                    $tongTien += $thanhTien;
                ?>
                    <tr>
                        <td><img src="<?= $item['hinhanh']; ?>" alt="<?= $item['tensanpham']; ?>"></td>
                        <td><?= $item['tensanpham']; ?></td>
                        <td><?= $item['masp']; ?></td>
                        <td>
                            <a href="pages/main/add_cart.php?cong=<?= $item['id'] ?>">➕</a>
                            <?= $item['soluong']; ?>
                            <a href="pages/main/add_cart.php?giam=<?= $item['id'] ?>">➖</a>
                        </td>
                        <td><?= number_format($item['giasp'], 0, ',', '.'); ?> VND</td>
                        <td><?= number_format($thanhTien, 0, ',', '.'); ?> VND</td>
                        <td>
                            <a href="pages/main/add_cart.php?xoa=<?= $item['id'] ?>" class="btn btn-danger">🗑 Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

            <tfoot>
                <tr>
                    <th colspan="5" style="text-align:right">Tổng tiền:</th>
                    <th><?= number_format($tongTien, 0, ',', '.'); ?> VND</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>

        <!-- Chọn khuyến mãi -->
        <?php
            $original_price = $tongTien;
            $today = date("Y-m-d H:i:s");
            $sql = "SELECT * FROM tbl_khuyenmai WHERE ngay_bd <= '$today' AND ngay_kt >= '$today'";
            $query = mysqli_query($mysqli, $sql);
            if (!$query) {
                die("Lỗi truy vấn: " . mysqli_error($mysqli));
            }
            if (mysqli_num_rows($query) == 0) {
                echo "Không có khuyến mãi nào khả dụng.";
            }
        ?>
        <div class="promotion-container">
            <label>Chọn khuyến mãi:</label>
            <form method="post">
                <select name="promotion_id" id="promotion_id" onchange="updatePrice()">
                    <option value="khongco" data-type="none" data-value="0">Không áp dụng</option>
                    <?php while ($promo = mysqli_fetch_assoc($query)) { ?>
                        <option value="<?= $promo['id_khuyenmai'] ?>"
                                data-type="<?= $promo['loai_khuyenmai'] ?>"
                                data-value="<?= $promo['giatri'] ?>"
                            <?= isset($_POST['promotion_id']) && $_POST['promotion_id'] == $promo['id_khuyenmai'] ? "selected" : "" ?>>
                            <?= $promo['ten_khuyenmai'] ?> 
                            (<?= $promo['loai_khuyenmai'] == 'phantram' ? 'Giảm ' . $promo['giatri'] . '%' :
                            ($promo['loai_khuyenmai'] == 'codinh' ? 'Giảm ' . number_format($promo['giatri'], 0) . ' VND' :
                            'Tặng ' . $promo['giatri'] . ' điểm') ?>)
                        </option>
                    <?php } ?>
                </select>
            </form>

            <!-- Hiển thị giá -->
            <p>Giá gốc: <span id="original_price"><?= number_format($original_price, 0) ?> VND</span></p>
            <p>Giá sau khuyến mãi: <span id="discounted_price"><?= number_format($original_price, 0) ?> VND</span></p>
            
        </div>

    <?php } else{ ?>
        <p style="text-align:center; font-size:18px; color:red;">Giỏ hàng của bạn đang trống!</p>
    <?php } ?>
</div>
<!-- Các nút điều hướng -->

<!-- Script cập nhật giá -->
<script>
    function updatePrice() {
        let select = document.getElementById("promotion_id");
        let selectedOption = select.options[select.selectedIndex];

        let type = selectedOption.getAttribute("data-type");
        let value = parseFloat(selectedOption.getAttribute("data-value")) || 0;
        let originalPrice = <?= $original_price ?>;
        let discountedPrice = originalPrice;

        if (type === "phantram") {
            discountedPrice = originalPrice * (1 - value / 100);
        } else if (type === "codinh") {
            discountedPrice = originalPrice - value;
        }

        document.getElementById("discounted_price").textContent = discountedPrice.toLocaleString() + " VND";

        // Cập nhật link thanh toán
        updatePaymentLink();
    }

    function updatePaymentLink() {
        let select = document.getElementById("promotion_id");
        let selectedPromotionId = select.value;
        let paymentLink = document.getElementById("paymentLink");

        // Cập nhật href của nút thanh toán
        paymentLink.href = "pages/main/payment.php?promotion_id=" + selectedPromotionId;
    }

    // Gọi lại khi trang load để giữ giá trị khuyến mãi đã chọn
    document.addEventListener("DOMContentLoaded", () => {
        updatePrice();
        updatePaymentLink();
    });
</script>

