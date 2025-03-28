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

<div class="container_page_transport">
    <h2>Nhập thông tin vận chuyển</h2>
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
            <button name="themvanchuyen" type="submit">Gửi</button>
        <?php } else { ?>
            <button name="capnhatvanchuyen" type="submit">Cập nhật</button>
            <a href="index.php?quanly=giohang&buoc=thanhtoan">Tiếp theo</a>
        <?php } ?>
    </form>
</div>

<style>
       .container_page_transport {
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
    width: 420px;
    margin: 30px auto;
    font-family: Arial, sans-serif;
}

h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: bold;
    color: #555;
    margin-bottom: 8px;
}

input[type="text"], input[type="number"] {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
    box-sizing: border-box;
    transition: border 0.3s ease-in-out;
}

input[type="text"]:focus, input[type="number"]:focus {
    border-color: #28a745;
    outline: none;
}

button {
    width: 100%;
    padding: 12px;
    background-color: #28a745;
    border: none;
    color: white;
    font-size: 18px;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
}

button:hover {
    background-color: #218838;
}

button:active {
    background-color: #1e7e34;
}
</style>
