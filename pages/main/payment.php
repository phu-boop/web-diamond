<?php
    include "../../admincp/config/config.php"; 
    require("../../mail/sendmail.php");
    session_start();

    if (!isset($_SESSION['id_khachhang'])) {
        die("Lỗi: Bạn cần đăng nhập để đặt hàng.");
    }

    $id_customer = $_SESSION['id_khachhang'];
    $code_cart = rand(10000, 99999);
    $id_khuyenmai = isset($_GET['promotion_id']) ? (int) $_GET['promotion_id'] : 0;

    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        die("Lỗi: Giỏ hàng của bạn đang trống!");
    }

    // Tạo giỏ hàng mới
    $sql = "INSERT INTO tbl_giohang(id_khachhang, ma_giohang, trangthai_giohang, id_khuyenmai, ngay_mua) 
            VALUES ('$id_customer', '$code_cart', '1', '$id_khuyenmai',NOW())";
    $sql_query = mysqli_query($mysqli, $sql);

    if (!$sql_query) {
        die("Lỗi SQL khi tạo giỏ hàng: " . mysqli_error($mysqli));
    }

    $tong_tien = 0;
    $chi_tiet_don_hang = "";

    foreach ($_SESSION['cart'] as $key => $value) {
        $tensanpham = $value['tensanpham'];
        $id_sp = $value['id'];
        $quantity = $value['soluong'];
        $price = $value['giasp']; 
        $total = $quantity * $price;
        $tong_tien += $total;

        $sql_detail = "INSERT INTO tbl_giohang_chitiet(ma_giohang, id_sanpham, soluong) 
                    VALUES ('$code_cart', '$id_sp', '$quantity')";
        if (!mysqli_query($mysqli, $sql_detail)) {
            die("Lỗi khi thêm sản phẩm vào giỏ hàng: " . mysqli_error($mysqli));
        }

        $chi_tiet_don_hang .= "
            <tr>
                <td style='padding:10px;border:1px solid #ddd;text-align:center;'>$tensanpham</td>
                <td style='padding:10px;border:1px solid #ddd;text-align:center;'>$quantity</td>
                <td style='padding:10px;border:1px solid #ddd;text-align:center;'>".number_format($price, 0, ',', '.')." VND</td>
                <td style='padding:10px;border:1px solid #ddd;text-align:center;color:#d9534f;font-weight:bold;'>
                    ".number_format($total, 0, ',', '.')." VND
                </td>
            </tr>";
    }

    // Áp dụng khuyến mãi nếu có
    $giam_gia = 0;
    if ($id_khuyenmai > 0) {
        $sql_km = "SELECT * FROM tbl_khuyenmai WHERE id_khuyenmai = '$id_khuyenmai'";
        $query_km = mysqli_query($mysqli, $sql_km);
        if ($row_km = mysqli_fetch_assoc($query_km)) {
            $loai_km = $row_km['loai_khuyenmai']; // 'phantram' hoặc 'codinh'
            $giatri_km = $row_km['giatri'];
            $toithieu_km = $row_km['toithieu_khuyenmai'];

            // Kiểm tra nếu tổng tiền đủ điều kiện giảm giá
            if ($tong_tien >= $toithieu_km) {
                if ($loai_km == 'phantram') {
                    $giam_gia = ($tong_tien * $giatri_km) / 100;
                } else if ($loai_km == 'codinh') {
                    $giam_gia = $giatri_km;
                }
            }
        }
    }

    // Tính tổng tiền sau khi giảm giá
    $tong_sau_giam = max(0, $tong_tien - $giam_gia);

    // Cập nhật tổng tiền vào giỏ hàng
    $sql_update = "UPDATE tbl_giohang SET tongtien = '$tong_sau_giam' WHERE ma_giohang = '$code_cart'";
    mysqli_query($mysqli, $sql_update);

    if (!isset($_SESSION['mail']) || empty($_SESSION['mail'])) {
        die("Lỗi: Không tìm thấy email để gửi xác nhận đơn hàng.");
    }
    $maildathang = $_SESSION['mail'];

    // Nội dung email
    $tieude = "LuxuryStore_Bạn đã đặt hàng thành công";
    $noidung = "
    <!DOCTYPE html>
    <html lang='vi'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Mail đơn hàng</title>
    </head>
    <body>
        <p>Xin chào <b>" . $_SESSION['dangky'] . "</b>,</p>
        <p>Bạn đã đặt hàng thành công tại Luxury Store.</p>
        <table border='1' cellspacing='0' cellpadding='10'>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng</th>
            </tr>
            $chi_tiet_don_hang
            <tr>
                <td colspan='3'><b>Tổng cộng:</b></td>
                <td>".number_format($tong_tien, 0, ',', '.')." VNĐ</td>
            </tr>
            <tr>
                <td colspan='3'><b>Giảm giá:</b></td>
                <td style='color:red;'>- ".number_format($giam_gia, 0, ',', '.')." VNĐ</td>
            </tr>
            <tr>
                <td colspan='3'><b>Tổng sau giảm:</b></td>
                <td style='color:#d9534f;font-weight:bold;'>".number_format($tong_sau_giam, 0, ',', '.')." VNĐ</td>
            </tr>
        </table>
        <p>Chúng tôi sẽ giao hàng sớm nhất!</p>
    </body>
    </html>";

    $mail = new Mailer();
    $mail->dathangmail($tieude, $noidung, $maildathang);

    // Xóa giỏ hàng sau khi đặt hàng thành công
    unset($_SESSION['cart']);
    header("location:../../index.php?quanly=hoangthanh")
?>
