<?php
$sql_lietke_sp = "SELECT * FROM tbl_sanpham WHERE id_sanpham='$_GET[id_sanpham]' LIMIT 1";
$query_lietke_sp = mysqli_query($mysqli, $sql_lietke_sp);

?>
 
<div class="edit_product">
    <div class="create_container">
        <div class="top">
            <h2>Sửa sản phẩm</h2>
        </div>
        <?php
            while ($row = mysqli_fetch_array($query_lietke_sp)) {
                ?>
                <form method="POST" action="modules/productMNG/handle.php?id_sanpham=<?php echo $row['id_sanpham'];?>" enctype="multipart/form-data">
                    <label for="tensanpham">Tên sản phẩm</label>
                    <input type="text" id="tensanpham" name="nameproduct" value="<?php echo $row['tensanpham']; ?>">

                    <label for="masp">Mã sản phẩm</label>
                    <input type="text" id="masp" name="codeproduct" value="<?php echo $row['masp']; ?>">

                    <label for="giasp">Giá sản phẩm</label>
                    <input type="text" id="giasp" name="priceproduct" value="<?php echo $row['giasp']; ?>">

                    <label for="soluong">Số lượng</label>
                    <input type="number" id="soluong" name="quantity" value="<?php echo $row['soluong']; ?>">

                    <label for="hinhanh">Hình ảnh</label>
                    <input type="file" id="hinhanh" name="image" value="<?php echo $row['hinhanh']; ?>">

                    <div id="tomtat">
                        <label for="tomtat">Tóm tắt</label>
                        <textarea id="tomtat" name="summary"  class="mytextarea" rows="3" ><?php echo $row['tomtat']; ?></textarea>
                    </div>
                    <div id="noidung">
                        <label  for="noidung">Nội dung</label>
                        <textarea id="noidung" name="content" class="mytextarea" ><?php echo $row['noidung']; ?></textarea>
                    </div>
                    <div class="select_block">
                    <div>
                        <label for="tinhtrang">Tình trạng</label>
                        <?php if ($row['trangthai'] == 1) { ?>
                            <select id="tinhtrang" name="status">
                                <option value="1" selected>Kích hoạt</option>
                                <option value="0">Ẩn</option>
                            </select>
                        <?php } else { ?>
                            <select id="tinhtrang" name="status">
                                <option value="0" selected>Ẩn</option>
                                <option value="1">Kích hoạt</option>
                            </select>
                        <?php } ?>
                    </div>
                        <div>
                            <label for="danhmuc">Danh mục</label>
                            <select id="danhmuc" name="category">
                                <?php
                                    $id_sanpham = $_GET['id_sanpham'];
                                    $sql_dmsp = "SELECT tbl_danhmuc.id_danhmuc, tbl_danhmuc.tendanhmuc 
                                                FROM tbl_sanpham, tbl_danhmuc 
                                                WHERE tbl_sanpham.id_sanpham = '$id_sanpham' 
                                                AND tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc";
                                    $query_dmsp = mysqli_query($mysqli, $sql_dmsp);
                                    $row_selected = mysqli_fetch_array($query_dmsp);
                                    ?>
                                    <option value="<?php echo $row_selected['id_danhmuc']; ?>">
                                        <?php echo $row_selected['tendanhmuc']; ?>
                                    </option>
                                <?php
                                $sql_lietke_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
                                $query_lietke_danhmuc = mysqli_query($mysqli, $sql_lietke_danhmuc);
                                    while ($row = mysqli_fetch_array($query_lietke_danhmuc)) {
                                ?>
                                <option value="<?php echo $row['id_danhmuc'] ?>" ><?php echo $row['tendanhmuc'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <button class="btn add_product" type="submit" name="editproduct">Sửa sản phẩm</button>
                    </div>
                </form>
        <?php
        }
        ?>
    </div>
</div>

