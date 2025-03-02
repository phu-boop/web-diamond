<?php

$sql_lietke_sp = "SELECT * FROM tbl_sanpham ORDER BY id_sanpham DESC";
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
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        img {
            max-width: 80px;
            height: auto;
            border-radius: 4px;
        }
        .actions a {
            text-decoration: none;
            padding: 5px 10px;
            margin: 0 5px;
            border-radius: 4px;
        }
        .delete {
            background-color: #dc3545;
            color: white;
        }
        .edit {
            background-color: #28a745;
            color: white;
        }
    </style>

    <div class="container">
        <h2>Danh sách sản phẩm</h2>
        <table>
            <tr>
                <th>Id</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Mã SP</th>
                <th>Tóm tắt</th>
                <th>Trạng thái</th>
                <th>Quản lý</th>
            </tr>
            <?php
            $i = 0;
            while ($row = mysqli_fetch_array($query_lietke_sp)) {
                $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['tensanpham']; ?></td>
                <td><img src="modules/productMNG/image_product/<?php echo $row['hinhanh']; ?>" alt="Hình ảnh sản phẩm"></td>
                <td><?php echo $row['giasp']; ?></td>
                <td><?php echo $row['soluong']; ?></td>
                <td><?php echo $row['masp']; ?></td>
                <td><?php echo $row['tomtat']; ?></td>
                <td><?php echo ($row['trangthai'] == 1) ? 'Kích hoạt' : 'Ẩn'; ?></td>
                <td class="actions">
                    <a href="modules/productMNG/handle.php?id_sanpham=<?php echo $row['id_sanpham']; ?>" class="delete">Xóa</a>
                    <a href="modules/quanlysanpham/xuly.php?query=sua&id_sanpham=<?php echo $row['id_sanpham']; ?>" class="edit">Sửa</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>

