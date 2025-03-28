<?php
// require("../../../carbon/autoload.php");
// use Carbon\Carbon;
// use CarbonInterval;

// $now = Carbon::now('Asia/Ho_Chi_Minh');

if (isset($_GET['vnp_Amount'])) {
    $vnp_Amount = $_GET['vnp_Amount'];
    $vnp_BankCode = $_GET['vnp_BankCode'];
    $vnp_BankTranNo = $_GET['vnp_BankTranNo'];
    $vnp_OrderInfo = $_GET['vnp_OrderInfo'];
    $vnp_PayDate = $_GET['vnp_PayDate'];
    $vnp_TmnCode = $_GET['vnp_TmnCode'];
    $vnp_TransactionNo = $_GET['vnp_TransactionNo'];
    $vnp_CardType = $_GET['vnp_CardType'];
    $code_cart = $_SESSION['code_cart'];

    // Insert into database
    $insert_vnpay = "INSERT INTO tbl_vnpay (vnp_amount, code_cart, vnp_bankCode, vnp_banktranNo, vnp_CardType, vnp_orderInfo, vnp_payDate, vnp_tmnCode, vnp_transactionNo) 
                     VALUES ('$vnp_Amount','$code_cart','$vnp_BankCode', '$vnp_BankTranNo', '$vnp_CardType', '$vnp_OrderInfo', '$vnp_PayDate', '$vnp_TmnCode', '$vnp_TransactionNo')";

    $cart_query = mysqli_query($mysqli, $insert_vnpay);

    if ($cart_query) {
        echo "<h3>Giao dịch thanh toán bằng VNPAY thành công</h3>";
        echo "<p>Vui lòng vào trang <a target='_blank' href='#'>Lịch sử đơn hàng</a> để xem chi tiết đơn hàng của bạn</p>";
        $id_customer = $_SESSION['id_khachhang'];
        $id_khuyenmai=$_SESSION['id_khuyenmai'];
        $thanhtoan=$_SESSION['thanhtoan'];
        $result = mysqli_query($mysqli, "SELECT * FROM tbl_vanchuyen WHERE id_dangky = '$_SESSION[id_khachhang]'");

        if ($result) {
            // Lấy kết quả từ truy vấn
            $row = mysqli_fetch_assoc($result);

            // Kiểm tra nếu có dữ liệu
            if ($row) {
                $id_vanchuyen = $row['id_vanchuyen'];
            }
        }

        $sql = "INSERT INTO tbl_giohang(id_khachhang, ma_giohang, trangthai_giohang, id_khuyenmai, ngay_mua, pt_thanhtoan, id_vanchuyen, tongtien) 
                VALUES ('$id_customer', '$code_cart', '1', '$id_khuyenmai',NOW(),'$thanhtoan','$id_vanchuyen','".$_SESSION['tong_tien']."')";
        $sql_query = mysqli_query($mysqli, $sql);

        if (!$sql_query) {
            die("Lỗi SQL khi tạo giỏ hàng: " . mysqli_error($mysqli));
        }
        foreach ($_SESSION['cart'] as $key => $value) {
            $id_sp = $value['id'];
            $quantity = $value['soluong'];
            $sql_detail = "INSERT INTO tbl_giohang_chitiet(ma_giohang, id_sanpham, soluong) 
                        VALUES ('$code_cart', '$id_sp', '$quantity')";
            if (!mysqli_query($mysqli, $sql_detail)) {
                die("Lỗi khi thêm sản phẩm vào giỏ hàng: " . mysqli_error($mysqli));
            }
        }
    } else {
        echo "Giao dịch thất bại";
        echo "Lỗi khi thực thi câu lệnh SQL: " . mysqli_error($mysqli);
    }
}
?>