<?php
include("../../config/config.php");
$image = $_FILES['image']['name'];
$image_tmp= $_FILES['image']['tmp_name'];
$image = time().'_'.$image;
$namecategory = $_POST['namecategory'];
$order = $_POST['order'];
if(isset($_POST['addcategory'])){
    $sql = "INSERT INTO tbl_danhmuc(tendanhmuc, thutu, hinhanh) VALUES ('$namecategory', '$order', '$image')";
    mysqli_query($mysqli, $sql);
    move_uploaded_file($image_tmp, 'image_category/'.$image);
    header('Location:../../index.php?action=quanlydanhmucsanpham&&query=them');
}elseif(isset($_POST['editcategory'])){
    $id = $_GET['id_danhmuc'];
    if($image!=""){
        $sql = "SELECT * FROM tbl_danhmuc WHERE id_danhmuc = '$id'";
        $query = mysqli_query($mysqli, $sql);
        while($row = mysqli_fetch_array($query)){
            unlink('image_category/'.$row['hinhanh']);
        }
        $sql_update = "UPDATE tbl_danhmuc SET tendanhmuc = '$namecategory', thutu = '$order', hinhanh='$image'  WHERE id_danhmuc = '$id'";
        mysqli_query($mysqli, $sql_update);
        move_uploaded_file($image_tmp, 'image_category/'.$image);

    }else{
        $sql = "UPDATE tbl_danhmuc SET tendanhmuc = '$namecategory', thutu = '$order' WHERE id_danhmuc = '$id'";
        mysqli_query($mysqli, $sql);
        
    }
    header('Location:../../index.php?action=quanlydanhmucsanpham&&query=them');
}else{
    $id = $_GET['id_danhmuc'];
    $sql = "SELECT * FROM tbl_danhmuc WHERE id_danhmuc = '$id'";
    $query = mysqli_query($mysqli, $sql);
    while($row = mysqli_fetch_array($query)){
        unlink('image_category/'.$row['hinhanh']);
    }
    $sql_xoa = "DELETE FROM tbl_danhmuc WHERE id_danhmuc = '$id'";
    mysqli_query($mysqli, $sql_xoa);
    header('Location:../../index.php?action=quanlydanhmucsanpham&&query=them');
}

?>