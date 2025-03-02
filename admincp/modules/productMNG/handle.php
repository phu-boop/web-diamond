<?php
include("../../config/config.php");
$nameproduct = $_POST['nameproduct'];
$codeproduct = $_POST['codeproduct'];
$priceproduct = $_POST['priceproduct'];
$quantity = $_POST['quantity'];
$image = $_FILES['image']['name'];
$image_tmp= $_FILES['image']['tmp_name'];
$image = time().'_'.$image;
$summary = $_POST['summary'];
$content = $_POST['content'];
$status = $_POST['status'];
if(isset($_POST['addproduct'])){
    $sql = "INSERT INTO tbl_sanpham(tensanpham, masp, giasp, soluong, hinhanh, tomtat, noidung, trangthai) VALUES ('$nameproduct', '$codeproduct', '$priceproduct', '$quantity', '$image', '$summary', '$content' , '$status')";
    mysqli_query($mysqli, $sql);
    move_uploaded_file($image_tmp, 'image_product/'.$image);
    header('Location:../../index.php?action=quanlysanpham&&query=them');
}elseif(isset($_POST['editcategory'])){
    $id = $_GET['id_danhmuc'];
    $sql = "UPDATE tbl_danhmuc SET tendanhmuc = '$namecategory', thutu = '$order' WHERE id_danhmuc = '$id'";
    mysqli_query($mysqli, $sql);
    header('Location:../../index.php?action=quanlydanhmucsanpham&&query=them');
}else{
    $id = $_GET['id_sanpham'];
    $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$id'";
    $query = mysqli_query($mysqli, $sql);
    while($row = mysqli_fetch_array($query)){
        unlink('image_product/'.$row['hinhanh']);
    }
    $sql_xoa = "DELETE FROM tbl_sanpham WHERE id_sanpham = '$id'";
    mysqli_query($mysqli, $sql_xoa);
    header('Location:../../index.php?action=quanlysanpham&&query=them');
}

?>