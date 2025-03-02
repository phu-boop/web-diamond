<?php
include("../../config/config.php");
$namecategory = $_POST['namecategory'];
$order = $_POST['order'];
if(isset($_POST['addcategory'])){
    $sql = "INSERT INTO tbl_danhmuc(tendanhmuc, thutu) VALUES ('$namecategory', '$order')";
    mysqli_query($mysqli, $sql);
    header('Location:../../index.php?action=quanlydanhmucsanpham&&query=them');
}elseif(isset($_POST['editcategory'])){
    $id = $_GET['id_danhmuc'];
    $sql = "UPDATE tbl_danhmuc SET tendanhmuc = '$namecategory', thutu = '$order' WHERE id_danhmuc = '$id'";
    mysqli_query($mysqli, $sql);
    header('Location:../../index.php?action=quanlydanhmucsanpham&&query=them');
}else{
    $id = $_GET['id_danhmuc'];
    $sql = "DELETE FROM tbl_danhmuc WHERE id_danhmuc = '$id'";
    mysqli_query($mysqli, $sql);
    header('Location:../../index.php?action=quanlydanhmucsanpham&&query=them');
}

?>