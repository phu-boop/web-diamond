<?php
// Giả sử bạn đã kết nối database và thực hiện truy vấn
$sql = "SELECT * FROM tbl_dangky";
$query = mysqli_query($mysqli, $sql); // $mysqli là biến kết nối database
?>

<div class="page_promotion_list">
    <div class="list_container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Khách Hàng</th>
                    <th>Email</th>
                    <th>Địa Chỉ</th>
                    <th>Số Điện Thoại</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($row = mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <td><?php echo $row['id_dangky']; ?></td>
                    <td><?php echo $row['tenkhachhang']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['diachi']; ?></td>
                    <td><?php echo $row['dienthoai']; ?></td>
                    <td>
                        <a class="btn edit" href="?action=quanlykhachhang&query=sua&id=<?php echo $row['id_dangky']; ?>">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                        <a class="btn remove" href="modules/register_MNG/handle.php?id=<?php echo $row['id_dangky']; ?>">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>