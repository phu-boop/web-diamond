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
    header('Location:../../index.php?action=quanlydanhmucsanpham&&query=them&trang=0');
}elseif(isset($_POST['editcategory'])) {
    if (!isset($_GET['id_danhmuc'])) {
        die("Lỗi: ID danh mục không hợp lệ!");
    }
    $id = mysqli_real_escape_string($mysqli, $_GET['id_danhmuc']);
    $sql = "SELECT hinhanh FROM tbl_danhmuc WHERE id_danhmuc = '$id'";
    $query = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($query);
    $old_image = $row['hinhanh']; 

    if (!empty($_FILES['image']['name'])) {
        if (!empty($old_image) && file_exists('image_category/' . $old_image)) {
            unlink('image_category/' . $old_image);
        }
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $file_extension = strtolower(pathinfo($image, PATHINFO_EXTENSION));

        if (!in_array($file_extension, $allowed_extensions)) {
            die("Lỗi: Chỉ chấp nhận file JPG, JPEG, PNG, GIF.");
        }
        $new_filename = time() . "_" . basename($image);
        move_uploaded_file($image_tmp, 'image_category/' . $new_filename);
    } else {
        $new_filename = $old_image;
    }
    $sql_update = "UPDATE tbl_danhmuc SET tendanhmuc = '$namecategory', thutu = '$order', hinhanh='$new_filename' WHERE id_danhmuc = '$id'";
    mysqli_query($mysqli, $sql_update);
    header('Location:../../index.php?action=quanlydanhmucsanpham&&query=them&trang=0');
}else{
    $id = $_GET['id_danhmuc'];
    $sql = "SELECT * FROM tbl_danhmuc WHERE id_danhmuc = '$id'";
    $query = mysqli_query($mysqli, $sql);
    while($row = mysqli_fetch_array($query)){
        unlink('image_category/'.$row['hinhanh']);
    }
    $sql_xoa = "DELETE FROM tbl_danhmuc WHERE id_danhmuc = '$id'";
    mysqli_query($mysqli, $sql_xoa);
    header('Location:../../index.php?action=quanlydanhmucsanpham&&query=them&trang=0');
}
?>