<?php
include_once "../../admincp/config/config.php"; 
session_start();
//thêm vào giỏ hàng
if (isset($_POST['themgiohang']) || isset($_POST['muangay'])) {
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
                'soluong' => 1,
                'giasp' => $row_sp['giasp'],
                'hinhanh' => $row_sp['hinhanh'],
                'masp' => $row_sp['masp'],
            )
        );

        if (isset($_SESSION['cart'])) {
            $found = false;
            $product = array(); 

            foreach ($_SESSION['cart'] as $cart_itm) {
                if ($cart_itm['id'] == $id) {
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
    isset($_POST['muangay']) ? header('location:../../?quanly=giohang&buoc=giamgia') : header("Location:../../?quanly=chitietsanpham&id=" . $id);
}
// Xóa sản phẩm khỏi giỏ hàng
if (isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    $product = array();
    foreach ($_SESSION['cart'] as $cart_itm) {
        if ($cart_itm['id'] != $id) {
            $product[] = $cart_itm;
        }
    }
    $_SESSION['cart'] = $product;
    header('location:../../?quanly=giohang');
}
//xoa tất cả
if(isset($_GET['xoatatca'])){
    unset($_SESSION['cart']);
    header('location:../../?quanly=giohang');
}
//cập nhật số lượng
if(isset($_GET['cong'])){
    $id = $_GET['cong'];
    foreach ($_SESSION['cart'] as $cart_itm) {
        if ($cart_itm['id'] == $id) {
            $cart_itm['soluong'] += 1;
        }
        $product[] = $cart_itm;
    }
    $_SESSION['cart'] = $product;
    header('location:../../?quanly=giohang&buoc=giamgia');
}
if(isset($_GET['giam'])){
    $id = $_GET['giam'];
    foreach ($_SESSION['cart'] as $cart_itm)
    {
        if($cart_itm['id']==$id)
        {
            $cart_itm['soluong']-=1;
        }
        if($cart_itm['soluong']==0)
        {
            continue;
        }
        $product[]=$cart_itm;
    }
    $_SESSION['cart']=$product;
    header('location:../../?quanly=giohang&buoc=giamgia');
}

?>
