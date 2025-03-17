<?php
$sql_lietke_sanpham_dangcap = "SELECT * FROM tbl_sanpham ORDER BY giasp DESC LIMIT 4";
$query_lietke_sanpham_dangcap = mysqli_query($mysqli, $sql_lietke_sanpham_dangcap);

$sql_lietke_danhmucsp = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC LIMIT 20";
$query_lietke_danhmucsp = mysqli_query($mysqli, $sql_lietke_danhmucsp);

$sql_lietke_tintuc = "SELECT * FROM tbl_baiviet ORDER BY id_baiviet DESC LIMIT 2";
$query_lietke_tintuc = mysqli_query($mysqli, $sql_lietke_tintuc);
$sql_lietke_danhmucsp_gallery = "
    SELECT tbl_sanpham.*, tbl_danhmuc.tendanhmuc 
    FROM tbl_danhmuc 
    JOIN tbl_sanpham ON tbl_danhmuc.id_danhmuc = tbl_sanpham.id_danhmuc 
    ORDER BY tbl_danhmuc.id_danhmuc DESC 
    LIMIT 5
";

$query_lietke_danhmucsp_gallery = mysqli_query($mysqli, $sql_lietke_danhmucsp_gallery);

// Kiểm tra lỗi truy vấn
if (!$query_lietke_danhmucsp_gallery) {
    die("Lỗi truy vấn: " . mysqli_error($mysqli));
}

// Lấy dữ liệu
while ($row = mysqli_fetch_array($query_lietke_danhmucsp_gallery)) {
    echo "Tên sản phẩm: " . $row['tensanpham'] . "<br>";
}


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
                            <img src="admincp/modules/category_productMNG/image_category/<?php echo $row['hinhanh']; ?>" alt="">
                        </div>
                        <p><?php echo $row['tendanhmuc']; ?></p>
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>
    <div class="content-3"> 
        <div class="gallery">
            <div class="gallery-container">
                <img src="https://cdn.pnj.io/images/promo/238/BST_Sakura__1200x1200.jpg" alt="" class="gallery-item gallery-item-1" data-index="1">
                <img src="https://cdn.pnj.io/images/promo/238/BANNER_BST_Audax_1200x1200.png" alt="" class="gallery-item gallery-item-2" data-index="2">
                <img src="https://cdn.pnj.io/images/promo/238/BST_BISOUS_BANNER_1200x1200.png" alt="" class="gallery-item gallery-item-3" data-index="3">
                <img src="https://cdn.pnj.io/images/promo/238/BST_Sakura__1200x1200.jpg" alt="" class="gallery-item gallery-item-4" data-index="4">
                <img src="https://cdn.pnj.io/images/promo/238/BST_Sakura__1200x1200.jpg" alt="" class="gallery-item gallery-item-5" data-index="5">
            </div>
            <div class="gallery-controls"></div>
        </div>
        <div class="product-container">
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
    </div>
    <div class="content-4">
        <h2>Tin tức</h2>
        <div class="content-4-main">
            <div class="gold-price">
                <a href="?quanly=xemgiavang">
                    <img src="assets/images/banner_gia_vang-01-25.png" alt="Giá vàng hôm nay">
                </a>
            </div>
                <div class="jewelry-news">
                    <?php while ($row = mysqli_fetch_array($query_lietke_tintuc)) { ?>
                        <div class="news-item">
                            <img src="admincp/modules/blog/image_blog/<?php echo $row['hinhanh'] ;?>" alt="Nhẫn Hello Kitty">
                            <h3><?php echo $row['tieude'] ;?></h3>
                            <p><?php echo $row['noidung'] ;?></p>
                            <a href="?quanly=tintuc">Xem thêm &gt;</a>
                        </div>
                    <?php } ?>
                </div>
        </div>
        <div class="view-all">
            <button class="btn btn_content-4">Xem tất cả</button>
        </div>
    </div>
</div>



