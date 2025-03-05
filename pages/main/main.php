<?php

$sql_lietke_sanpham = "SELECT * FROM tbl_sanpham ORDER BY giasp DESC Limit 4";
$query_lietke_sanpham = mysqli_query($mysqli, $sql_lietke_sanpham);

$sql_lietke_danhmucsp = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC Limit 20";
$query_lietke_danhmucsp = mysqli_query($mysqli, $sql_lietke_danhmucsp);
?>

<div >
                <img class="img" src="images/love-knot-pc_1740041249.jpg" alt="Luxury Logo">
            </div>
            <div class="container">
                <div class="content-1">
                    <h2>Bộ sưu tập trang sức đẳng cấp</h2>
                    <div class="container collection">
                        <?php while ($row = mysqli_fetch_array($query_lietke_sanpham)) { ?>
                        <div class="product">
                            <a href="index.php?quanly=chitietsanpham&id=<?php echo $row['id_sanpham'] ?>">
                                <img src="admincp/modules/productMNG/image_product/<?php echo $row['hinhanh'] ?>" alt="ảnh sản phẩm">
                                <h3><?php echo $row['tensanpham'] ?></h3>
                                <p class="price"><?php echo number_format($row['giasp'], 0, ',', '.') ?> đ</p>
                                <p class="promo">Tặng trang sức đến 2 triệu</p>
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
                        <a href="index.php?quanly=sanpham&id=<?php echo $row['id_danhmuc'] ?>">
                            <div class="directory">
                                <div class="img">
                                    <img src="./images/kim_cuong.png" alt="">
                                </div>
                                <p><?php echo $row['tendanhmuc'] ?></p>
                            </div>
                        </a>
                        <?php } ?>
                    </div>
                </div>
            </div>

            