
    <div class="container">
        <h2>Thêm sản phẩm</h2>
        <form method="POST" action="modules/productMNG/handle.php" enctype="multipart/form-data">
            <label for="tensanpham">Tên sản phẩm</label>
            <input type="text" id="tensanpham" name="nameproduct">

            <label for="masp">Mã sản phẩm</label>
            <input type="text" id="masp" name="codeproduct">

            <label for="giasp">Giá sản phẩm</label>
            <input type="text" id="giasp" name="priceproduct">

            <label for="soluong">Số lượng</label>
            <input type="number" id="soluong" name="quantity">

            <label for="hinhanh">Hình ảnh</label>
            <input type="file" id="hinhanh" name="image">

            <label for="tinhtrang">Tình trạng</label>
            <select id="tinhtrang" name="status">
                <option value="1">Kích hoạt</option>
                <option value="0">Ẩn</option>
            </select>

            <label for="danhmuc">Danh mục</label>
            <select id="danhmuc" name="category">
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

            <label for="tomtat">Tóm tắt</label>
            <textarea id="tomtat" name="summary" rows="3"></textarea>

            <label for="noidung">Nội dung</label>
            <textarea id="noidung" name="content" rows="5"></textarea>


            <button type="submit" name="addproduct">Thêm sản phẩm</button>
        </form>
    </div>
