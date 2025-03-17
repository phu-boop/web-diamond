<?php
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Không tìm thấy sản phẩm!");
}
$id = (int)$_GET['id'];

$sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham = $id";
$result = mysqli_query($mysqli, $sql);

if (mysqli_num_rows($result) == 0) {
    die("Sản phẩm không tồn tại!");
}

$row = mysqli_fetch_assoc($result);
?>

<!-- <!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($row['tensanpham']); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .cart-container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .cart-item {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }
        .cart-item img {
            width: 120px;
            height: auto;
            border-radius: 5px;
            margin-right: 15px;
        }
        .cart-item .info {
            flex-grow: 1;
        }
        .cart-item h5 {
            margin-bottom: 5px;
        }
        .cart-item p {
            margin-bottom: 3px;
            font-size: 14px;
            color: #777;
        }
        .cart-total {
            font-size: 18px;
            font-weight: bold;
            text-align: right;
            padding-top: 10px;
        }
        .btn-buy {
            background-color: #c62828;
            color: white;
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
        }
        .btn-buy:hover {
            background-color: #a82727;
        }
        .quantity-input {
            width: 60px;
            text-align: center;
            font-size: 16px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="cart-container">
        <h3 class="text-center">Giỏ hàng của bạn</h3>

        <div class="cart-item">
            <img src="admincp/modules/productMNG/image_product/<?php echo htmlspecialchars($row['hinhanh']); ?>" 
                 alt="<?php echo htmlspecialchars($row['tensanpham']); ?>">
            <div class="info">
                <h5><?php echo htmlspecialchars($row['tensanpham']); ?></h5>
                <p>Mã sản phẩm: <?php echo htmlspecialchars($row['masp']); ?></p>
                <h4 class="text-danger"><?php echo number_format($row['giasp'], 0, ',', '.'); ?> đ</h4>
            </div>
            <div>
                <input type="number" class="form-control quantity-input" value="1" min="1" max="<?php echo $row['soluong']; ?>">
            </div>
        </div>

     
        <div class="cart-total">
            Tổng tiền: <span class="text-danger"><?php echo number_format($row['giasp'], 0, ',', '.'); ?> đ</span>
        </div>

    
        <form method="POST" action="pages/main/add_cart.php?id=<?php echo $id; ?>">
            <button type="submit" name="themgiohang" class="btn btn-buy mt-3">Mua ngay</button>
        </form>
    </div>
</div>

</body>
</html> -->




<div class="product-container">
    <div class="describe">
        <div class="product-image">
            <img src="admincp/modules/productMNG/image_product/<?php echo $row['hinhanh'] ; ?>" alt="Product Image"> 
        </div>
        <div class="product-details">
            <h1 class="product-title">Nhẫn Vàng trắng 10K đính đá ECZ PNJ XMXMW062087</h1>
            <div class="product-title-detail">
                <p class="product-code">Mã: GNXMXMW062087</p>
                <p class="rating"><i class="fa-solid fa-star"></i>(0)  còn hàng <?php echo $row['soluong'] ?></p>
            </div>
            <div class="price">
                <p class="product-price"><?php echo number_format($row['giasp'], 0, ',', '.') . ' VNĐ'; ?></p>
                <p class="Installment">chỉ cần trả <?php echo number_format($row['giasp']/12, 0, ',', '.') . ' VNĐ'; ?>/tháng <img src="assets/images/pngegg.png" alt=""></p>
            </div>
            <div class="product-size">
                <div>
                    <p>Giá sản phẩm thay đổi tùy trọng lượng vàng và đá</p>
                    <label for="size">Chọn kích cỡ:</label>
                    <select id="size">
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                    <p>Còn hàng - cell-phone Nhấn <img src="assets/images/zalo.svg" alt=""> để được tư vấn và nhận ưu đãi</p>
                </div>
                <div>
                    Cách do size lắc
                </div>
            </div>
            <div class="offer-box">
                <div class="offer-title">Ưu đãi:</div>
                <div class="offer-content">
                    <span class="icon">✔</span>
                    <span>Ưu đãi thêm 200K cho hóa đơn từ 2.5 triệu bằng thẻ tín dụng Muadee by HDBank 
                        <a href="#">Xem chi tiết</a>
                    </span>
                </div>
            </div>
            <div class="policy-container">
                <div class="policy-item">
                    <img src="assets/images/shopping_1.svg" alt="Giao hàng">
                    <span>Miễn phí giao hàng</span>
                </div>
                <div class="policy-item">
                    <img src="assets/images/shopping_2.svg" alt="Dịch vụ">
                    <span>Phục vụ 24/7</span>
                </div>
                <div class="policy-item">
                    <img src="assets/images/shopping_3.svg" alt="Thu đổi">
                    <span>Thu đổi 48h</span>
                </div>
            </div>
            <div>
                <a href="#" class="btn btn-main">
                    Mua ngay <br>
                    <small>Giao hàng miễn phí tận nhà hoặc nhận tại cửa hàng</small>
                </a>
            </div>
                        <div class="btn-secondary-container">
                <a href="#" class="btn btn-secondary">
                    Thêm vào giỏ hàng
                </a>
                <a href="#" class="btn btn-secondary">
                    Gọi ngay (miễn phí) <br>
                    <small>Nhận ngay ưu đãi</small>
                </a>
            </div>
            <div class="product-buttons">
            </div>
        </div>
    </div>
</div>




