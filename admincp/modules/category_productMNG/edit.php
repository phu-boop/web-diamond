<?php

$sql_lietke_danhmucsp = "SELECT * FROM tbl_danhmuc WHERE id_danhmuc='$_GET[id_danhmuc]' LIMIT 1";
$query_lietke_danhmucsp = mysqli_query($mysqli, $sql_lietke_danhmucsp);

?>  
<div class="edit_container">
    <div class="top">
        <h3>Sửa Danh Mục Sản Phẩm</h3>
    </div>
    <?php
    while ($row = mysqli_fetch_array($query_lietke_danhmucsp)) {
        ?>
        <form method="POST" action="modules/category_productMNG/handle.php?id_danhmuc=<?php echo $row['id_danhmuc']; ?>"  enctype="multipart/form-data">
            <table>
                <tr>
                    <td><label for="namecategory">Tên danh mục</label></td>
                    <td><input type="text"  name="namecategory" value="<?php echo $row['tendanhmuc']; ?>" required></td>
                </tr>
                <tr>
                    <td><label for="hinhanh">Hình ảnh</label></td>
                    <td><input type="file" id="hinhanh" name="image" value=""></td>
                </tr>
                <tr>
                    <td><label for="order">Thứ tự</label></td>
                    <td><input type="text"  name="order" value="<?php echo $row['thutu']; ?>" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="editcategory" value="xác nhận">
                    </td>
                </tr>
            </table>
        </form>
        <?php
    }
    ?>
</div>