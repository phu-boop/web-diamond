


    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 30px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #333;
            color: white;
        }
        img {
            width: 70px;
            height: auto;
        }
        .btn {
            display: inline-block;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }
        .btn-danger {
            background-color: red;
            color: white;
            border: none;
        }
        .btn-primary {
            background-color: blue;
            color: white;
            border: none;
        }
        .btn-success {
            background-color: green;
            color: white;
            border: none;
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
    </style>


<div class="container">
    <h2>🛒 Giỏ hàng của bạn</h2>
    
    <?php if (!empty($_SESSION['cart'])): ?>
        <table>
            <thead>
                <tr>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Mã SP</th>
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
                        <td><a href="pages/main/add_cart.php?cong=<?php echo $item['id']?>">cong</a><?= $item['soluong']; ?><a href="pages/main/add_cart.php?giam=<?php echo $item['id']?>">giam</a></td>
                        <td><?= number_format($item['giasp'], 0, ',', '.'); ?> VND</td>
                        <td><?= number_format($thanhTien, 0, ',', '.'); ?> VND</td>
                        <td>
                            <a href="pages/main/add_cart.php?xoa=<?php echo $item['id'] ?>"><button class="btn btn-danger">🗑 Xóa</button> </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php
                    $original_price = $tongTien; // Giá gốc, giả sử 1,000,000 VND
                    $today = date("Y-m-d H:i:s");
                    $sql = "SELECT * FROM tbl_khuyenmai WHERE ngay_bd <= '$today' AND ngay_kt >= '$today'";
                    $query = mysqli_query($mysqli, $sql);
                    ?>

                    <label>Chọn khuyến mãi:</label>
                    <form method="post">
                        <select name="promotion_id" id="promotion_id" onchange="updatePrice()">
                            <option value="khongco" data-type="none" data-value="0">Không áp dụng</option>
                            <?php while ($promo = mysqli_fetch_array($query)) { ?>
                                <option value="<?= $promo['id_khuyenmai'] ?>"
                                        data-type="<?= $promo['loai_khuyenmai'] ?>"
                                        data-value="<?= $promo['giatri'] ?>"
                                    <?= isset($_POST['promotion_id']) && $_POST['promotion_id'] == $promo['id_khuyenmai'] ? "selected" : "" ?>
                                >
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
                            // 'diem' không ảnh hưởng giá, chỉ tặng điểm

                            document.getElementById("discounted_price").textContent = discountedPrice.toLocaleString() + " VND";
                        }

                        // Gọi lại khi trang load để giữ giá trị khuyến mãi đã chọn
                        updatePrice();
                    </script>

            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5" style="text-align:right">Tổng tiền:</th>
                    <th><?= number_format($tongTien, 0, ',', '.'); ?> VND</th>
                    <th></th>
                </tr>
                <tr>
                    <th colspan="5" style="text-align:right">Giảm giá</th>
                    <?php if($_POST['promotion_id']=='khongco') { ?>
                        <th>không có</th>
                    <?php } ?>

                    <th><?= number_format($tongTien, 0, ',', '.'); ?> VND</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>

        <div class="btn-container">
            <a href="index.php" class="btn btn-primary">🔙 Tiếp tục mua hàng</a>
                <?php
            if(isset($_SESSION['dangky']))
            {   ?>
                <a href="pages/main/payment.php" class="btn btn-success">🛍 Thanh toán</a>
                <?php
            }else
            {
            ?>
                <a href="?quanly=dangky" class="btn btn-success">🛍 Đăng ký mua hàng </a>
            <?php } ?>
            <a href="pages/main/add_cart.php?xoatatca" class="btn btn-success">🛍 Xóa tất cả</a>
        </div>

    <?php else: ?>
        <p style="text-align:center; font-size:18px; color:red;">Giỏ hàng của bạn đang trống!</p>
    <?php endif; ?>

</div>
<script>
document.getElementById("promotion_id").addEventListener("change", function() {
    let selectedValue = this.value;
    let message = document.getElementById("promotion_message");

    if (selectedValue) {
        message.textContent = "Bạn đã chọn khuyến mãi: " + this.options[this.selectedIndex].text;
    } else {
        message.textContent = "Vui lòng chọn khuyến mãi.";
    }
});
</script>


