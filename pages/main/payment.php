<?php
include "../../admincp/config/config.php"; 
require("../../mail/sendmail.php");
session_start();

if(isset($_SESSION['id_khachhang'])) {
    $id_customer = $_SESSION['id_khachhang'];
    $code_cart = rand(10000, 99999);
    $id_khuyenmai = isset($_GET['promotion_id']) ? mysqli_real_escape_string($mysqli, $_GET['promotion_id']) : null;
    $sql = "INSERT INTO tbl_giohang(id_khachhang, ma_giohang, trangthai_giohang, id_khuyenmai) 
            VALUES ('$id_customer', '$code_cart', '1', '$id_khuyenmai')";
    $sql_query = mysqli_query($mysqli, $sql);

    if ($sql_query) {
        $tong_tien = 0;  // Khởi tạo tổng tiền
        $chi_tiet_don_hang = "";  // Khởi tạo chi tiết đơn hàng

        foreach ($_SESSION['cart'] as $key => $value) {
            $id_sp = $value['id'];
            $quantity = $value['soluong'];
            $price = $value['giasp']; 
            $total = $quantity * $price;
            $tong_tien += $total;

            // Chèn chi tiết giỏ hàng vào DB
            $sql_detail = "INSERT INTO tbl_giohang_chitiet(ma_giohang, id_sanpham, soluong) 
                           VALUES ('$code_cart', '$id_sp', '$quantity')";
            mysqli_query($mysqli, $sql_detail);

            // Tạo danh sách sản phẩm trong email
            $chi_tiet_don_hang .= "
                <tr>
                    <td style='padding:10px;border:1px solid #ddd;text-align:center;'>...</td>
                    <td style='padding:10px;border:1px solid #ddd;text-align:center;'>$quantity</td>
                    <td style='padding:10px;border:1px solid #ddd;text-align:center;'>".number_format($price, 0, ',', '.')." VND</td>
                    <td style='padding:10px;border:1px solid #ddd;text-align:center;color:#d9534f;font-weight:bold;'>
                        ".number_format($total, 0, ',', '.')." VND
                    </td>
                </tr>";
        }

        // Gửi email xác nhận đơn hàng
        $tieude = "LuxuryStore_Bạn đã đặt hàng thành công";
        $noidung = "
        <!DOCTYPE html>
        <html lang='vi'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Mail đơn hàng</title>
        </head>
        <body style='font-family:Arial,sans-serif;margin:0;padding:0;background-color:#f4f4f4;'>
            <div style='max-width:600px;margin:20px auto;background:#fff;padding:20px;border-radius:10px;
                        box-shadow:0 0 10px rgba(0,0,0,0.1);'>
                
                <div style='text-align:center;background:#007bff;color:#fff;padding:15px;border-radius:10px 10px 0 0;'>
                    <h2 style='margin:0;'>Đơn hàng của bạn</h2>
                </div>

                <div style='padding:20px;color:#333;'>
                    <p>Xin chào <b>" . $_SESSION['dangky'] . "</b>,</p>
                    <p>Cảm ơn bạn đã đặt hàng tại <b>Shop Luxury Store</b>. Dưới đây là thông tin đơn hàng của bạn:</p>

                    <table style='width:100%;border-collapse:collapse;margin-top:20px;'>
                        <tr>
                            <th style='background:#007bff;color:#fff;padding:10px;border:1px solid #ddd;'>Sản phẩm</th>
                            <th style='background:#007bff;color:#fff;padding:10px;border:1px solid #ddd;'>Số lượng</th>
                            <th style='background:#007bff;color:#fff;padding:10px;border:1px solid #ddd;'>Giá</th>
                            <th style='background:#007bff;color:#fff;padding:10px;border:1px solid #ddd;'>Tổng</th>
                        </tr>
                        $chi_tiet_don_hang
                        <tr>
                            <td colspan='3' style='padding:10px;border:1px solid #ddd;text-align:right;'><b>Tổng cộng:</b></td>
                            <td style='padding:10px;border:1px solid #ddd;text-align:center;color:#d9534f;font-weight:bold;'>
                                ".number_format($tong_tien, 0, ',', '.')." VNĐ
                            </td>
                        </tr>
                    </table>

                    <p>Chúng tôi sẽ sớm xử lý đơn hàng và giao hàng trong thời gian nhanh nhất.</p>
                    <p>Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi qua email <b>phunla2784@gmail.com</b>.</p>
                </div>

                <div style='text-align:center;margin-top:20px;font-size:14px;color:#777;'>
                    <p>&copy; 2025 Shop Luxury Store. Mọi quyền được bảo lưu.</p>
                </div>
            </div>
        </body>
        </html>";

        $maildathang = $_SESSION['mail'];
        $mail = new Mailer();
        $mail->dathangmail($tieude, $noidung, $maildathang);
    }

    // Xóa giỏ hàng sau khi đặt hàng thành công
    unset($_SESSION['cart']);
}
?>
