<?php


// Lấy ID sản phẩm từ URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Không tìm thấy sản phẩm!");
}
$id = (int)$_GET['id'];

// Truy vấn sản phẩm theo ID
$sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham = $id";
$result = mysqli_query($mysqli, $sql);

// Kiểm tra sản phẩm có tồn tại không
if (mysqli_num_rows($result) == 0) {
    die("Sản phẩm không tồn tại!");
}

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($row['tensanpham']); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css"> <!-- File CSS tùy chỉnh -->
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <!-- Hình ảnh sản phẩm -->
        <div class="col-md-5">
            <img src="admincp/modules/productMNG/image_product/<?php echo htmlspecialchars($row['hinhanh']); ?>" 
                 class="img-fluid rounded shadow" 
                 alt="<?php echo htmlspecialchars($row['tensanpham']); ?>">
        </div>

        <!-- Thông tin sản phẩm -->
        <div class="col-md-7">
            <h2 class="fw-bold"><?php echo htmlspecialchars($row['tensanpham']); ?></h2>
            <p class="text-muted">Mã sản phẩm: <?php echo htmlspecialchars($row['masp']); ?></p>
            <h3 class="text-danger"><?php echo number_format($row['giasp'], 0, ',', '.'); ?> đ</h3>

            <p><strong>Tình trạng:</strong> 
                <?php echo ($row['trangthai'] == 1) ? "<span class='text-success'>Còn hàng</span>" : "<span class='text-danger'>Hết hàng</span>"; ?>
            </p>

            <p><strong>Mô tả ngắn:</strong> <?php echo nl2br(htmlspecialchars($row['tomtat'])); ?></p>

            <form method="POST" action="pages/main/add_cart.php?id=<?php echo $id; ?>">
                <label for="soluong">Số lượng:</label>
                <input type="number" name="soluong" value="1" min="1" max="<?php echo $row['soluong']; ?>" class="form-control w-25">
                <button type="submit" name="themgiohang" class="btn btn-primary mt-3">Thêm vào giỏ hàng</button>
            </form>
        </div>
    </div>

    <!-- Nội dung chi tiết sản phẩm -->
    <div class="mt-5">
        <h4>Mô tả chi tiết</h4>
        <p><?php echo nl2br(htmlspecialchars($row['noidung'])); ?></p>
    </div>
</div>

</body>
</html>
