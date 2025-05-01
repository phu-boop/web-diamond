<?php
if(!isset($_SESSION['id_khachhang'])){
    echo "<script>
            alert('Bạn chưa đăng nhập');
            window.location.href = 'index.php?quanly=dangnhap';
          </script>";
    exit();
}
// Phần còn lại của mã
?>