
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background: #28a745;
            color: white;
        }
        .btn {
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            border: none;
            color: white;
        }
        .btn-delete {
            background: red;
        }
        .btn-delete:hover {
            background: darkred;
        }
        .btn-edit {
            background: orange;
        }
        .btn-edit:hover {
            background: darkorange;
        }
    </style>
<?php
$sql="SELECT * FROM tbl_khuyenmai ORDER BY id_khuyenmai DESC";
$sql_query=mysqli_query($mysqli,$sql);
?>

<div class="container">
    <h2>Danh sách Khuyến Mãi</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Loại</th>
                <th>Giá trị</th>
                <th>Đơn giá tối thiểu</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while($row=mysqli_fetch_array($sql_query)){
            ?>
                <tr>
                    <td><?php echo $row['id_khuyenmai']; ?></td>
                    <td><?php echo $row['ten_khuyenmai']; ?></td>
                    <td><?php echo $row['loai_khuyenmai']; ?></td>
                    <?php if($row['loai_khuyenmai']=='phantram') { ?>
                            <td><?php echo $row['giatri']; ?>%</td>
                    <?php }elseif($row['loai_khuyenmai']=='codinh'){?>
                            <td><?php echo $row['giatri']; ?> VND</td>
                    <?php }else{ ?>
                            <td><?php echo $row['giatri']; ?> Điểm</td>
                    <?php } ?>
                    <td><?php echo $row['toithieu_khuyenmai']; ?></td>
                    <td><?php echo $row['ngay_bd']; ?></td>
                    <td><?php echo $row['ngay_kt']; ?></td>
                    <td>
                    <a class="btn btn-edit" href="?action=quanlykhuyenmai&&query=sua&&id=<?php echo $row['id_khuyenmai'];?>">Sửa</a>
                        <a class="btn btn-delete" href="modules/promotionMNG/handle.php?id=<?php echo $row['id_khuyenmai'];?>">Xóa</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


