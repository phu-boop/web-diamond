<header class="header">
    <div class="logo">
        <div class="logo-1">
                <a href="index.php">
                    <i class="fa-solid fa-store"></i>
                </a>
                <form action="" method="GET">
                    <div class="search_container">
                        <input type="hidden" name="quanly" value="timkiem">
                        <button type="button" class="search">
                            <i id="search-icon" class="fa-solid fa-search"></i>
                        </button>
                        <input class="input_search" type="hidden" placeholder="Nhập từ khóa" name="key">
                    </div>
                </form>
        </div>

        <a href="index.php" class="logo-2">
            <svg width="60" height="60" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"
                 fill="#ffffff" stroke="#ed8383" stroke-width="3">
                <polygon points="10,40 30,10 50,10 70,10 90,40"/>
                <polygon points="30,10 50,40 70,10"/>
                <polygon points="10,40 50,90 30,40"/>
                <polygon points="30,40 50,90 50,40"/>
                <polygon points="50,40 50,90 70,40"/>
                <polygon points="70,40 50,90 90,40"/>
            </svg>
            <div class="logo-content">
                <div class="title-logo">LUXURY</div>
                <div class="subtitle-logo">THE ART OF JEWELRY</div>
            </div>
        </a>

        <div class="logo-3">
            <i class="fa-solid fa-user"></i>
            <a href="index.php?quanly=giohang">
                <i class="fa-solid fa-lock"></i>
            </a>
        </div>
    </div>

    <nav class="nav" id="navbar">
        <ul class="nav__list">
            <li><a href="index.php">Trang chủ</a></li>
            <li class="has-dropdown">
                <a href="index.php?quanly=sanpham">Sản Phẩm</a>
                <div class="dropdown">
                    <?php
                    $sql_lietke_danhmucsp = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
                    $query_lietke_danhmucsp = mysqli_query($mysqli, $sql_lietke_danhmucsp);
                    while ($row = mysqli_fetch_array($query_lietke_danhmucsp)) : ?>
                        <a href="index.php?quanly=sanpham&id=<?= $row['id_danhmuc'] ?>">
                            <?= htmlspecialchars($row['tendanhmuc']) ?>
                        </a>
                    <?php endwhile; ?>
                </div>
            </li>
            <li><a href="index.php?quanly=xemgiavang">Giá vàng</a></li>
            <li><a href="index.php?quanly=tintuc">Tin tức</a></li>
            <li><a href="index.php?quanly=lienhe">Liên hệ</a></li>

            <?php if(isset($_SESSION['dangky'])): ?>
                <li><a href="index.php?dangxuat=1">Đăng xuất</a></li>
                <li><a href="index.php?quanly=doimatkhau">Đổi mật khẩu</a></li>
            <?php else: ?>
                <li><a href="index.php?quanly=dangnhap">Đăng nhập</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
