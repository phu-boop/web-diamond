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
        <form method="POST" action="modules/productMNG/handle.php" enctype="multipart/form-data">
            <label for="tensanpham"><?php echo $row['tensanpham']; ?></label>
            <input type="text" id="tensanpham" name="nameproduct">

            <label for="masp"><?php echo $row['masp']; ?></label>
            <input type="text" id="masp" name="codeproduct">

            <label for="giasp"><?php echo $row['giasp']; ?></label>
            <input type="text" id="giasp" name="priceproduct">

            <label for="soluong"><?php echo $row['soluong']; ?></label>
            <input type="number" id="soluong" name="quantity">

            <label for="hinhanh"><?php echo $row['hinhanh']; ?></label>
            <input type="file" id="hinhanh" name="image">

            <label for="tomtat"><?php echo $row['tomtat']; ?></label>
            <textarea id="tomtat" name="summary" rows="3"></textarea>

            <label for="noidung"><?php echo $row['noidung']; ?></label>
            <textarea id="noidung" name="content" rows="5"></textarea>

            <select id="tinhtrang" name="status">
                <option value="1">Kích hoạt</option>
                <option value="0">Ẩn</option>
            </select>

            <button type="submit" name="addproduct">Thêm sản phẩm</button>
        </form>
        <?php
        }
        ?>
    </div>

