<?php
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $sql="SELECT * FROM tbl_giohang,tbl_giohang_chitiet,tbl_dangky 
    WHERE tbl_giohang.id_giohang=$id
    AND   tbl_giohang.id_khachhang=tbl_dangky.id_dangky
    AND   tbl_giohang.ma_giohang=tbl_giohang_chitiet.ma_giohang
    LIMIT 1";

    $query_sql = mysqli_query($mysqli, $sql);

    $sql_list_sp="SELECT tbl_sanpham.*,tbl_giohang_chitiet.soluong FROM tbl_sanpham,tbl_giohang,tbl_giohang_chitiet
    WHERE tbl_giohang.id_giohang=$id
    AND   tbl_giohang.ma_giohang=tbl_giohang_chitiet.ma_giohang
    AND   tbl_giohang_chitiet.id_sanpham=tbl_sanpham.id_sanpham";
    
    $query_list_sp = mysqli_query($mysqli, $sql_list_sp);
    if (!$query_list_sp) {
        die("Lỗi truy vấn sản phẩm: " . mysqli_error($mysqli));
    }

    $sql_status="UPDATE tbl_giohang SET trangthai_giohang=0 WHERE id_giohang=$id";
    mysqli_query($mysqli, $sql_status);
}



?>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 20px;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        .info {
            margin-bottom: 15px;
        }
        .info strong {
            display: inline-block;
            width: 150px;
        }
        .product {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }
        .product img {
            width: 80px;
            height: 80px;
            margin-right: 10px;
            border-radius: 5px;
        }
        .product .details {
            flex: 1;
        }
        .back-button {
            display: block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }
    </style>

    <div class="container">
        <?php while ($row = mysqli_fetch_assoc($query_sql)) { ?>
            <h2>Chi Tiết Đơn Hàng</h2>
            <div class="info"><strong>Mã Giỏ Hàng:</strong> <?php echo $row['id_giohang']; ?></div>
            <div class="info"><strong>Tên Khách Hàng:</strong> <?php echo $row['tenkhachhang']; ?></div>
            <div class="info"><strong>Email:</strong> <?php echo $row['email']; ?></div>
            <div class="info"><strong>Địa Chỉ:</strong> <?php echo $row['diachi']; ?></div>
            <div class="info"><strong>Số Điện Thoại:</strong> <?php echo $row['dienthoai']; ?></div>
            <?php } ?>
        <h3>Sản Phẩm</h3>
        <?php while ($row = mysqli_fetch_assoc($query_list_sp)) { ?>
            <div class="product">
                <img src="modules/productMNG/image_product/<?php echo $row['hinhanh']; ?>" alt="Sản phẩm">
                <div class="details">
                    <strong><?php echo $row['tensanpham']; ?></strong><br>
                    <span><?php echo $row['giasp']; ?></span><br>
                    <span><?php echo $row['soluong']; ?></span>
                </div>
            </div>
        <?php } ?>
        
        <a href="index.php?action=quanlydonhang&&query=xemdanhsach" class="back-button">Quay lại</a>
    </div>
