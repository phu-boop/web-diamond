<?php
(isset($_GET['trang']))? $begin = $_GET['trang']*8 : $begin = 0;
if(isset($_GET['search'])){
    $sql_lietke_danhmucsp = "SELECT * FROM tbl_danhmuc WHERE tendanhmuc LIKE '%".$_GET['search']."%' ORDER BY id_danhmuc DESC LIMIT ".$begin.",8";
    $query_lietke_danhmucsp = mysqli_query($mysqli, $sql_lietke_danhmucsp);
    if(mysqli_num_rows($query_lietke_danhmucsp) == 0){
        echo "<script>alert('Không tìm thấy kết quả phù hợp!')</script>";
    }
}
else{
    $sql_lietke_danhmucsp = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC LIMIT ".$begin.",8";
    $query_lietke_danhmucsp = mysqli_query($mysqli, $sql_lietke_danhmucsp);
}
?>
<div class="list_container">
    <table >
        <tr>
            <th>Hinh ảnh</th>
            <th>Tên danh mục</th>
            <th>Mã danh mục</th>
            <th>Tổng sản phẩn</th>
            <th>Quản lý</th>
        </tr>

        <?php
        while ($row = mysqli_fetch_assoc($query_lietke_danhmucsp)) {
            $total_product = "SELECT tbl_danhmuc.id_danhmuc, COUNT(tbl_sanpham.id_sanpham) AS tong_sanpham 
                  FROM tbl_danhmuc
                  LEFT JOIN tbl_sanpham ON tbl_danhmuc.id_danhmuc = tbl_sanpham.id_danhmuc
                  WHERE tbl_danhmuc.id_danhmuc = '".$row['id_danhmuc']."'
                  GROUP BY tbl_danhmuc.id_danhmuc";
            $query_total_product = mysqli_query($mysqli, $total_product);
            $row_total_product = mysqli_fetch_assoc($query_total_product);
            ?>
            <tr>
                <td><img src="modules/category_productMNG/image_category/<?php echo $row['hinhanh']; ?>" alt="Hình ảnh sản phẩm"></td>
                <td><?php echo htmlspecialchars($row['tendanhmuc']); ?></td>
                <td><?php echo $row['id_danhmuc']; ?></td>
                <td><?php echo $row_total_product['tong_sanpham'] ;?></td>
                <td>
                    <a class="btn edit"  href="?action=quanlydanhmucsanpham&query=sua&id_danhmuc=<?php echo $row['id_danhmuc']; ?>"><i class="fa-regular fa-pen-to-square"></i></a>
                    <a class="btn remove" href="modules/category_productMNG/handle.php?id_danhmuc=<?php echo $row['id_danhmuc']; ?>"><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <div class="pagination">
        <button class="page-item disabled">❮</button>
        <?php
        $i = 0;
        $sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
        $query_danhmucsp = mysqli_query($mysqli, $sql_danhmuc);
        $pages = ceil(mysqli_num_rows($query_danhmucsp)/8); 
        while($i < $pages){
        ?>
        <a href="index.php?action=quanlydanhmucsanpham&query=them&trang=<?php echo $i++; ?>" class="page-item <?php echo ($_GET['trang'] == $i-1) ? 'active' : ''; ?>"><?php echo $i;?></a>
        <?php
        }
        ?>
        <button class="page-item disabled">❯</button>
    </div>
</div>
