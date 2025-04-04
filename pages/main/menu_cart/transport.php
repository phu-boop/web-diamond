<?php
if (isset($_SESSION['id_khachhang'])) {
    if (isset($_POST['promotion_id'])) {
        $_SESSION['selected_promotion'] = $_POST['promotion_id']; // Lưu khuyến mãi vào session
    }
    // Kiểm tra nếu form "thêm vận chuyển" được gửi
    if (isset($_POST['themvanchuyen'])) {
        $ten = $_POST['ten'];
        $sdt = $_POST['sdt'];
        $diachi = $_POST['diachi'];
        $ghi_chu = $_POST['ghi_chu'];
        $id_dangky = $_SESSION['id_khachhang'];

        // Kiểm tra các trường đầu vào trước khi thêm vào CSDL
        if (empty($ten) || empty($sdt) || empty($diachi)) {
            echo "<script>alert('Vui lòng nhập đầy đủ thông tin.');</script>";
        } else {
            // Truy vấn SQL để thêm dữ liệu vào bảng tbl_vanchuyen
            $sql = "INSERT INTO tbl_vanchuyen (ten, sdt, diachi, ghi_chu, id_dangky) 
                    VALUES ('$ten', '$sdt', '$diachi', '$ghi_chu', '$id_dangky')";
            if (mysqli_query($mysqli, $sql)) {
                echo "<script>alert('Thêm thông tin vận chuyển thành công!');</script>";
            } else {
                echo "<script>alert('Lỗi khi thêm thông tin: " . mysqli_error($mysqli) . "');</script>";
            }
        }
    }

    // Kiểm tra nếu form "cập nhật vận chuyển" được gửi
    if (isset($_POST['capnhatvanchuyen'])) {
        $ten = $_POST['ten'];
        $sdt = $_POST['sdt'];
        $diachi = $_POST['diachi'];
        $ghi_chu = $_POST['ghi_chu'];
        $id_dangky = $_SESSION['id_khachhang'];

        // Kiểm tra các trường đầu vào trước khi cập nhật
        if (empty($ten) || empty($sdt) || empty($diachi)) {
            echo "<script>alert('Vui lòng nhập đầy đủ thông tin.');</script>";
        } else {
            // Truy vấn SQL để cập nhật thông tin vận chuyển cho id_dangky
            $sql = "UPDATE tbl_vanchuyen 
                    SET ten = '$ten', sdt = '$sdt', diachi = '$diachi', ghi_chu = '$ghi_chu'
                    WHERE id_dangky = '$id_dangky'";

            if (mysqli_query($mysqli, $sql)) {
                echo "<script>alert('Cập nhật thông tin vận chuyển thành công!');</script>";
            } else {
                echo "<script>alert('Lỗi khi cập nhật thông tin: " . mysqli_error($mysqli) . "');</script>";
            }
        }
    }

    // Lấy thông tin vận chuyển từ CSDL
    $id_khachhang = $_SESSION['id_khachhang'];
    $sql = "SELECT * FROM tbl_vanchuyen WHERE id_dangky = '$id_khachhang'";
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        // Lặp qua các dòng dữ liệu
        while ($row = $result->fetch_assoc()) {
            $ten = $row['ten'];
            $sdt = $row['sdt'];
            $diachi = $row['diachi'];
            $ghi_chu = $row['ghi_chu'];
        }
    }
} else {
    echo "<script>alert('Bạn chưa đăng nhập!'); window.location.href='index.php?quanly=dangnhap';</script>";
}
?>

<h2>Nhập thông tin vận chuyển</h2>
<div class="container_page_transport">
    <form action="#" method="POST">
        <div class="form-group">
            <label for="ten">Tên người nhận:</label>
            <input type="text" id="ten" name="ten" value="<?php echo isset($ten) ? $ten : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="sdt">Số điện thoại:</label>
            <input type="number" id="sdt" name="sdt" value="<?php echo isset($sdt) ? $sdt : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="diachi">Địa chỉ:</label>
            <input type="text" id="diachi" name="diachi" value="<?php echo isset($diachi) ? $diachi : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="ghi_chu">Ghi chú:</label>
            <input type="text" id="ghi_chu" name="ghi_chu" value="<?php echo isset($ghi_chu) ? $ghi_chu : ''; ?>" >
        </div>
        
        <?php if (!isset($ten) || !isset($sdt)) { ?>
            <button name="themvanchuyen" type="submit">Áp dụng</button>
        <?php } else { ?>
            <button name="capnhatvanchuyen" type="submit">Cập nhật</button>
        <?php } ?>
    </form>
</div>

<a href="index.php?quanly=giohang&buoc=thanhtoan" class="btn btn-primary"> <span>Thanh Toán</span> <i class="fa-solid fa-arrow-right"></i></a>