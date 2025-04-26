<?php
if (isset($_SESSION['id_khachhang'])) {
    if(isset($_POST['changePassword']))
    {
        $current_password=md5($_POST['current_password']);
        $new_password=md5($_POST['new_password']);
        $confirm_password=md5($_POST['confirm_password']);
        if($confirm_password==$new_password)
        {
            if(isset($_SESSION['id_khachhang']))
            {
                $sql = "UPDATE tbl_dangky SET matkhau = '$new_password' WHERE matkhau='$current_password' AND id_dangky = '".$_SESSION['id_khachhang']."'";
                $query=mysqli_query($mysqli,$sql);
                if (mysqli_affected_rows($mysqli) > 0) {
                    echo "<script>alert('Đổi mật khẩu thành công!');window.location.href='index.php';</script>";
                } else {
                    echo "<script>alert('mật khẩu không đúng!');</script>";
                }
            }else{
                echo "<script>alert('Vui lòng đăng nhập để đổi mật khẩu!');</script>";
            }
        }else{
            echo "<script>alert('xác nhận mật khẩu không đúng!');</script>";
        }
    }
}else {
    echo "<script>alert('Bạn cần đăng nhập để thực hiện chức năng này!');</script>";
    echo "<script>window.location.href='index.php?quanly=dangnhap';</script>";
}
?>
<div class="page_changePassword">
    <div class="container">
        <h2>Đổi Mật Khẩu</h2>
        <form action="" method="POST">
            <div class="input-group">
                <label for="current_password">Mật khẩu cũ</label>
                <input type="password" id="current_password" name="current_password" required>
            </div>
            <div class="input-group">
                <label for="new_password">Mật khẩu mới</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div class="input-group">
                <label for="confirm_password">Xác nhận mật khẩu</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" name="changePassword">Đổi Mật Khẩu</button>
        </form>
    </div>
</div>

