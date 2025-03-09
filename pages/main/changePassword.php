<?php
if(isset($_POST['changePassword']))
{
    $current_password=md5($_POST['current_password']);
    $new_password=md5($_POST['new_password']);
    $confirm_password=md5($_POST['confirm_password']);
    if($confirm_password==$new_password)
    {
        $sql = "UPDATE tbl_dangky SET matkhau = '$new_password' WHERE matkhau='$current_password' AND id_dangky = '".$_SESSION['id_khachhang']."'";
        $query=mysqli_query($mysqli,$sql);
        if (mysqli_affected_rows($mysqli) > 0) {
            echo "Đổi mật khẩu thành công";
        } else {
            echo "Sai mật khẩu hiện tại hoặc không có thay đổi!";
        }
    }else{
        echo "xac nhận mk không đúng";
    }


}
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi Mật Khẩu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
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
</body>
</html>
<style>
/* Reset mặc định */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}


h2 {
    margin-bottom: 15px;
    color: #333;
}

.input-group {
    margin-bottom: 15px;
    text-align: left;
}

.input-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

.input-group input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    width: 100%;
    padding: 10px;
    background: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background: #0056b3;
}


</style>