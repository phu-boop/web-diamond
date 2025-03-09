<?php
    (isset($_GET['trang']))? $begin=$_GET['trang'] : $begin=0;
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $lietke_sp = "SELECT * FROM tbl_sanpham WHERE id_danhmuc = '$id' ORDER BY id_sanpham DESC LIMIT $begin,1";
    }else
    {
        $lietke_sp = "SELECT * FROM tbl_sanpham ORDER BY id_sanpham DESC LIMIT $begin,1";   
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
    <ul class="pagination">
    <?php 
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $sql_sp = "SELECT * FROM tbl_sanpham WHERE id_danhmuc = '$id' ORDER BY id_sanpham DESC ";
            $query_sp = mysqli_query($mysqli, $sql_sp);
            $pages = ceil(mysqli_num_rows($query_sp)/1);    
            for ($i = 1; $i <= $pages; $i++) {
                ?>
                    <li><a href="index.php?quanly=sanpham&id=<?php echo $id ?>&trang=<?php echo $i?>"><?php echo $i ?></a></li>
                <?php
                }
        }else
        {
            $sql_sp = "SELECT * FROM tbl_sanpham ORDER BY id_sanpham DESC ";
            $query_sp = mysqli_query($mysqli, $sql_sp);
            $pages = ceil(mysqli_num_rows($query_sp)/1);
            for ($i = 1; $i <= $pages; $i++) {
                ?>
                    <li><a href="index.php?quanly=sanpham&trang=<?php echo $i?>"><?php echo $i ?></a></li>
                <?php
                }
        }
    ?>
</ul>
</div>
<style>
.pagination {
    list-style: none;
    display: flex;
    justify-content: center;
    padding: 10px;
}

.pagination li {
    margin: 0 5px;
}

.pagination a {
    text-decoration: none;
    color: white;
    background: #007bff;
    padding: 8px 12px;
    border-radius: 5px;
    transition: 0.3s;
}

.pagination a:hover {
    background: #0056b3;
}

</style>
    
