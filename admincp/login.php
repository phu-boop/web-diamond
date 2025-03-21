<?php
session_start();
include('config/config.php');
if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password' LIMIT 1";
    $row = mysqli_query($mysqli, $sql);
    $count = mysqli_num_rows($row);
    if($count > 0)
    {
        $_SESSION['username'] = $username;
        header('location: index.php');
    }
    else
    {
        echo "<script>alert('Tên đăng nhập hoặc mật khẩu không đúng. Vui lòng nhập lại.')</script>";
    }

}
?>





<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="login-container">
        <a href="index.php" class="logo-2">
            <svg width="60" height="60" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"
                 fill="#ffffff" stroke="#ed8383" stroke-width="3">
                <polygon points="10,40 30,10 50,10 70,10 90,40"/>
                <polygon points="30,10 50,40 70,10"/>
                <polygon points="10,40 50,90 30,40"/>
                <polygon points="30,40 50,90 50,40"/>
                <polygon points="50,40 50,90 70,40"/>
                <polygon points="70,40 50,90 90,40"/>
            </svg>
            <div class="logo-content">
                <div class="title-logo">LUXURY</div>
                <div class="subtitle-logo">THE ART OF JEWELRY</div>
            </div>
        </a>
        <h2>Đăng nhập</h2>
        <form action="login.php" method="POST" name="login">
            <div class="input-group">
                <label for="username">Tên đăng nhập</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn" name="login">Đăng nhập</button>
            <p class="register-link">Chưa có tài khoản? <a href="#">Đăng ký ngay</a></p>
        </form>
    </div>
</body>
</html>
