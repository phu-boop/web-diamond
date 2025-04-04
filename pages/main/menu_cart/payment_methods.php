
<h2>Phương thức thanh toán</h2>
<div class="payment-method">
    <form action="pages/main/menu_cart/handle_cart.php?promotion_id=<?php echo isset($_SESSION['selected_promotion'])? $_SESSION['selected_promotion'] : 0 ?>; " method="POST">
    <div class="payment-option">
            <input type="radio" id="tienmat" name="payment" value="tienmat">
            <label for="tienmat">Tiền mặt</label>
        </div>
        <div class="payment-option">
            <input type="radio" id="chuyenkhoan" name="payment" value="chuyenkhoan" checked>
            <label for="chuyenkhoan">Chuyển khoản</label>
        </div>
        <div class="payment-option">
            <input type="radio" id="vnpay" name="payment" value="vnpay">
            <label for="vnpay">Vnpay</label>
        </div>
        <button type="submit" class="payment-btn">Thanh toán ngay</button>
        </form>
        <form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded" action="pages/main/menu_cart/handle_momo.php?promotion_id=<?php echo isset($_SESSION['selected_promotion'])? $_SESSION['selected_promotion'] : 0 ?>;">
            <input type="submit" name="momo" value="Thanh toán MOMO QRcode" class="btn btn-danger">
        </form>
</div>
