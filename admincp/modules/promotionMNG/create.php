<div class="page_promotion_create">
    <div class="create_container">
        <div class="top">
            <div>
                <p><h2>Danh sách khuyến mãi</h2></p>
            </div>
            <div class="search">
                <button class="btn add_category">
                    <i class="fa-solid fa-plus"></i>
                    Thêm khuyến mãi
                </button>
                <div class="gift">
                    <img src="../assets/images/gift.png" alt="quà">
                </div>
            </div>
        </div>
        <div class="form_container">
            <div class="form_add_category">
                <div class="top">
                    <h2>Thêm danh mục</h2>
                    <i class="fa-solid fa-xmark remove_create"></i>
                </div>
                <form method="POST" action="modules/promotionMNG/handle.php">
                    <label>Tên khuyến mãi:</label>
                    <input type="text" name="name" required>

                    <label>Loại khuyến mãi:</label>
                    <select name="promotion_type">
                        <option value="phantram">Giảm theo %</option>
                        <option value="codinh">Giảm theo số tiền</option>
                        <option value="tichdiem">Tặng điểm</option>
                    </select>

                    <label>Giá trị khuyến mãi:</label>
                    <input type="number" name="value" required>

                    <label>Giá trị đơn hàng tối thiểu:</label>
                    <input type="number" name="min_order_value">

                    <label>Ngày bắt đầu:</label>
                    <input type="datetime-local" name="start_date" required>

                    <label>Ngày kết thúc:</label>
                    <input type="datetime-local" name="end_date" required>
                    <div class="select_block">
                        <button class="btn add_product" type="submit" name="submit">Thêm khuyến mãi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>