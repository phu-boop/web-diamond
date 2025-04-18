<?php
if (isset($_SESSION['id_khachhang'])) {
    
} else {
    echo "<script>alert('Bạn chưa đăng nhập!'); window.location.href='index.php?quanly=dangnhap';</script>";
}
?>