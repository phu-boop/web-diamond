<?php
$sql_lietke_sanpham_dangcap = "SELECT * FROM tbl_sanpham ORDER BY giasp DESC LIMIT 4";
$query_lietke_sanpham_dangcap = mysqli_query($mysqli, $sql_lietke_sanpham_dangcap);

$sql_lietke_danhmucsp = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC LIMIT 20";
$query_lietke_danhmucsp = mysqli_query($mysqli, $sql_lietke_danhmucsp);
?>
<div class="slider">
        <div class="slides">
            <div class="slide"><img src="assets/images/main_1.jpg" alt="Ảnh 1"></div>
            <div class="slide"><img src="assets/images/main_2.jpg" alt="Ảnh 2"></div>
            <div class="slide"><img src="assets/images/main_3.jpg" alt="Ảnh 3"></div>
        </div>
        <button class="prev" onclick="prevSlide()">&#10094;</button>
        <button class="next" onclick="nextSlide()">&#10095;</button>
        <div class="dots-container" id="dotsContainer"></div>
    </div>
<div class="container">
    <div class="content-1">
        <h2>Bộ sưu tập trang sức đẳng cấp</h2>
        <div class="container collection">
            <?php while ($row = mysqli_fetch_array($query_lietke_sanpham_dangcap)) { ?>
                <div class="product">
                    <a href="index.php?quanly=chitietsanpham&id=<?php echo $row['id_sanpham']; ?>">
                        <img src="admincp/modules/productMNG/image_product/<?php echo $row['hinhanh']; ?>" alt="ảnh sản phẩm">
                        <h4><?php echo $row['tensanpham']; ?></h4>
                        <p class="price"><?php echo number_format($row['giasp'], 0, ',', '.'); ?>đ</p>
                        <p class="promo">bộ sưu tập trang sức đẳng cấp</p>
                        <p class="quantity">chỉ còn <?php echo $row['soluong'] ;?></p>
                    </a>
                </div>
            <?php } ?>
        </div>
        <button class="btn">Xem thêm</button>
    </div>
    <div class="content-2">
        <h2>Bạn đang tìm gì hôm nay?</h2>
        <div class="directory_list">
            <?php while ($row = mysqli_fetch_array($query_lietke_danhmucsp)) { ?>
                <a href="index.php?quanly=sanpham&id=<?php echo $row['id_danhmuc']; ?>">
                    <div class="directory">
                        <div class="img">
                            <img src="./images/kim_cuong.png" alt="">
                        </div>
                        <p><?php echo $row['tendanhmuc']; ?></p>
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>
</div>
