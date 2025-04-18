<div class="page_product">
    <div class="create_container">
        <div class="top">
            <h2>Thêm sản phẩm</h2>
        </div>
        <form class="form" method="POST" action="modules/productMNG/handle.php" enctype="multipart/form-data">
                <label for="tensanpham">Tên sản phẩm</label>
                <input type="text" id="tensanpham" name="nameproduct">

                <label for="masp">Mã sản phẩm</label>
                <input type="text" id="masp" name="codeproduct">

                <label for="giasp">Giá sản phẩm</label>
                <input type="text" id="giasp" name="priceproduct">
                <div class="form-group">
                    <div>
                        <label for="soluong">Số lượng</label>
                        <input type="number" id="soluong" name="quantity" placeholder="Nhập số lượng">
                    </div>
                    <div>
                        <label for="hinhanh">Hình ảnh</label>
                        <input type="file" id="hinhanh" name="image">
                    </div>
                </div>
                <div id="tomtat">
                    <label for="tomtat">Tóm tắt</label>
                    <textarea id="tomtat" name="summary"  class="mytextarea" rows="3"></textarea>
                </div>
                <div id="noidung">
                    <label  for="noidung">Nội dung</label>
                    <textarea id="noidung" name="content" class="mytextarea"></textarea>
                </div>
                <div class="select_block">
                    <div>
                        <label for="tinhtrang">Tình trạng</label>
                        <select id="tinhtrang" name="status">
                            <option value="1">Kích hoạt</option>
                            <option value="0">Ẩn</option>
                        </select>
                    </div>
                    <div>
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
                    </div>
                    <button class="btn add_product" type="submit" name="addproduct">Thêm sản phẩm</button>
                </div>
        </form>
    </div>
</div>