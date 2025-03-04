<?php
$sql_lietke_sanpham = "SELECT * FROM tbl_danhmuc ORDER BY giasp DESC Limit 4";
$query_lietke_sanpham = mysqli_query($mysqli, $sql_lietke_sanpham);
?>

<div >
                <img class="img" src="admincp/modules/productMNG/image_product/<?php echo $row['hinhanh']?>" alt="Luxury Logo">
            </div>
            <div class="container">
                <div class="content-1">
                    <h2>Bộ sưu tập trang sức đẳng cấp</h2>
                    <div class="container collection">
                        <?php while ($row = mysqli_fetch_array($query_lietke_sanpham)) { ?>
                        <div class="product">
                            <img src="" alt="Lắc tay Vàng 14K">
                            <h3>Lắc tay Vàng 14K đính đá Synthetic</h3>
                            <p class="price">9.439.000 đ</p>
                            <p class="promo">Tặng trang sức đến 2 triệu</p>
                        </div>
                        <?php } ?>
                    </div>
                    <button class="btn">Xem thêm</button>
                </div>
                <div class="content-2">
                    <h2>Bạn đang tìm gì hôm nay?</h2>
                    <div class="directory_list">
                        <div class="directory">
                            <div class="img">
                                <img src="./images/kim_cuong.png" alt="">
                            </div>
                            <p>kim_cuong</p>
                        </div>
                        <div class="directory">
                            <div class="img">
                                <img src="./images/kim_cuong.png" alt="">
                            </div>
                            <p>kim_cuong</p>
                        </div>
                        <div class="directory">
                            <div class="img">
                                <img src="./images/kim_cuong.png" alt="">
                            </div>
                            <p>kim_cuong</p>
                        </div>
                        <div class="directory">
                            <div class="img">
                                <img src="./images/kim_cuong.png" alt="">
                            </div>
                            <p>kim_cuong</p>
                        </div>
                        <div class="directory">
                            <div class="img">
                                <img src="./images/kim_cuong.png" alt="">
                            </div>
                            <p>kim_cuong</p>
                        </div>
                        <div class="directory">
                            <div class="img">
                                <img src="./images/kim_cuong.png" alt="">
                            </div>
                            <p>kim_cuong</p>
                        </div>
                        <div class="directory">
                            <div class="img">
                                <img src="./images/kim_cuong.png" alt="">
                            </div>
                            <p>kim_cuong</p>
                        </div>
                        <div class="directory">
                            <div class="img">
                                <img src="./images/kim_cuong.png" alt="">
                            </div>
                            <p>kim_cuong</p>
                        </div>
                        <div class="directory">
                            <div class="img">
                                <img src="./images/kim_cuong.png" alt="">
                            </div>
                            <p>kim_cuong</p>
                        </div>
                        <div class="directory">
                            <div class="img">
                                <img src="./images/kim_cuong.png" alt="">
                            </div>
                            <p>kim_cuong</p>
                        </div>
                    </div>
                </div>
            </div>

            