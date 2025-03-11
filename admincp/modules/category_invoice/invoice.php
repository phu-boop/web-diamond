<?php
$sql="SELECT * FROM tbl_giohang ORDER BY id_giohang DESC";
$lietke_donhang=mysqli_query($mysqli,$sql); 
?>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            text-align: center;
            margin: 0;
            padding: 20px;
        }
        h2 {
            color: #333;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background: #f2f2f2;
        }
        tr:hover {
            background: #ddd;
        }
    </style>

    <h2>Danh sách giỏ hàng</h2>
    <table>
        <tr>
            <th>ID Giỏ hàng</th>
            <th>ID Khách hàng</th>
            <th>Mã Giỏ hàng</th>
            <th>Trạng thái</th>
            <th>Quản lý</th>
        </tr>
        <?php while($row = mysqli_fetch_array($lietke_donhang))
        {?>
        <tr>
            <td><?php echo $row['id_giohang']; ?></td>
            <td><?php echo $row['id_khachhang']; ?></td>
            <td><?php echo $row['ma_giohang'];?></td>
            <?php if($row['trangthai_giohang']==1){?>
            <td><a href="index.php?action=quanlydonhang&&query=xemchitiet&id=<?php echo $row['id_giohang'] ?>">đơn hàng mới</a></td>
            <?php }else{ ?>
            <td>Đã xem</td>
            <?php } ?>
            <td><a href="index.php?action=quanlydonhang&&query=xemchitiet&id=<?php echo $row['id_giohang'] ?>">xem chi tiết</a></td>
        </tr>
        <?php
        }
        ?>
    </table>
