<?php
$begin = isset($_GET['trang']) ? (int)$_GET['trang'] * 20 : 0;

// Lấy giá trị tìm kiếm từ tham số GET 'search' (nếu có), mặc định là chuỗi rỗng
$search = isset($_GET['search']) ? trim($_GET['search']) : "";

// Cấu trúc câu lệnh SQL cơ bản
$sql = "SELECT * FROM tbl_giohang ";

// Thêm điều kiện tìm kiếm nếu có từ khóa tìm kiếm
if (!empty($search)) {
    $search = mysqli_real_escape_string($mysqli, $search);
    $sql .= " WHERE tbl_giohang.ma_giohang LIKE '%$search%'";
}

// Thêm phần sắp xếp và giới hạn kết quả
$sql .= " ORDER BY id_giohang DESC LIMIT $begin, 20";

// Thực thi câu lệnh SQL
$lietke_donhang = mysqli_query($mysqli, $sql);

// Kiểm tra lỗi nếu có
if (!$lietke_donhang) {
    die("Lỗi truy vấn: " . mysqli_error($mysqli));
}
?>
<div class="page_invoice_list">
    <div class="container">
        <div class="create_container">
            <div class="top">
                <div>
                    <p><h2>Danh Sách Đơn hàng</h2></p>
                </div>
                <div class="search">
                    <button class="btn add_category">
                        <i class="fa-solid fa-plus"></i>
                        tùy
                    </button>
                    <form method="GET" action="index.php">
                        <input type="hidden" name="action" value="quanlydonhang">
                        <input type="hidden" name="query" value="xemdanhsach">
                        <input type="hidden" name="trang" value="0">
                        
                        <div class="search-bar">
                            <input type="text" name="search" placeholder="Nhập mã giỏ hàng" 
                                value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <table class="order-table">
                <tr>
                    <th>ID Giỏ hàng</th>
                    <th>Ngày mua</th>
                    <th>ID Khách hàng</th>
                    <th>Mã Giỏ hàng</th>
                    <th>Thanh toán</th>
                    <th>Trạng thái</th>
                    <th>Quản lý</th>
                </tr>
                <?php while($row = mysqli_fetch_array($lietke_donhang)) { ?>
                <tr>
                    <td><?php echo $row['id_giohang']; ?></td>
                    <td><?php echo $row['ngay_mua']; ?></td>
                    <td><?php echo $row['id_khachhang']; ?></td>
                    <td>#<?php echo $row['ma_giohang'];?></td>
                    <td><?php echo $row['pt_thanhtoan']; ?></td>
                    <?php if($row['trangthai_giohang']==1) { ?>
                    <td class="status-pending"><a href="index.php?action=quanlydonhang&&query=xemchitiet&id=<?php echo $row['id_giohang'] ?>" class="btn new_invoice">Đơn Mới</a></td>
                    <?php } else { ?>
                    <td class="status-viewed">..Đã xem</td>
                    <?php } ?>
                    <td><a href="index.php?action=quanlydonhang&&query=xemchitiet&id=<?php echo $row['id_giohang'] ?>" class="btn check_invoice">Xem chi tiết</a></td>
                </tr>
                <?php } ?>
        </table>
        <div class="list_container">
            <div class="pagination">
                    <button class="page-item disabled">❮</button>
                    <?php
                    $i = 0;
                    $sql_gh = "SELECT * FROM tbl_giohang ORDER BY id_giohang DESC";
                    $query_gh = mysqli_query($mysqli, $sql_gh);
                    $pages = ceil(mysqli_num_rows($query_gh)/20); 
                    while($i < $pages){
                    ?>  
                    <a href="index.php?action=quanlydonhang&query=xemdanhsach&trang=<?php echo $i++; ?>" class="page-item <?php echo ($_GET['trang'] == $i-1) ? 'active' : ''; ?>"><?php echo $i;?></a>
                    <?php
                    }
                    ?>
                    <button class="page-item disabled">❯</button>
            </div>
        </div>
    </div>
</div>
