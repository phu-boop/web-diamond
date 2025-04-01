<?php
$begin = isset($_GET['trang']) ? (int)$_GET['trang'] * 20 : 0;

// Lấy giá trị tìm kiếm từ tham số GET 'search' (nếu có), mặc định là chuỗi rỗng
$search = isset($_GET['search']) ? trim($_GET['search']) : "";

// Cấu trúc câu lệnh SQL cơ bản
$sql = "
    SELECT * FROM tbl_baiviet  
";

// Thêm điều kiện tìm kiếm nếu có từ khóa tìm kiếm
if (!empty($search)) {
    $search = mysqli_real_escape_string($mysqli, $search);
    $sql .= " WHERE tbl_baiviet.tieude LIKE '%$search%'";
}

// Thêm phần sắp xếp và giới hạn kết quả
$sql .= " ORDER BY id_baiviet DESC LIMIT $begin,10";

// Thực thi câu lệnh SQL
$query_blog = mysqli_query($mysqli, $sql);

// Kiểm tra lỗi nếu có
if (!$query_blog) {
    die("Lỗi truy vấn: " . mysqli_error($mysqli));
}
?>
<div class="page_list_blog">
    <div class="container">
            <div class="top">
                <a href="index.php?action=quanlybaiviet&query=them" class="btn add_blog">
                    <i class="fa-solid fa-plus"></i> Thêm Bài Viết
                </a>
                <form method="GET" action="index.php">
                    <input type="hidden" name="action" value="quanlybaiviet">
                    <input type="hidden" name="query" value="xem">
                    <input type="hidden" name="trang" value="0">
                    <input type="text" name="search" placeholder="Search here" 
                        value="<?php echo htmlspecialchars($search); ?>">
                </form>
            </div>
        <table class="blog-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>hinh anh</th>
                    <th>Tiêu Đề</th>
                    <th>Ngày đăng</th>
                    <th>Quản lý</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($row=mysqli_fetch_array($query_blog)){
                ?>
                <tr>
                    <td><?php echo $row['id_baiviet']; ?></td>
                    <td><img src="modules/blog/image_blog/<?php echo $row['hinhanh']; ?>" alt="Blog Image" width="100"></td>
                    <td><?php echo $row['tieude']; ?></td>
                    <td><?php echo $row['ngaydang']; ?></td>
                    <td>
                        <a href="?action=quanlybaiviet&&query=sua&id=<?php echo $row['id_baiviet']; ?>"><i class="fa-regular fa-pen-to-square"></i></a>
                        <a name="edit" href="modules/blog/handle.php?id=<?php echo $row['id_baiviet']; ?>"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
            <div class="list_container">
                <div class="pagination">
                    <button class="page-item disabled">❮</button>
                    <?php
                    $i = 0;
                    $sql_count_blog = "SELECT * FROM tbl_baiviet ORDER BY id_baiviet DESC";
                    $query_count_blog = mysqli_query($mysqli, $sql_count_blog);
                    $pages = ceil(mysqli_num_rows($query_count_blog)/10); 
                    while($i < $pages){
                    ?>  
                    <a href="index.php?action=quanlybaiviet&query=xem&trang=<?php echo $i++; ?>" class="page-item <?php echo ($_GET['trang'] == $i-1) ? 'active' : ''; ?>"><?php echo $i;?></a>
                    <?php
                    }
                    ?>
                    <button class="page-item disabled">❯</button>
                </div>
            </div>
    </div>
</div>

