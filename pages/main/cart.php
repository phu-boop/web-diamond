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
    <!-- Available Offers Section -->
    <div class="offers">
        <div class="offer-icon">💎</div>
        <div class="offer-text">
            <h3>Available Offers</h3>
            <p>- 10% Instant Discount on Bank of America Corp Bank Debit and Credit cards</p>
            <p>- 25% Cashback Voucher of up to $60 on first ever PayPal transaction. T&C</p>
        </div>
        <span class="close-btn">×</span>
    </div>

    <!-- Shopping Bag Section -->
    <div class="shopping-bag">
        <h2>🛒 Giỏ hàng của bạn (<?php echo !empty($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?> Items)</h2>

        <?php if (!empty($_SESSION['cart'])): ?>
            <?php 
            $tongTien = 0;
            foreach ($_SESSION['cart'] as $item): 
                $thanhTien = $item['soluong'] * $item['giasp'];
                $tongTien += $thanhTien;
            ?>
                <div class="product">
                    <img src="<?= $item['hinhanh']; ?>" alt="<?= $item['tensanpham']; ?>">
                    <div class="product-details">
                        <h4><?= $item['tensanpham']; ?> (Mã: <?= $item['masp']; ?>)</h4>
                        <p class="sold-by">Sold by: Seller</p>
                        <p class="stock-status in-stock">In Stock</p>
                        <div class="rating">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>☆</span>
                        </div>
                        <div class="quantity">
                            <a href="pages/main/add_cart.php?giam=<?= $item['id'] ?>">➖</a>
                            <input type="number" value="<?= $item['soluong']; ?>" min="1" readonly>
                            <a href="pages/main/add_cart.php?cong=<?= $item['id'] ?>">➕</a>
                        </div>
                    </div>
                    <div class="product-actions">
                        <p class="price"><?= number_format($item['giasp'], 0, ',', '.'); ?> VND</p>
                        <p class="total-price">Tổng: <?= number_format($thanhTien, 0, ',', '.'); ?> VND</p>
                        <button class="wishlist-btn">Move to wishlist</button>
                        <a href="pages/main/add_cart.php?xoa=<?= $item['id'] ?>" class="remove-btn">×</a>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Promotion Section -->
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
                    <button name="chonkm">Lưu</button>
                </form>

                <!-- Hiển thị giá -->
                <p>Giá gốc: <span id="original_price"><?= number_format($tongTien, 0, ',', '.'); ?> VND</span></p>
                <p>Giá sau khuyến mãi: <span id="discounted_price"><?= number_format($tongTien, 0, ',', '.'); ?> VND</span></p>
            </div>

            <!-- Buttons -->
            <div class="btn-container">
                <a href="index.php" class="btn btn-primary">🔙 Tiếp tục mua hàng</a>
                <?php if(isset($_SESSION['dangky'])): ?>
                    <a href="index.php?quanly=giohang&buoc=vanchuyen" id="payButton" class="btn btn-success">🛍 Tiếp tục</a>
                <?php else: ?>
                    <a href="?quanly=dangky" class="btn btn-success">🛍 Đăng ký mua hàng</a>
                <?php endif; ?>
                <a href="pages/main/add_cart.php?xoatatca" class="btn btn-danger">🛍 Xóa tất cả</a>
            </div>
        <?php else: ?>
            <p>Giỏ hàng của bạn đang trống!</p>
        <?php endif; ?>
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
        let originalPrice = <?= $tongTien ?>;
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

    /* Offers Section */
    .offers {
        background-color: #e6f4e6;
        padding: 15px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        position: relative;
        margin-bottom: 20px;
    }

    .offer-icon {
        font-size: 24px;
        margin-right: 10px;
    }

    .offer-text h3 {
        font-size: 16px;
        margin-bottom: 5px;
    }

    .offer-text p {
        font-size: 14px;
        color: #333;
    }

    .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        cursor: pointer;
    }

    /* Shopping Bag Section */
    .shopping-bag {
        background-color: #fff;
        padding: 0;
    }

    .shopping-bag h2 {
        font-size: 20px;
        color: #333;
        margin-bottom: 20px;
        text-align: left;
    }

    .product {
        display: flex;
        align-items: center;
        border-bottom: 1px solid #eee;
        padding: 15px 0;
    }

    .product img {
        width: 80px;
        height: 80px;
        margin-right: 15px;
    }

    .product-details {
        flex: 1;
    }

    .product-details h4 {
        font-size: 16px;
        color: #333;
        margin-bottom: 5px;
    }

    .sold-by {
        font-size: 12px;
        color: #666;
        margin-bottom: 5px;
    }

    .stock-status {
        font-size: 12px;
        margin-bottom: 5px;
    }

    .in-stock {
        color: #28a745;
        background-color: #e6f4e6;
        padding: 2px 5px;
        border-radius: 3px;
    }

    .rating span {
        color: #f5c518;
        font-size: 14px;
    }

    .quantity {
        display: flex;
        align-items: center;
        margin-top: 10px;
    }

    .quantity a {
        text-decoration: none;
        font-size: 16px;
        margin: 0 10px;
        color: #007bff;
    }

    .quantity input {
        width: 50px;
        padding: 5px;
        border: 1px solid #ddd;
        border-radius: 5px;
        text-align: center;
    }

    .product-actions {
        text-align: right;
    }

    .price, .total-price {
        font-size: 16px;
        color: #333;
        margin-bottom: 10px;
    }

    .wishlist-btn {
        background-color: #f0f0ff;
        border: 1px solid #ddd;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 12px;
        margin-bottom: 10px;
    }

    .remove-btn {
        font-size: 20px;
        cursor: pointer;
        color: #666;
        text-decoration: none;
    }

    /* Promotion Section */
    .promotion-container {
        margin-top: 20px;
    }

    .promotion-container label {
        font-size: 16px;
        color: #333;
        display: block;
        font-weight: bold;
    }

    .promotion-container select {
        padding: 5px;
        margin: 10px 0;
        width: 100%;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .promotion-container button {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
    }

    .promotion-container p {
        font-size: 14px;
        margin: 5px 0;
    }

    /* Buttons */
    .btn-container {
        display: flex;
        justify-content: space-between;
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

    .btn-primary {
        background-color: #007bff;
    }

    .btn-success {
        background-color: #28a745;
    }

    .btn-danger {
        background-color: #dc3545;
    }

    .btn:hover {
        opacity: 0.9;
    }
</style>