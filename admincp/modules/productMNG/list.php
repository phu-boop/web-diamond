<?php
$begin = isset($_GET['trang']) ? (int)$_GET['trang'] * 20 : 0;

// Lấy giá trị tìm kiếm từ tham số GET 'search' (nếu có), mặc định là chuỗi rỗng
$search = isset($_GET['search']) ? trim($_GET['search']) : "";

// Cấu trúc câu lệnh SQL cơ bản
$sql = "
    SELECT tbl_sanpham.*, tbl_danhmuc.tendanhmuc
    FROM tbl_sanpham,tbl_danhmuc 
    WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc 
";

// Thêm điều kiện tìm kiếm nếu có từ khóa tìm kiếm
if (!empty($search)) {
    $search = mysqli_real_escape_string($mysqli, $search);
    $sql .= " WHERE tbl_sanpham.tensanpham LIKE '%$search%'";
}

// Thêm phần sắp xếp và giới hạn kết quả
$sql .= " ORDER BY id_sanpham DESC LIMIT $begin, 20";

// Thực thi câu lệnh SQL
$query = mysqli_query($mysqli, $sql);

// Kiểm tra lỗi nếu có
if (!$query) {
    die("Lỗi truy vấn: " . mysqli_error($mysqli));
}
?>


<div class="page_sanpham">
    <div class="create_container">
        <div class="top">
            <h2>Danh sách Sản phẩm</h2>
            <div class="search">
                <a href="index.php?action=quanlysanpham&query=them" class="btn add_category">
                    <i class="fa-solid fa-plus"></i> Thêm Sản phẩm
                </a>
                <form method="GET" action="index.php">
                    <input type="hidden" name="action" value="quanlysanpham">
                    <input type="hidden" name="query" value="xem">
                    <input type="hidden" name="trang" value="0">
                    <input type="text" name="search" placeholder="Search here" 
                        value="<?php echo htmlspecialchars($search); ?>">
                </form>
            </div>
        </div>
        <div class="list_container">
            <table>
                <thead>
                    <tr>
                        <th>mã sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Danh mục</th>
                        <th>Trạng thái</th>
                        <th>Tóm tắt</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    while ($row = mysqli_fetch_assoc($query)) {
                        $i++;
                    ?>
                    <tr>
                        <td><?php echo $row['id_sanpham']; ?></td>
                        <td><img src="modules/productMNG/image_product/<?php echo $row['hinhanh']; ?>" alt="Hình ảnh sản phẩm"></td>
                        <td><?php echo $row['tensanpham']; ?></td>  
                        <td><?php echo number_format($row['giasp'], 0, ',', '.'); ?> VND</td>
                        <td><?php echo $row['soluong']; ?></td>
                        <td><?php echo $row['tendanhmuc']; ?></td>
                        <td>
                            <?php echo ($row['trangthai'] == 1) ? 
                                '<div id="toggle" class="button_product active">
                                    <div class="toggle-circle"></div>
                                </div>' : 
                                '<div id="toggle" class="button_product">
                                    <div class="toggle-circle active"></div>
                                </div>'; 
                            ?>
                        </td>
                        <td><?php echo ((!empty($row['tomtat'])) ? $row['tomtat'] : 'chưa thêm'); ?> </td>
                        <td class="actions">
                            <a href="index.php?action=quanlysanpham&query=sua&id_sanpham=<?php echo $row['id_sanpham']; ?>" class="edit"><i class="fa-regular fa-pen-to-square"></i></a>
                            <a href="modules/productMNG/handle.php?id_sanpham=<?php echo $row['id_sanpham']; ?>" class="delete"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

            <?php if (mysqli_num_rows($query) == 0) { ?>
                <p>Không có sản phẩm nào!</p>
            <?php } ?>
            <div class="pagination">
                <button class="page-item disabled">❮</button>
                <?php
                $i = 0;
                $sql_sp = "SELECT * FROM tbl_sanpham ORDER BY id_sanpham DESC";
                $query_sp = mysqli_query($mysqli, $sql_sp);
                $pages = ceil(mysqli_num_rows($query_sp)/20); 
                while($i < $pages){
                ?>  
                <a href="index.php?action=quanlysanpham&query=xem&trang=<?php echo $i++; ?>" class="page-item <?php echo ($_GET['trang'] == $i-1) ? 'active' : ''; ?>"><?php echo $i;?></a>
                <?php
                }
                ?>
                <button class="page-item disabled">❯</button>
            </div>
        </div>
    </div>
</div>
