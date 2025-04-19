<?php
include("../../config/config.php");
$tenkhachhang = $_POST['tenkhachhang'];
$email = $_POST['email'];
$diachi = $_POST['diachi'];
$matkhau = md5($_POST['matkhau']); // Mã hóa mật khẩu bằng MD5
$dienthoai = $_POST['dienthoai'];
if(isset($_POST['submit_edit'])){
    $id=$_GET['id'];
    $sql = "UPDATE tbl_dangky SET tenkhachhang='$tenkhachhang', email='$email', diachi='$diachi', matkhau='$matkhau', dienthoai='$dienthoai' WHERE id_dangky=$id";
    mysqli_query($mysqli, $sql);
    header('location:../../index.php?action=quanlykhachhang&&query=xem');
}else{
    $id=$_GET['id'];
    $sql="DELETE FROM tbl_dangky WHERE id_dangky=$id";
    mysqli_query($mysqli, $sql);
    header('location:../../index.php?action=quanlykhachhang&&query=xem');
}
?>