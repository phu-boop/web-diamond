<?php
include("../../config/config.php");
$name = $_POST['name'];
$promotion_type = $_POST["promotion_type"];
$value = $_POST['value'];
$min_order_value = $_POST['min_order_value'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
if(isset($_POST['submit'])){
    $sql="INSERT INTO tbl_khuyenmai(ten_khuyenmai,loai_khuyenmai,giatri,toithieu_khuyenmai,ngay_bd,ngay_kt) VALUES('$name','$promotion_type','$value','$min_order_value','$start_date','$end_date') ";
    mysqli_query($mysqli, $sql);
    header('location:../../index.php?action=quanlykhuyenmai&&query=them');
}elseif(isset($_POST['submit_edit'])){
    $id=$_GET['id'];
    $sql = "UPDATE tbl_khuyenmai SET ten_khuyenmai='$name', loai_khuyenmai='$promotion_type', giatri='$value',toithieu_khuyenmai='$min_order_value', ngay_bd='$start_date', ngay_kt='$end_date' WHERE id_khuyenmai=$id";
    mysqli_query($mysqli,$sql);
    header('location:../../index.php?action=quanlykhuyenmai&&query=them');
}else{
    $id=$_GET['id'];
    $sql="DELETE FROM tbl_khuyenmai WHERE id_khuyenmai=$id";
    mysqli_query($mysqli,$sql);
    header('location:../../index.php?action=quanlykhuyenmai&&query=them');
}


?>