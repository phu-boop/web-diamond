<?php
if(isset($_POST['login']))
{
    $username=$_POST['username'];
    $passwork=md5($_POST['password']);
    $sql="SELECT * FROM tbl_dangky WHERE email='$username' AND matkhau='$passwork' LIMIT 1";
    $sql_query=mysqli_query($mysqli,$sql);
    $row_count=mysqli_num_rows($sql_query);
    if($row_count>0)
    {   
        $_SESSION['dangnhap']=$username;
        $row = mysqli_fetch_assoc($sql_query);
        $_SESSION['id_khachhang']=$row['id_dangky'];
        echo "<p> ban đăng nhập thành công</p>";
    }
    else{
        echo "<p> bạ đăng nhập thât bại </p>";
    }
}




?>




<style>
    .login-container {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    width: 320px;
    text-align: center;
}

h2 {
    margin-bottom: 20px;
    color: #333;
}

.input-group {
    text-align: left;
    margin-bottom: 15px;
}

label {
    font-size: 14px;
    color: #555;
}

input {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    box-sizing: border-box;
}

input:focus {
    border-color: #ff5e62;
    outline: none;
}

.btn {
    background: #ff5e62;
    color: white;
    border: none;
    padding: 10px;
    width: 100%;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s;
}

.btn:hover {
    background: #e04e55;
}

.register-link {
    margin-top: 10px;
    font-size: 14px;
}

.register-link a {
    color: #ff5e62;
    text-decoration: none;
}

.register-link a:hover {
    text-decoration: underline;
}

</style>

<body>
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
            <p class="register-link">Chưa có tài khoản? <a href="register.html">Đăng ký ngay</a></p>
        </form>
    </div>
</body>