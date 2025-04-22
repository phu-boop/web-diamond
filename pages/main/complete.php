<div class="page_complete">
    <?php
    include "admincp/config/config.php"; 
    require("mail/sendmail.php");
    if (isset($_GET['vnp_Amount'])) {
        // Retrieve VNPAY parameters
        $vnp_Amount = $_GET['vnp_Amount'];
        $vnp_BankCode = $_GET['vnp_BankCode'];
        $vnp_BankTranNo = $_GET['vnp_BankTranNo'];
        $vnp_OrderInfo = $_GET['vnp_OrderInfo'];
        $vnp_PayDate = $_GET['vnp_PayDate'];
        $vnp_TmnCode = $_GET['vnp_TmnCode'];
        $vnp_TransactionNo = $_GET['vnp_TransactionNo'];
        $vnp_CardType = $_GET['vnp_CardType'];
        $code_cart = $_SESSION['code_cart'];

        // Insert into tbl_vnpay
        $insert_vnpay = "INSERT INTO tbl_vnpay (vnp_amount, code_cart, vnp_bankCode, vnp_banktranNo, vnp_CardType, vnp_orderInfo, vnp_payDate, vnp_tmnCode, vnp_transactionNo) 
                        VALUES ('$vnp_Amount', '$code_cart', '$vnp_BankCode', '$vnp_BankTranNo', '$vnp_CardType', '$vnp_OrderInfo', '$vnp_PayDate', '$vnp_TmnCode', '$vnp_TransactionNo')";

        $cart_query = mysqli_query($mysqli, $insert_vnpay);

        if ($cart_query) {
            // Success message
            echo "<h3>Giao dịch thanh toán bằng VNPAY thành công. Cảm ơn quý khách đã đặt hàng!</h3>";
            echo "<p>Vui lòng vào trang <a href='index.php?quanly=giohang&buoc=donhangdadat' class='history-link'>Lịch sử đơn hàng</a> để xem chi tiết đơn hàng của bạn.</p>";

            // Retrieve customer and shipping info
            $id_customer = $_SESSION['id_khachhang'];
            $id_khuyenmai = $_SESSION['id_khuyenmai'];
            $thanhtoan = $_SESSION['thanhtoan'];

            $result = mysqli_query($mysqli, "SELECT * FROM tbl_vanchuyen WHERE id_dangky = '$id_customer'");
            $id_vanchuyen = null;

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $id_vanchuyen = $row['id_vanchuyen'];
            } else {
                die("Lỗi: Không tìm thấy thông tin vận chuyển.");
            }

            // Insert into tbl_giohang
            $sql = "INSERT INTO tbl_giohang (id_khachhang, ma_giohang, trangthai_giohang, id_khuyenmai, ngay_mua, pt_thanhtoan, id_vanchuyen, tongtien) 
                    VALUES ('$id_customer', '$code_cart', '1', '$id_khuyenmai', NOW(), '$thanhtoan', '$id_vanchuyen', '" . $_SESSION['tong_tien'] . "')";
            $sql_query = mysqli_query($mysqli, $sql);

            if (!$sql_query) {
                die("Lỗi SQL khi tạo giỏ hàng: " . mysqli_error($mysqli));
            }

            // Insert cart details
            foreach ($_SESSION['cart'] as $value) {
                $id_sp = $value['id'];
                $quantity = $value['soluong'];
                $sql_detail = "INSERT INTO tbl_giohang_chitiet (ma_giohang, id_sanpham, soluong) 
                            VALUES ('$code_cart', '$id_sp', '$quantity')";
                if (!mysqli_query($mysqli, $sql_detail)) {
                    die("Lỗi khi thêm sản phẩm vào giỏ hàng: " . mysqli_error($mysqli));
                }
            }

            // Prepare email content
            $tong_tien = 0;
            $chi_tiet_don_hang = "";

            foreach ($_SESSION['cart'] as $value) {
                $tensanpham = $value['tensanpham'];
                $id_sp = $value['id'];
                $quantity = $value['soluong'];
                $price = $value['giasp'];
                $total = $quantity * $price;
                $tong_tien += $total;

                $chi_tiet_don_hang .= "
                    <tr>
                        <td style='padding:10px;border:1px solid #ddd;text-align:center;'>$tensanpham</td>
                        <td style='padding:10px;border:1px solid #ddd;text-align:center;'>$quantity</td>
                        <td style='padding:10px;border:1px solid #ddd;text-align:center;'>" . number_format($price, 0, ',', '.') . " VND</td>
                        <td style='padding:10px;border:1px solid #ddd;text-align:center;color:#d9534f;font-weight:bold;'>
                            " . number_format($total, 0, ',', '.') . " VND
                        </td>
                    </tr>";
            }

            // Apply discount if applicable
            $giam_gia = 0;
            if ($id_khuyenmai > 0) {
                $sql_km = "SELECT * FROM tbl_khuyenmai WHERE id_khuyenmai = '$id_khuyenmai'";
                $query_km = mysqli_query($mysqli, $sql_km);
                if ($row_km = mysqli_fetch_assoc($query_km)) {
                    $loai_km = $row_km['loai_khuyenmai'];
                    $giatri_km = $row_km['giatri'];
                    $toithieu_km = $row_km['toithieu_khuyenmai'];

                    if ($tong_tien >= $toithieu_km) {
                        if ($loai_km == 'phantram') {
                            $giam_gia = ($tong_tien * $giatri_km) / 100;
                        } else if ($loai_km == 'codinh') {
                            $giam_gia = $giatri_km;
                        }
                    }
                }
            }

            // Calculate final total
            $tong_sau_giam = max(0, $tong_tien - $giam_gia);

            // Validate email
            if (!isset($_SESSION['mail']) || empty($_SESSION['mail'])) {
                die("Lỗi: Không tìm thấy email để gửi xác nhận đơn hàng.");
            }
            $maildathang = $_SESSION['mail'];

            // Email content
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
                <p>Xin chào <b>" . htmlspecialchars($_SESSION['dangky']) . "</b>,</p>
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
                        <td>" . number_format($tong_tien, 0, ',', '.') . " VNĐ</td>
                    </tr>
                    <tr>
                        <td colspan='3'><b>Giảm giá:</b></td>
                        <td style='color:red;'>- " . number_format($giam_gia, 0, ',', '.') . " VNĐ</td>
                    </tr>
                    <tr>
                        <td colspan='3'><b>Tổng sau giảm:</b></td>
                        <td style='color:#d9534f;font-weight:bold;'>" . number_format($tong_sau_giam, 0, ',', '.') . " VNĐ</td>
                    </tr>
                </table>
                <p>Chúng tôi sẽ giao hàng sớm nhất!</p>
            </body>
            </html>";

            // Send email
            $mail = new Mailer();
            $mail->dathangmail($tieude, $noidung, $maildathang);

            // Clear cart
            unset($_SESSION['cart']);
            exit();
        } else {
            die("Lỗi khi lưu thông tin thanh toán VNPAY: " . mysqli_error($mysqli));
        }
    }
    ?>
</div>