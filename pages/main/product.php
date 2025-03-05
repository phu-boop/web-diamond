<?php
if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $lietke_sp = "SELECT * FROM tbl_sanpham WHERE id_danhmuc = '$id' ORDER BY id_sanpham DESC";
}else
{
    $lietke_sp = "SELECT * FROM tbl_sanpham ORDER BY id_sanpham DESC";   
}
    $query_lietke_sp = mysqli_query($mysqli, $lietke_sp);
    ?>
<div class="container">
    <div class="content-1">
        <div class="container collection">
         <?php while ($row = mysqli_fetch_array($query_lietke_sp)) {?>
            <a href="index.php?xem=chitietsanpham&id=<?php echo $row['id_sanpham'] ?>">
                <div class="product">
                    <img src="admincp/modules/productMNG/image_product/<?php echo $row['hinhanh'] ?>" alt="ảnh sản phẩm">
                    <h3><?php echo $row['tensanpham'] ?></h3>
                    <p class="price"><?php echo number_format($row['giasp'], 0, ',', '.') ?> đ</p>
                    <p class="promo">Tặng trang sức đến 2 triệu</p>
                </div>
            </a>
        <?php } ?>
        </div>
    </div>
</div>
    
