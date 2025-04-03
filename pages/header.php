<header class="header">
    <div class="logo">
        <div class="logo-1">
                <a href="index.php">
                    <button class="menu-toggle">&#9776;</button>
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
            <i class="fa-solid fa-user">
                <div class="account_menu">
                    <ul>
                        <li><a href="#"><i class="fa-solid fa-user"></i>Đăng nhập</a></li>
                        <li><a href="index.php?quanly=dangxuat&&dangxuat=1"><i class="fa-solid fa-power-off"></i>Log Out</a></li>
                        <li><a href="index.php?quanly=doimatkhau"><i class="fa-solid fa-rotate"></i>Đổi mật khẩu</a></li>
                        <li><a href="#"><i class="fa-solid fa-gear"></i>Settings</a></li>
                        <li><a href="#"><i class="fa-solid fa-credit-card"></i>Billing Plan <span class="badge">4</span></a></li>
                        <li><a href="#"><i class="fa-solid fa-dollar-sign"></i>Pricing</a></li>
                        <li><a href="#"><i class="fa-solid fa-circle-question"></i>FAQ</a></li>
                    </ul>
                </div>
            </i>
            <a href="index.php?quanly=giohang">
                <i class="fa-solid fa-lock"></i>
            </a>
        </div>
    </div>
    <div class="screen">
        <nav class="nav" id="navbar">
            <ul class="nav__list">
                <li><a href="index.php">Trang chủ</a></li>
                <li class="has-dropdown">
                    <a href="index.php?quanly=sanpham">Sản Phẩm</a>
                        <div class="dropdown">
                            <div class="dropdown-column">
                                <h4>Danh Mục</h4>
                                <ul>
                                    <?php
                                    $sql_lietke_danhmucsp = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC LIMIT 8";
                                    $query_lietke_danhmucsp = mysqli_query($mysqli, $sql_lietke_danhmucsp);
                                    
                                    // Duyệt qua các danh mục và hiển thị
                                    while ($row = mysqli_fetch_array($query_lietke_danhmucsp)) :
                                    ?>
                                        <li>
                                            <a href="index.php?quanly=sanpham&id=<?= $row['id_danhmuc'] ?>">
                                                <?= htmlspecialchars($row['tendanhmuc']) ?>
                                            </a>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            </div>

                            <div class="dropdown-column">
                                <h4>Chủng Loại</h4>
                                <ul>
                                    <li><a href="index.php?quanly=timkiem&key=Nhẫn">Nhẫn</a></li>
                                    <li><a href="index.php?quanly=timkiem&key=Dây Chuyền">Dây Chuyền</a></li>
                                    <li><a href="index.php?quanly=timkiem&key=Mặt Dây Chuyền">Mặt Dây Chuyền</a></li>
                                    <li><a href="index.php?quanly=timkiem&key=Bông Tai">Bông Tai</a></li>
                                    <li><a href="index.php?quanly=timkiem&key=Lắc">Lắc</a></li>
                                    <li><a href="index.php?quanly=timkiem&key=Vòng">Vòng</a></li>
                                    <li><a href="index.php?quanly=timkiem&key=Charm">Charm</a></li>
                                    <li><a href="index.php?quanly=timkiem&key=Dây Cổ">Dây Cổ</a></li>
                                    <li><a href="index.php?quanly=timkiem&key=Kiềng">Kiềng</a></li>
                                    <li><a href="index.php?quanly=timkiem&key=Vàng Tài Lộc">Vàng Tài Lộc</a></li>
                                </ul>
                            </div>

                            <div class="dropdown-column">
                                <h4>Chất Liệu</h4>
                                <ul>
                                    <li><a href="index.php?quanly=timkiem&key=Vàng">Vàng</a></li>
                                    <li><a href="index.php?quanly=timkiem&key=Bạc">Bạc</a></li>
                                    <li><a href="index.php?quanly=timkiem&key=Platinum">Platinum</a></li>
                                </ul>
                            </div>
                            <div class="dropdown-column">
                                <h4>Loại Vàng</h4>
                                <ul>
                                    <li><a href="index.php?quanly=timkiem&key=Vàng 24k">Vàng 24k</a></li>
                                    <li><a href="index.php?quanly=timkiem&key=Vàng 18k">Vàng 18k</a></li>
                                    <li><a href="index.php?quanly=timkiem&key=Vàng 14k">Vàng 14k</a></li>
                                    <li><a href="index.php?quanly=timkiem&key=Vàng 10k">Vàng 10k</a></li>
                                </ul>
                            </div>
                            <div class="dropdown-column img">
                                <img src="assets/images/dropdown.webp" alt="">
                            </div>
                        </div>

                </li>

                <li><a href="index.php?quanly=xemgiavang">Giá vàng</a></li>
                <li><a href="index.php?quanly=tintuc">Tin tức</a></li>
                <li><a href="#footer">Liên hệ</a></li>

                <?php if(isset($_SESSION['dangky'])): ?>
                    <li><a href="index.php?dangxuat=1">Đăng xuất</a></li>
                    <li><a href="index.php?quanly=doimatkhau">Đổi mật khẩu</a></li>
                <?php else: ?>
                    <li><a href="index.php?quanly=dangnhap">Đăng nhập</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
