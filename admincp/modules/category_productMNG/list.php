<?php

$sql_lietke_danhmucsp = "SELECT * FROM tbl_danhmuc ORDER BY thutu DESC";
$query_lietke_danhmucsp = mysqli_query($mysqli, $sql_lietke_danhmucsp);

?>

<p><strong>Liệt kê danh mục sản phẩm</strong></p>

<table style="width: 100%;" border="1" style="border-collapse: collapse;">
    <tr>
        <th>Id</th>
        <th>Tên danh mục</th>
        <th>Quản lý</th>
    </tr>

    <?php
    $i = 0;
    while ($row = mysqli_fetch_assoc($query_lietke_danhmucsp)) {
        $i++;
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo htmlspecialchars($row['tendanhmuc']); ?></td>
            <td>
                <a href="modules/category_productMNG/handle.php?id_danhmuc=<?php echo $row['id_danhmuc']; ?>">Xóa</a> | 
                <a href="?action=quanlydanhmucsanpham&query=sua&id_danhmuc=<?php echo $row['id_danhmuc']; ?>">Sửa</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
