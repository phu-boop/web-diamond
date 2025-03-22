<?php
$sql_lietke_danhmucsp = "SELECT * FROM tbl_danhmuc ORDER BY thutu DESC";
$query_lietke_danhmucsp = mysqli_query($mysqli, $sql_lietke_danhmucsp);
?>
<div class="list_container">
    <p><h2>Danh sách danh mục</h2></p>
    <table style="width: 100%;" border="1" style="border-collapse: collapse;">
        <tr>
            <th>Id</th>
            <th>Tên danh mục</th>
            <th>Hinh ảnh</th>
            <th>Tổng sản phẩn</th>
            <th>Quản lý</th>
        </tr>

        <?php
        $i = 0;
        while ($row = mysqli_fetch_assoc($query_lietke_danhmucsp)) {
            $i++;
            $total_product = "SELECT tbl_danhmuc.id_danhmuc, COUNT(tbl_sanpham.id_sanpham) AS tong_sanpham 
                  FROM tbl_danhmuc
                  LEFT JOIN tbl_sanpham ON tbl_danhmuc.id_danhmuc = tbl_sanpham.id_danhmuc
                  WHERE tbl_danhmuc.id_danhmuc = '".$row['id_danhmuc']."'
                  GROUP BY tbl_danhmuc.id_danhmuc";
            $query_total_product = mysqli_query($mysqli, $total_product);
            $row_total_product = mysqli_fetch_assoc($query_total_product);
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo htmlspecialchars($row['tendanhmuc']); ?></td>
                <td><img src="modules/category_productMNG/image_category/<?php echo $row['hinhanh']; ?>" alt="Hình ảnh sản phẩm"></td>
                <td><?php echo $row_total_product['tong_sanpham'] ;?></td>
                <td>
                    <a href="modules/category_productMNG/handle.php?id_danhmuc=<?php echo $row['id_danhmuc']; ?>">Xóa</a> | 
                    <a href="?action=quanlydanhmucsanpham&query=sua&id_danhmuc=<?php echo $row['id_danhmuc']; ?>">Sửa</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>
