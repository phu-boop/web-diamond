<?php
$sql="SELECT * FROM tbl_khuyenmai ORDER BY id_khuyenmai DESC";
$sql_query=mysqli_query($mysqli,$sql);
?>
<div class="page_promotion_list">
    <div class="list_container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Loại</th>
                    <th>Giá trị</th>
                    <th>Đơn tối thiểu</th>
                    <th>Trạng thái</th>
                    <th>Bắt đầu</th>
                    <th>Kết thúc</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($row = mysqli_fetch_array($sql_query)){
                    $current_date = date('Y-m-d H:i:s');
                    if ($current_date >= $row['ngay_bd'] && $current_date <= $row['ngay_kt']) {
                        $status = '<i class="fa-solid fa-check"></i>';
                    } else {
                        $status = '<i class="fa-solid fa-xmark"></i>';
                    }
                ?>
                    <tr>
                        <td><?php echo $row['id_khuyenmai']; ?></td>
                        <td><?php echo $row['ten_khuyenmai']; ?></td>
                        <td><?php echo $row['loai_khuyenmai']; ?></td>
                        <?php if($row['loai_khuyenmai']=='phantram') { ?>
                            <td><?php echo $row['giatri']; ?>%</td>
                        <?php } elseif($row['loai_khuyenmai']=='codinh'){?>
                            <td><?php echo number_format($row['giatri']);?> VND</td>
                        <?php } else { ?>
                            <td><?php echo $row['giatri']; ?> Điểm</td>
                        <?php } ?>
                        <td><?php echo $row['toithieu_khuyenmai']; ?></td>
                        <td><?php echo $status; ?></td>
                        <td><?php echo $row['ngay_bd']; ?></td>
                        <td><?php echo $row['ngay_kt']; ?></td>
                        <td>
                            <a class="btn edit" href="?action=quanlykhuyenmai&&query=sua&&id=<?php echo $row['id_khuyenmai'];?>"><i class="fa-regular fa-pen-to-square"></i></a>
                            <a class="btn remove" href="modules/promotionMNG/handle.php?id=<?php echo $row['id_khuyenmai'];?>"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

