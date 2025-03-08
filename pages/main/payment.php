<?php
include "../../admincp/config/config.php"; 
session_start();
if(isset($_SESSION['id_khachhang']))
{
    $id_customer=$_SESSION['id_khachhang'];
    $code_cart=rand(10000,99999);
    $sql="INSERT INTO tbl_giohang(id_khachhang,ma_giohang,trangthai_giohang) VALUES ('$id_customer', '$code_cart', '1')";
    $sql_query=mysqli_query($mysqli,$sql);
    if($sql_query){
        foreach($_SESSION['cart'] as $key => $value){
            $id_sp=$value['id'];
            $quantity=$value['soluong'];
            $sql_detail="INSERT INTO tbl_giohang_chitiet(ma_giohang,id_sanpham,soluong) VALUES ('$code_cart', '$id_sp', '$quantity')";
            $query_detail=mysqli_query($mysqli,$sql_detail);
        }
    }
    unset($_SESSION['cart']);
}
?>