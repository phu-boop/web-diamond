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
}
?>
<div class="container_page_cart">
    <!-- Available Offers Section -->
    <div class="offers">
        <div class="offer-icon">💎</div>
        <div class="offer-text">
            <h3>Các Phương Thức Thanh Toán</h3>
            <p>- Thanh toán bằng thẻ ghi nợ hoặc thẻ tín dụng của Bank of Momo.</p>
            <p>- Sử dụng PayPal cho giao dịch đầu tiên. Có điều kiện áp dụng (T&C).</p>
        </div>
        <span class="close-btn">×</span>
    </div>

    <!-- Shopping Bag Section -->
    <div class="shopping-bag">
        <h2>Giỏ hàng của bạn (<?php echo !empty($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?> Items)</h2>
            <?php if (!empty($_SESSION['cart'])): ?>
                <?php 
                $tongTien = 0;
                foreach ($_SESSION['cart'] as $item): 
                    $thanhTien = $item['soluong'] * $item['giasp'];
                    $tongTien += $thanhTien;
                ?>
                    <div class="product">
                        <img src="admincp/modules/productMNG/image_product/<?= $item['hinhanh']; ?>" alt="<?= $item['tensanpham']; ?>">
                        <div class="product-details">
                            <h4><?= $item['tensanpham']; ?> (Mã: <?= $item['masp']; ?>)</h4>
                            <div class="decription">
                                <p class="sold-by">Được bán bởi: Luxury</p>
                                <p class="stock-status in-stock">Còn hàng</p>
                            </div>
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
                            <a href="index.php?quanly=chitietsanpham&id=<?= $item['id']; ?>" class="wishlist-btn">Xem chi tiết</a>
                            <p class="price"><?= number_format($item['giasp'], 0, ',', '.'); ?> VND</p>
                            <p class="total-price">Tổng: <?= number_format($thanhTien, 0, ',', '.'); ?> VND</p>
                            
                            <a href="pages/main/add_cart.php?xoa=<?= $item['id'] ?>" class="remove-btn">×</a>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Promotion Section -->
                 <div class="wrapper_promotion">
                    <div class="promotion-container">
                        <!-- Phần Offer -->
                        <div class="offer-section">
                            <h3>Ưu đãi</h3>
                            <div class="promo-code">
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
                                    <button name="chonkm" class="apply-btn">Lưu</button>
                                </form>
                            </div>
                            <div class="gift-wrap">
                                <p>Mua quà cho người thân yêu?</p>
                                <p>Đóng gói quà tặng và ghi lời nhắn cá nhân trên thiệp, chỉ với 50.000 VND.</p>
                                <a href="#" class="gift-link">Thêm gói quà tặng</a>
                            </div>
                        </div>

                        <!-- Phần Price Details -->
                        <div class="price-details">
                            <h3>Chi tiết giá</h3>
                            <div class="price-item">
                                <span>Tổng giỏ hàng</span>
                                <span id="bag-total"><?= number_format($tongTien, 0, ',', '.'); ?> VND</span>
                            </div>
                            <div class="price-item">
                                <span>Giảm giá mã khuyến mãi</span>
                                <a href="#" class="apply-coupon">Áp dụng mã</a>
                            </div>
                            <div class="price-item">
                                <span>Tổng đơn hàng</span>
                                <span id="order-total"><?= number_format($tongTien, 0, ',', '.'); ?> VND</span>
                            </div>
                            <div class="price-item">
                                <span>Phí giao hàng</span>
                                <span class="free-shipping">Free</span>
                            </div>
                            <div class="price-item">
                                <span>Bạn đã tiết kiệm</span>
                                <span id="total_discount"><?= number_format($tongTien, 0, ',', '.');?> VND</span>
                            </div>
                            <div class="price-item total">
                                <span>Tổng cộng</span>
                                <span id="final-total"><?= number_format($tongTien, 0, ',', '.'); ?> VND</span>
                            </div>
                        </div>
                    </div>
                    <?php if(isset($_SESSION['dangky'])): ?>
                        <a href="index.php?quanly=giohang&buoc=vanchuyen" id="payButton" class="btn btn-success">Tiếp tục</a>
                    <?php else: ?>
                        <a href="?quanly=dangky" class="btn btn-success">Đăng ký đặt hàng</a>
                    <?php endif; ?>
                </div>

                <!-- Buttons -->
                <div class="btn-container">
                    <a href="pages/main/add_cart.php?xoatatca" class="btn btn-danger">🛍 Xóa tất cả</a>
                    <a href="index.php?quanly=sanpham" class="btn btn-primary"><i class="fa-regular fa-hand-point-left"></i> <span> Tiếp tục mua hàng</span></a>
                </div>
            <?php else: ?>
                <p class="page_cart_empty">Giỏ hàng của bạn đang trống!</p>
            <?php endif; ?>
    </div>
</div>

<!-- Script cập nhật giá -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Khởi tạo giá trị ban đầu
    let originalPrice = <?= $tongTien ?>;
    let discountedPrice = originalPrice;

    // Hàm cập nhật giá
    function updatePrice() {
        // Lấy phần tử select
        let select = document.getElementById("promotion_id");
        let selectedOption = select.options[select.selectedIndex];

        // Lấy loại khuyến mãi và giá trị khuyến mãi từ option được chọn
        let type = selectedOption.getAttribute("data-type");
        let value = parseFloat(selectedOption.getAttribute("data-value")) || 0;

        // Tính giá sau khi áp dụng khuyến mãi
        discountedPrice = originalPrice;

        if (type === "phantram") {
            discountedPrice = originalPrice * (1 - value / 100);
        } else if (type === "codinh") {
            discountedPrice = originalPrice - value;
        }

        // Đảm bảo giá không âm
        if (discountedPrice < 0) {
            discountedPrice = 0;
        }
        let save = originalPrice - discountedPrice;
        console.log(save);
        // Cập nhật giá vào giao diện
        document.getElementById("bag-total").textContent = originalPrice.toLocaleString('vi-VN') + " VND";
        document.getElementById("order-total").textContent = discountedPrice.toLocaleString('vi-VN') + " VND";
        document.getElementById("final-total").textContent = discountedPrice.toLocaleString('vi-VN') + " VND";
        document.getElementById("total_discount").textContent = save.toLocaleString('vi-VN') + " VND";
    }

    // Gọi hàm cập nhật giá ngay khi trang tải xong
    updatePrice();

    // Cập nhật giá khi người dùng thay đổi lựa chọn khuyến mãi
    let selectElement = document.getElementById("promotion_id");
    selectElement.addEventListener("change", updatePrice);
});
document.addEventListener("DOMContentLoaded", function() {
    // Thêm sự kiện click cho gift-link
    let giftLink = document.querySelector(".gift-link");
    giftLink.addEventListener("click", function(event) {
        event.preventDefault(); // Ngăn liên kết chuyển hướng (vì hiện tại href="#")
        alert("Rất tiếc, chương trình đóng gói quà tặng đã kết thúc. Hãy theo dõi để cập nhật các ưu đãi mới nhé!.");
    });
});
document.addEventListener("DOMContentLoaded", function() {
    const currentUrl = window.location.href;
    if (currentUrl.includes("buoc=giamgia")) {
        const element = document.querySelector(".content_page_cart_bottom");
        if (element) {
            element.classList.add("active");
        }
    }
});
// Lấy tất cả các phần tử có class 'close-btn'
const closeButtons = document.querySelectorAll('.close-btn');

// Lặp qua từng button và thêm sự kiện click
closeButtons.forEach(button => {
    button.addEventListener('click', () => {
        // Lấy phần tử có class 'offers'
        const offers = document.querySelector('.offers');
        // Thêm class 'hide' vào phần tử offers
        offers.classList.add('active');
    });
})
// Lấy element content_page_cart_bottom
const contentElement = document.querySelector('.content_page_cart_bottom');
// Lấy element wrapper_cart
const wrapperElement = document.querySelector('.wrapper_cart');

// Lấy height của contentElement
const height = contentElement.offsetHeight +300;

// Gán height vào wrapperElement
wrapperElement.style.height = height + 'px';
</script>