<?php
    (isset($_GET['trang']))? $begin=$_GET['trang']*16 : $begin=0;
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $lietke_sp = "SELECT * FROM tbl_sanpham WHERE id_danhmuc = '$id' ORDER BY id_sanpham DESC LIMIT $begin,16";
    }else
    {
        $lietke_sp = "SELECT * FROM tbl_sanpham ORDER BY id_sanpham DESC LIMIT $begin,16";   
    }
    $query_lietke_sp = mysqli_query($mysqli, $lietke_sp);
    ?>
<div class="container_page_product">
    <div class="filter">
        <div class="filter-container">
            <div class="title">Bộ lọc:</div>
            <div>
                <select id="brand">
                    <option>Thương hiệu</option>
                </select>
                <select id="price">
                    <option>Giá</option>
                </select>
                <select id="collection">
                    <option>Bộ sưu tập</option>
                </select>
                <select id="gold-age">
                    <option>Tuổi vàng</option>
                </select>
                <select id="gold-type">
                    <option>Loại đá chính</option>
                </select>
                <select id="material">
                    <option>Chất liệu</option>
                </select>
                <select id="gender">
                    <option>Giới tính</option>
                </select>
                <select id="jewelry-type">
                    <option>Loại trang sức</option>
                </select>
                <select id="color">
                    <option>Màu chất liệu</option>
                </select>
            </div>
        </div>
        
        <div class="sort-container">
            <label for="sort">Sắp xếp:</label>
            <select id="sort">
                <option>Sản phẩm mới nhất</option>
            </select>
        </div>
    </div>
    <div class="content-1">
        <div class="container collection">
         <?php while ($row = mysqli_fetch_array($query_lietke_sp)) {?>
            <a href="index.php?quanly=chitietsanpham&id=<?php echo $row['id_sanpham']; ?>" >
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
            $pages = ceil(mysqli_num_rows($query_sp)/16);    
            for ($i = 0; $i < $pages; $i++) {
                ?>
                    <li><a class="index_page <?= ($i == 0) ? "active" : "" ?>" href="index.php?quanly=sanpham&id=<?php echo $id ?>&trang=<?php echo $i?>"><?php echo $i+1 ?></a></li>
                <?php
                }
        }else
        {
            $sql_sp = "SELECT * FROM tbl_sanpham ORDER BY id_sanpham DESC ";
            $query_sp = mysqli_query($mysqli, $sql_sp);
            $pages = ceil(mysqli_num_rows($query_sp)/16);
            for ($i =0; $i < $pages; $i++) {
                ?>
                    <li><a class="index_page <?= ($i == 0) ? "active" : "" ?>" href="index.php?quanly=sanpham&trang=<?php echo $i?>"><?php echo $i+1 ?></a></li>
                <?php
                }
        }
    ?>
</ul>
</div>







    
