<?php
include('admincp/config/config.php');
if(isset($_POST['submit'])) {
    $tenkhachhang = $_POST['tenkhachhang'];
    $email = $_POST['email'];
    $diachi = $_POST['diachi'];
    $matkhau = md5($_POST['matkhau']);
    $dienthoai = $_POST['dienthoai'];

    $sql = "INSERT INTO tbl_dangky (tenkhachhang, email, diachi, matkhau, dienthoai) VALUES ('$tenkhachhang', '$email', '$diachi', '$matkhau', '$dienthoai')";
    
    if(mysqli_query($mysqli,$sql))
    {
        $_SESSION['id_khachhang']=mysqli_insert_id($mysqli);
        $_SESSION['dangky']=$tenkhachhang;
        $_SESSION['mail']=$email;
        echo "<script>window.location.href='index.php?quanly=dangnhap';</script>";

    }
}
?>
<div class="page-register">
    <div class="container">
        <h2>Đăng Ký</h2>
        <form method="POST" action="">
            <input type="text" name="tenkhachhang" placeholder="Họ và tên" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="diachi" placeholder="Địa chỉ" required>
            <input type="password" name="matkhau" placeholder="Mật khẩu" required>
            <input type="text" name="dienthoai" placeholder="Điện thoại" required>
            <button type="submit" name="submit">Đăng ký</button>
            <p class="register-link">Bạn đã có tài khoản? <a href="index.php?quanly=dangnhap">Đăng nhập ngay</a></p>
        </form>
    </div>
</div>
