<div class="page_edit_promotion">
    <div class="edit_container">
        <div class="top">
            <h2>Sửa Khuyến Mãi</h2>
        </div>
        <?php
        $id=$_GET['id'];
        $sql = "SELECT * FROM tbl_khuyenmai WHERE id_khuyenmai = $id";
        $query_sql=mysqli_query($mysqli,$sql);
        while($row=mysqli_fetch_array($query_sql)){
        ?>
            <form method="POST" action="modules/promotionMNG/handle.php?id=<?php echo $row['id_khuyenmai'] ;?>">
                <label>Tên khuyến mãi:</label>
                <input value="<?php echo $row['ten_khuyenmai']; ?>" type="text" name="name" required>

                <label>Giá trị khuyến mãi:</label>
                <input value="<?php echo $row['giatri']; ?>" type="number" name="value" required>

                <label>Giá trị đơn hàng tối thiểu:</label>
                <input value="<?php echo $row['toithieu_khuyenmai']; ?>" type="number" name="min_order_value">
                <div class="select">
                    <div>
                        <label>Ngày bắt đầu:</label>
                        <input value="<?php echo date('Y-m-d\TH:i', strtotime($row['ngay_bd'])); ?>" type="datetime-local" name="start_date" required>
                    </div>
                    <div>
                        <label>Ngày kết thúc:</label>
                        <input value="<?php echo date('Y-m-d\TH:i', strtotime($row['ngay_kt'])); ?>" type="datetime-local" name="end_date" required>
                    </div>
                    <div>
                        <label>Loại khuyến mãi:</label>
                        <select name="promotion_type">
                            <?php if($row['loai_khuyenmai']=='phantram'){ ?>
                                <option value="phantram">Giảm theo %</option>
                                <option value="codinh">Giảm theo số tiền</option>
                                <option value="tichdiem">Tặng điểm</option>
                            <?php }elseif($row['loai_khuyenmai']=='codinh'){ ?>
                                <option value="codinh">Giảm theo số tiền</option>
                                <option value="phantram">Giảm theo %</option>
                                <option value="tichdiem">Tặng điểm</option>
                            <?php }else{ ?>
                                <option value="codinh">Giảm theo số tiền</option>
                                <option value="phantram">Giảm theo %</option>
                                <option value="tichdiem">Tặng điểm</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <button class="btn edit_product" type="submit" name="submit_edit">sửa khuyến mãi</button>
            </form>
        <?php } ?>
    </div>
</div>

