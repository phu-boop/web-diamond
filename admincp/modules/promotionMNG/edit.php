
<style>
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            width: 100%;
            background: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 15px;
            cursor: pointer;
        }
        button:hover {
            background: #218838;
        }
    </style>


<div class="container">
    <h2>Thêm Khuyến Mãi</h2>
    <?php
    $id=$_GET['id'];
    $sql = "SELECT * FROM tbl_khuyenmai WHERE id_khuyenmai = $id";
    $query_sql=mysqli_query($mysqli,$sql);
    while($row=mysqli_fetch_array($query_sql)){
    ?>
        <form method="POST" action="modules/promotionMNG/handle.php?id=<?php echo $row['id_khuyenmai'] ;?>">
            <label>Tên khuyến mãi:</label>
            <input value="<?php echo $row['ten_khuyenmai']; ?>" type="text" name="name" required>

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

            <label>Giá trị khuyến mãi:</label>
            <input value="<?php echo $row['giatri']; ?>" type="number" name="value" required>

            <label>Giá trị đơn hàng tối thiểu:</label>
            <input value="<?php echo $row['toithieu_khuyenmai']; ?>" type="number" name="min_order_value">

            <label>Ngày bắt đầu:</label>
            <input value="<?php echo date('Y-m-d\TH:i', strtotime($row['ngay_bd'])); ?>" type="datetime-local" name="start_date" required>

            <label>Ngày kết thúc:</label>
            <input value="<?php echo date('Y-m-d\TH:i', strtotime($row['ngay_kt'])); ?>" type="datetime-local" name="end_date" required>


            <button type="submit" name="submit_edit">Thêm khuyến mãi</button>
        </form>
    <?php } ?>
</div>
