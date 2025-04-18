<?php
// Initialize pagination
$begin = isset($_GET['trang']) ? (int)$_GET['trang'] * 16 : 0;
$where_conditions = [];
$params = [];

// Base query
$sql = "SELECT * FROM tbl_sanpham";

// Handle category filter
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($mysqli, $_GET['id']);
    $where_conditions[] = "id_danhmuc = '$id'";
    $params['id'] = $id;
}

// Handle price filter
if (isset($_GET['price']) && !empty($_GET['price'])) {
    $price = $_GET['price'];
    if ($price == '0-5000000') {
        $where_conditions[] = "giasp <= 5000000";
    } elseif ($price == '5000000-10000000') {
        $where_conditions[] = "giasp BETWEEN 5000000 AND 10000000";
    } elseif ($price == '10000000-20000000') {
        $where_conditions[] = "giasp BETWEEN 10000000 AND 20000000";
    } elseif ($price == '20000000') {
        $where_conditions[] = "giasp >= 20000000";
    }
    $params['price'] = $price;
}

// Handle sort
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'newest';
$order_by = "ORDER BY id_sanpham DESC";
switch ($sort) {
    case 'price_asc':
        $order_by = "ORDER BY giasp ASC";
        break;
    case 'price_desc':
        $order_by = "ORDER BY giasp DESC";
        break;
    case 'name_asc':
        $order_by = "ORDER BY tensanpham ASC";
        break;
    case 'name_desc':
        $order_by = "ORDER BY tensanpham DESC";
        break;
}
$params['sort'] = $sort;

// Build final query
if (!empty($where_conditions)) {
    $sql .= " WHERE " . implode(" AND ", $where_conditions);
}
$sql .= " $order_by LIMIT $begin,16";
$query_lietke_sp = mysqli_query($mysqli, $sql);

// Count total products for pagination
$count_sql = "SELECT COUNT(*) as total FROM tbl_sanpham";
if (!empty($where_conditions)) {
    $count_sql .= " WHERE " . implode(" AND ", $where_conditions);
}
$count_query = mysqli_query($mysqli, $count_sql);
$total_products = mysqli_fetch_assoc($count_query)['total'];
$pages = ceil($total_products / 16);
?>

<div class="container_page_product">
    <div class="filter">
        <div class="filter-container">
            <div class="title">giá sản phẩm:</div>
            <div>
                <select id="price" onchange="applyFilters()">
                    <option value="">Giá</option>
                    <option value="0-5000000" <?php echo isset($params['price']) && $params['price'] == '0-5000000' ? 'selected' : ''; ?>>Dưới 5 triệu</option>
                    <option value="5000000-10000000" <?php echo isset($params['price']) && $params['price'] == '5000000-10000000' ? 'selected' : ''; ?>>5-10 triệu</option>
                    <option value="10000000-20000000" <?php echo isset($params['price']) && $params['price'] == '10000000-20000000' ? 'selected' : ''; ?>>10-20 triệu</option>
                    <option value="20000000" <?php echo isset($params['price']) && $params['price'] == '20000000' ? 'selected' : ''; ?>>Trên 20 triệu</option>
                </select>
            </div>
        </div>
        
        <div class="sort-container">
            <label for="sort">sắp xếp:</label>
            <select id="sort" onchange="applyFilters()">
                <option value="newest" <?php echo $sort == 'newest' ? 'selected' : ''; ?>>Sản phẩm mới nhất</option>
                <option value="price_asc" <?php echo $sort == 'price_asc' ? 'selected' : ''; ?>>Giá: Thấp đến cao</option>
                <option value="price_desc" <?php echo $sort == 'price_desc' ? 'selected' : ''; ?>>Giá: Cao đến thấp</option>
                <option value="name_asc" <?php echo $sort == 'name_asc' ? 'selected' : ''; ?>>Tên: A-Z</option>
                <option value="name_desc" <?php echo $sort == 'name_desc' ? 'selected' : ''; ?>>Tên: Z-A</option>
            </select>
        </div>
    </div>
    
    <div class="content-1">
        <div class="container collection">
            <?php while ($row = mysqli_fetch_array($query_lietke_sp)) { ?>
                <a href="index.php?quanly=chitietsanpham&id=<?php echo $row['id_sanpham']; ?>">
                    <div class="product">
                        <img src="admincp/modules/productMNG/image_product/<?php echo $row['hinhanh'] ?>" alt="ảnh sản phẩm">
                        <h3><?php echo $row['tensanpham'] ?></h3>
                        <p class="price"><?php echo number_format($row['giasp'], 0, ',', '.') ?> đ</p>
                        <p class="promo">Tặng trang sức đến 2 triệu</p>
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>
    
    <ul class="pagination">
        <?php
        $base_url = "index.php?quanly=sanpham";
        foreach ($params as $key => $value) {
            $base_url .= "&$key=" . urlencode($value);
        }
        
        for ($i = 0; $i < $pages; $i++) {
            $active = (isset($_GET['trang']) && (int)$_GET['trang'] == $i) || (!isset($_GET['trang']) && $i == 0) ? 'active' : '';
            ?>
            <li><a class="index_page <?php echo $active ?>" href="<?php echo $base_url . '&trang=' . $i; ?>"><?php echo $i + 1 ?></a></li>
            <?php
        }
        ?>
    </ul>
</div>

<script>
function applyFilters() {
    const filters = {
        price: document.getElementById('price').value,
        sort: document.getElementById('sort').value
    };
    
    let url = 'index.php?quanly=sanpham';
    <?php if (isset($_GET['id'])) { ?>
        url += '&id=<?php echo $_GET['id']; ?>';
    <?php } ?>
    
    for (const [key, value] of Object.entries(filters)) {
        if (value) {
            url += `&${key}=${encodeURIComponent(value)}`;
        }
    }
    
    window.location.href = url;
}
</script>

