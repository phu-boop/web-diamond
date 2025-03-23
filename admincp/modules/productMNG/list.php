<?php
(isset($_GET['trang'])) ? $begin = $_GET['trang']*20 : $begin = 0;
$search = isset($_GET['search']) ? trim($_GET['search']) : "";
$sql = "SELECT * FROM tbl_sanpham 
        INNER JOIN tbl_danhmuc ON tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc";
if (!empty($search)) {
    $sql .= " WHERE tbl_sanpham.tensanpham LIKE '%" . mysqli_real_escape_string($mysqli, $search) . "%'";
}
$sql .= " ORDER BY id_sanpham DESC LIMIT $begin, 20";

$query = mysqli_query($mysqli, $sql);
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
                        <td><img src="modules/productMNG/image_product/1742025877_sp-gntpxmw000747-nhan-nam-vang-14k-dinh-da-topaz-mancode-by-pnj-1.png" alt="Hình ảnh sản phẩm"></td>
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
                        <td><?php echo $row['tomtat']; ?></td>
                        <td class="actions">
                            <a href="modules/productMNG/edit.php?query=sua&id_sanpham=<?php echo $row['id_sanpham']; ?>" class="edit"><i class="fa-regular fa-pen-to-square"></i></a>
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
                $sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
                $query_danhmucsp = mysqli_query($mysqli, $sql_danhmuc);
                $pages = ceil(mysqli_num_rows($query_danhmucsp)/20); 
                while($i < $pages){
                ?>  
                <a href="index.php?action=quanlysanpham&query=them&trang=<?php echo $i++; ?>" class="page-item <?php echo ($_GET['trang'] == $i-1) ? 'active' : ''; ?>"><?php echo $i;?></a>
                <?php
                }
                ?>
                <button class="page-item disabled">❯</button>
            </div>
        </div>
    </div>
</div>
