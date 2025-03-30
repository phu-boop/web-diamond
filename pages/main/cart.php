<?php
// Lấy giỏ hàng
if (!empty($_SESSION['cart'])) {
    $tongTien = 0;
    foreach ($_SESSION['cart'] as $item): 
        $thanhTien = $item['soluong'] * $item['giasp'];
        $tongTien += $thanhTien;
    endforeach;
    
    $original_price = $tongTien;
    
    // Xử lý khuyến mãi
    $today = date("Y-m-d H:i:s");
    $sql = "SELECT * FROM tbl_khuyenmai WHERE ngay_bd <= '$today' AND ngay_kt >= '$today'";
    $query = mysqli_query($mysqli, $sql);
    if (!$query) {
        die("Lỗi truy vấn: " . mysqli_error($mysqli));
    }

    if (isset($_POST['promotion_id'])) {
        $_SESSION['selected_promotion'] = $_POST['promotion_id']; // Lưu khuyến mãi vào session
    }
} else {
    echo "<p style='text-align:center; font-size:18px; color:red;'>Giỏ hàng của bạn đang trống!</p>";
}
?>

<div class="container_page_cart">
    <h2>🛒 Giỏ hàng của bạn</h2>

    <?php if (!empty($_SESSION['cart'])): ?>
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
                foreach ($_SESSION['cart'] as $item): 
                    $thanhTien = $item['soluong'] * $item['giasp'];
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
        <div class="promotion-container">
            <label>Chọn khuyến mãi:</label>
            <form method="POST" action="#">
                <select name="promotion_id" id="promotion_id" onchange="updatePrice()">
                    <option value="khongco" data-type="none" data-value="0" 
                        <?php echo (!isset($_SESSION['selected_promotion']) || $_SESSION['selected_promotion'] == 'khongco') ? 'selected' : ''; ?>>
                        Không áp dụng
                    </option>
                    <?php
                        while ($promo = mysqli_fetch_assoc($query)) { 
                            $selected = (isset($_SESSION['selected_promotion']) && $_SESSION['selected_promotion'] == $promo['id_khuyenmai']) ? 'selected' : '';
                            ?>
                            <option value="<?= $promo['id_khuyenmai'] ?>"
                                    data-type="<?= $promo['loai_khuyenmai'] ?>"
                                    data-value="<?= $promo['giatri'] ?>"
                                    <?= $selected ?>>
                                <?= $promo['ten_khuyenmai'] ?> 
                                (<?= $promo['loai_khuyenmai'] == 'phantram' ? 'Giảm ' . $promo['giatri'] . '%' :
                                    ($promo['loai_khuyenmai'] == 'codinh' ? 'Giảm ' . number_format($promo['giatri'], 0) . ' VND' :
                                    'Tặng ' . $promo['giatri'] . ' điểm') ?>)
                            </option>
                        <?php } ?>
                </select>
                <button name="chonkm">lưu</button>
            </form>

            <!-- Hiển thị giá -->
            <p>Giá gốc: <span id="original_price"><?= number_format($original_price, 0) ?> VND</span></p>
            <p>Giá sau khuyến mãi: <span id="discounted_price"><?= number_format($original_price, 0) ?> VND</span></p>
        </div>
    <?php endif; ?>

    <div class="btn-container">
        <a href="index.php" class="btn btn-primary">🔙 Tiếp tục mua hàng</a>
        <?php if(isset($_SESSION['dangky'])): ?>
            <a href="index.php?quanly=giohang&buoc=vanchuyen" id="payButton" class="btn btn-success">🛍 Tiếp tục</a>
        <?php else: ?>
            <a href="?quanly=dangky" class="btn btn-success">🛍 Đăng ký mua hàng</a>
        <?php endif; ?>
        <a href="pages/main/add_cart.php?xoatatca" class="btn btn-danger">🛍 Xóa tất cả</a>
    </div>
</div>

<!-- Script cập nhật giá -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
    // Lấy giá trị khuyến mãi từ PHP session
    <?php
    if (isset($_SESSION['selected_promotion'])) {
        $selectedPromotion = $_SESSION['selected_promotion'];
        
        // Truy vấn cơ sở dữ liệu để lấy chi tiết khuyến mãi
        $sql = "SELECT * FROM tbl_khuyenmai WHERE id_khuyenmai = '$selectedPromotion'";
        $query = mysqli_query($mysqli, $sql);
        $promo = mysqli_fetch_assoc($query);

        // Truyền các giá trị từ PHP vào JavaScript
        $promotion_type = $promo['loai_khuyenmai'];
        $promotion_value = $promo['giatri'];
    } else {
        $promotion_type = 'none';  // Không có khuyến mãi
        $promotion_value = 0;
    }
    ?>
    // Khởi tạo các biến trong JavaScript với giá trị từ PHP
    let promotionType = "<?php echo $promotion_type; ?>";
    let promotionValue = <?php echo $promotion_value; ?>;
    let originalPrice = <?= $original_price ?>;
    let discountedPrice = originalPrice;

    // Hàm cập nhật giá
    function updatePrice() {
        // Lấy phần tử select
        let select = document.getElementById("promotion_id");
        let selectedOption = select.options[select.selectedIndex];

        // Lấy loại khuyến mãi và giá trị khuyến mãi
        let type = selectedOption.getAttribute("data-type");
        let value = parseFloat(selectedOption.getAttribute("data-value")) || 0;

        // Nếu đã có khuyến mãi từ $_SESSION
        if (promotionType !== 'none') {
            type = promotionType;
            value = promotionValue;
        }

        // Tính giá sau khi áp dụng khuyến mãi
        discountedPrice = originalPrice;
        
        if (type === "phantram") {
            discountedPrice = originalPrice * (1 - value / 100);
        } else if (type === "codinh") {
            discountedPrice = originalPrice - value;
        }

        // Cập nhật giá sau khi giảm
        document.getElementById("discounted_price").textContent = discountedPrice.toLocaleString() + " VND";
    }

    // Gọi hàm cập nhật giá ngay khi trang tải xong
    updatePrice();

    // Cập nhật giá khi người dùng thay đổi lựa chọn khuyến mãi
    let selectElement = document.getElementById("promotion_id");
    selectElement.addEventListener("change", updatePrice);
});
    
</script>


<style>
    .container_page_cart {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        width: 80%;
        margin: auto;
        font-family: Arial, sans-serif;
    }

    h2 {
        text-align: center;
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th, table td {
        padding: 12px;
        border: 1px solid #ddd;
    }

    .promotion-container {
        margin-top: 20px;
    }

    .promotion-container label {
        display: block;
        font-weight: bold;
    }

    .btn-container {
        margin-top: 20px;
        text-align: center;
    }

    .btn {
        padding: 10px 20px;
        margin: 5px;
        border-radius: 5px;
        text-decoration: none;
        color: #fff;
    }

    .btn-danger {
        background-color: #f44336;
    }

    .btn-success {
        background-color: #28a745;
    }

    .btn-primary {
        background-color: #007bff;
    }

    .btn:hover {
        opacity: 0.9;
    }
</style>
