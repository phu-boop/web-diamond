<?php
    $sql_lietke_danhmucsp = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
    $query_lietke_danhmucsp = mysqli_query($mysqli, $sql_lietke_danhmucsp);
?>
<header class="header">
            <div class="logo">
                <div class="logo-1">
                    <i class="fa-solid fa-store"></i>
                    <div class="search-container">
                        <i id="search-icon" class="fa-solid fa-search"></i>
                    </div>

                </div>
                <a href="index.php" class="logo-2">
                    <div class="title-logo">Luxury</div>
                    <svg
                        width="60" height="60"
                        viewBox="0 0 100 100"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="#ffffff"
                        stroke="#ed8383" stroke-width="2"
                    >
                        <polygon points="10,40 30,10 50,10 70,10 90,40" />
                        <polygon points="30,10 50,40 70,10" />
                        <polygon points="10,40 50,90 30,40" />
                        <polygon points="30,40 50,90 50,40" />
                        <polygon points="50,40 50,90 70,40" />
                        <polygon points="70,40 50,90 90,40" />
                    </svg>
                </a>
                <div class="logo-3">
                    <i class="fa-solid fa-heart"></i>
                    <a href="index.php?quanly=giohang">
                        <i class="fa-solid fa-lock "></i>
                    </a>
                </div>
            </div>
            <nav class="nav" id="navbar" >
                <ul class="nav__list">
                    <li><a href="index.php">Trang chủ</a></li>
                    <li class="has-dropdown">
                        <a href="index.php?quanly=sanpham">Sản Phẩm</a>
                        <div class="dropdown" >
                            <?php while ($row = mysqli_fetch_array($query_lietke_danhmucsp)) { ?>
                                <a href="index.php?quanly=sanpham&id=<?php echo $row['id_danhmuc'] ?>">
                                    <?php echo $row['tendanhmuc'] ?>
                                </a>
                            <?php } ?>
                        </div>
                    </li>
                    <li><a href="index.php?quanly=tintuc">Tin tức</a></li>
                    <li><a href="index.php?quanly=lienhe">Liên hệ</a></li>
                    <li><a href="index.php?quanly=Dangky">Đăng Ký</a></li>
                </ul>
            </nav>
</header>