<div class="payment-method">
    <h2>Phương thức thanh toán</h2>
    <form action="pages/main/menu_cart/handle_cart.php?promotion_id=<?php echo $_SESSION['selected_promotion'] ?>; " method="POST">
        <div class="payment-option">
            <input type="radio" id="tienmat" name="payment" value="tienmat">
            <label for="tienmat">Tiền mặt</label>
        </div>
        <div class="payment-option">
            <input type="radio" id="chuyenkhoan" name="payment" value="chuyenkhoan" checked>
            <label for="chuyenkhoan">Chuyển khoản</label>
        </div>
        <div class="payment-option">
            <input type="radio" id="momo" name="payment" value="momo">
            <label for="momo">Momo</label>
        </div>
        <div class="payment-option">
            <input type="radio" id="vnpay" name="payment" value="vnpay">
            <label for="vnpay">Vnpay</label>
        </div>
        <div class="payment-option">
            <input type="radio" id="paypal" name="payment" value="paypal">
            <label for="paypal">Paypal</label>
        </div>
        <button type="submit" class="payment-btn">Thanh toán ngay</button>
    </form>
</div>
<style>
.payment-method {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    width: 300px;
    margin: auto;
    font-family: Arial, sans-serif;
}

.payment-method h2 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 20px;
    color: #333;
}

.payment-option {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.payment-option input[type="radio"] {
    margin-right: 10px;
    cursor: pointer;
}

.payment-option label {
    font-size: 16px;
    cursor: pointer;
    color: #555;
}

.payment-btn {
    width: 100%;
    padding: 12px;
    background-color: #f44336;  /* Màu đỏ */
    border: none;
    color: white;
    font-size: 18px;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.payment-btn:hover {
    background-color: #d32f2f;
}

.payment-btn:active {
    background-color: #c62828;
}
</style>