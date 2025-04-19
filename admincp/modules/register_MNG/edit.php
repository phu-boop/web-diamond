<div class="page_edit_promotion">
    <div class="edit_container">
        <div class="top">
            <h2>Sửa Người Dùng</h2>
        </div>
        <?php
        $id=$_GET['id'];
        $sql = "SELECT * FROM tbl_dangky WHERE id_dangky = $id";
        $query_sql=mysqli_query($mysqli,$sql);
        while($row=mysqli_fetch_array($query_sql)){
        ?>
            <form method="POST" action="modules/register_MNG/handle.php?id=<?php echo $row['id_dangky'] ;?>">
                <label>Tên khách hàng:</label>
                <input value="<?php echo $row['tenkhachhang']; ?>" type="text" name="tenkhachhang" required>

                <label>Email:</label>
                <input value="<?php echo $row['email']; ?>" type="email" name="email" required>

                <label>Địa chỉ:</label>
                <input value="<?php echo $row['diachi']; ?>" type="text" name="diachi" required>

                <label>Mật khẩu:</label>
                <input value="<?php echo $row['matkhau']; ?>" type="password" name="matkhau" required>

                <label>Điện thoại:</label>
                <input value="<?php echo $row['dienthoai']; ?>" type="text" name="dienthoai" required>

                <button class="btn edit_product" type="submit" name="submit_edit">Sửa người dùng</button>
            </form>
        <?php } ?>
    </div>
</div>