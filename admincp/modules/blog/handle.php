<?php
include("../../config/config.php");

$title = $_POST['title'];
$content = $_POST['content'];
$date = date("Y-m-d H:i:s");

// ===== THÊM BÀI VIẾT =====
if (isset($_POST['submit'])) {
    $image = '';
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image = time() . '_' . $image;
        move_uploaded_file($image_tmp, 'image_blog/' . $image);
    }

    $sql_blog = "INSERT INTO tbl_baiviet(tieude, noidung, hinhanh, ngaydang) VALUES ('$title', '$content', '$image', '$date')";
    mysqli_query($mysqli, $sql_blog);
    header('location:../../index.php?action=quanlybaiviet&&query=them');

// ===== SỬA BÀI VIẾT =====
} elseif (isset($_POST['edit'])) {
    $id = $_GET['id'];
    $sql = "SELECT hinhanh FROM tbl_baiviet WHERE id_baiviet = $id LIMIT 1";
    $query_sql = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($query_sql);
    $old_image = $row['hinhanh'];

    $new_filename = $old_image;

    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $file_extension = strtolower(pathinfo($image, PATHINFO_EXTENSION));

        if (!in_array($file_extension, $allowed_extensions)) {
            die("Lỗi: Chỉ chấp nhận file JPG, JPEG, PNG, GIF.");
        }

        // Xoá ảnh cũ nếu có
        if (!empty($old_image) && file_exists('image_blog/' . $old_image)) {
            unlink('image_blog/' . $old_image);
        }

        $new_filename = time() . '_' . basename($image);
        move_uploaded_file($image_tmp, 'image_blog/' . $new_filename);
    }

    $sql_update = "UPDATE tbl_baiviet SET tieude = '$title', noidung = '$content', hinhanh = '$new_filename', ngaydang = '$date' WHERE id_baiviet = $id";
    mysqli_query($mysqli, $sql_update);
    header('location:../../index.php?action=quanlybaiviet&&query=them');

// ===== XOÁ BÀI VIẾT =====
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbl_baiviet WHERE id_baiviet = $id LIMIT 1";
    $query_sql = mysqli_query($mysqli, $sql);
    while ($row = mysqli_fetch_array($query_sql)) {
        if (!empty($row['hinhanh']) && file_exists('image_blog/' . $row['hinhanh'])) {
            unlink('image_blog/' . $row['hinhanh']);
        }
    }
    $sql_xoa = "DELETE FROM tbl_baiviet WHERE id_baiviet = $id";
    mysqli_query($mysqli, $sql_xoa);
    header('location:../../index.php?action=quanlybaiviet&&query=them');
}
?>
