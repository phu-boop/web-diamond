<?php
include_once "../../admincp/config/config.php"; 
session_start();
if (isset($_POST['themgiohang'])) {
    $id = $_GET['id'];

    // Lấy thông tin sản phẩm từ database
    $san_pham = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$id' LIMIT 1";
    $query_sp = mysqli_query($mysqli, $san_pham);
    $row_sp = mysqli_fetch_array($query_sp);

    if ($row_sp) {
        $new_product = array(
            array(
                'tensanpham' => $row_sp['tensanpham'],
                'id' => $id,
                'soluong' => $_POST['soluong'],
                'giasp' => $row_sp['giasp'],
                'hinhanh' => $row_sp['hinhanh'],
                'masp' => $row_sp['masp'],
            )
        );

        if (isset($_SESSION['cart'])) {
            $found = false;
            $product = array(); 

            foreach ($_SESSION['cart'] as $cart_itm) {
                if ($cart_itm['id_sanpham'] == $id) {
                    // Nếu sản phẩm đã có trong giỏ, tăng số lượng thay vì ghi đè
                    $cart_itm['soluong'] += $_POST['soluong'];
                    $found = true;
                }
                $product[] = $cart_itm;
            }

            if ($found == false) {
                $_SESSION['cart'] = array_merge($product, $new_product);
            } else {
                $_SESSION['cart'] = $product;
            }
        } else {
            $_SESSION['cart'] = $new_product;
        }
    }
}

header("Location: ../../index.php?quanly=giohang");
?>
