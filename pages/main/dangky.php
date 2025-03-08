
    <style>

        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
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
        }
        button:hover {
            background: #0056b3;
        }
    </style>
<?php
include('admincp/config/config.php');
if(isset($_POST['submit'])) {
    $tenkhachhang = $_POST['tenkhachhang'];
    $email = $_POST['email'];
    $diachi = $_POST['diachi'];
    $matkhau = password_hash($_POST['matkhau'], PASSWORD_DEFAULT);
    $dienthoai = $_POST['dienthoai'];

    $sql = "INSERT INTO tbl_dangky (tenkhachhang, email, diachi, matkhau, dienthoai) VALUES ('$tenkhachhang', '$email', '$diachi', '$matkhau', '$dienthoai')";
    
    if(mysqli_query($mysqli,$sql))
    {
        $_SESSION['id_khachhang']=mysqli_insert_id($mysqli);
        $_SESSION['dangky']=$tenkhachhang; 

    }

}






?>
    <div class="container">
        <h2>Đăng Ký</h2>
        <form method="POST" action="">
            <input type="text" name="tenkhachhang" placeholder="Họ và tên" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="diachi" placeholder="Địa chỉ" required>
            <input type="password" name="matkhau" placeholder="Mật khẩu" required>
            <input type="text" name="dienthoai" placeholder="Điện thoại" required>
            <button type="submit" name="submit">Đăng ký</button>
        </form>
    </div>
