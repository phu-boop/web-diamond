<?php
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // Truy vấn kiểm tra tài khoản
    $sql = "SELECT * FROM tbl_dangky WHERE email='$username' AND matkhau='$password' LIMIT 1";
    $sql_query = mysqli_query($mysqli, $sql);

    // Đếm số dòng trả về
    $row_count = mysqli_num_rows($sql_query);

    if ($row_count > 0) {
        // Lấy dữ liệu từ kết quả truy vấn
        $row = mysqli_fetch_assoc($sql_query);
        
        // Lưu thông tin vào session
        $_SESSION['dangky'] = $username;
        $_SESSION['id_khachhang'] = $row['id_dangky']; 
        echo "<script>window.location.href='index.php';</script>";
        
    } else {
        echo "<script>alert('Sai tên đăng nhập hoặc mật khẩu!'); window.location.href='index.php?quanly=dangnhap';</script>";
    }
}
?>

<div class="page-login">
    <div class="login-container">
        <h2>Đăng nhập</h2>
        <form action="" method="POST" name="login">
            <div class="input-group">
                <label for="username">Tên đăng nhập(email)</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn" name="login">Đăng nhập</button>
            <p class="register-link">Chưa có tài khoản? <a href="index.php?quanly=dangky">Đăng ký ngay</a></p>
        </form>
    </div>
</div>