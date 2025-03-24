<?php
$sql_lietke_sp = "SELECT * FROM tbl_sanpham WHERE id_sanpham='$_GET[id_sanpham]' LIMIT 1";
$query_lietke_sp = mysqli_query($mysqli, $sql_lietke_sp);

?>
  
  
  <style>   
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: auto;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
        }
        input, textarea, select {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #218838;
        }
    </style>

    <div class="container">
        <h2>Thêm sản phẩm</h2>
        <?php
            while ($row = mysqli_fetch_array($query_lietke_sp)) {
                ?>
        <form method="POST" action="handle.php?id_sanpham=<?php echo $row['id_sanpham'];?>" enctype="multipart/form-data">
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
            <textarea id="tomtat" name="summary" rows="3">
                <?php echo (!empty($row) && isset($row['tomtat'])) ? $row['tomtat'] : ""; ?>
            </textarea>


            <label for="noidung">Nội dung</label>
            <textarea id="noidung" name="content" rows="5">
                <?php echo (!empty($row) && isset($row['noidung'])) ? $row['noidung'] : ""; ?>
            </textarea>



            <button type="submit" name="editproduct">sua sp</button>
        </form>
        <?php
        }
        ?>
    </div>

