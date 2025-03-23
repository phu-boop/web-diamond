<nav class="admin-menu">
    <div class="logo">
        <a href="index.php" class="logo-2">
            <svg width="50" height="50" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"
                 fill="#ffffff" stroke="#696cff" stroke-width="3">
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
    </div>
    <ul>
        <li><a href="#" class="item_menu "><i class="fa-solid fa-house"></i>Dashboard</a></li>
        <li>
            <a href="index.php?action=quanlydanhmucsanpham&query=them&trang=0" 
            class="item_menu <?= (isset($_GET['action']) && $_GET['action'] == 'quanlydanhmucsanpham') ? 'active' : '' ?>">
            <i class="fa-solid fa-table-list"></i>Danh mục
            </a>
        </li>
        <li>
            <a href="index.php?action=quanlysanpham&query=them" 
            class="item_menu <?= (isset($_GET['action']) && $_GET['action'] == 'quanlysanpham') ? 'active' : '' ?>">
                <i class="fa-regular fa-gem"></i>Sản phẩm
            </a>
        </li>
        <li>
            <a href="index.php?action=quanlybaiviet&query=them" 
            class="item_menu <?= (isset($_GET['action']) && $_GET['action'] == 'quanlybaiviet') ? 'active' : '' ?>">
                <i class="fa-solid fa-newspaper"></i>Bài viết
            </a>
        </li>
        <li>
            <a href="index.php?action=quanlydonhang&query=xemdanhsach" 
            class="item_menu <?= (isset($_GET['action']) && $_GET['action'] == 'quanlydonhang') ? 'active' : '' ?>">
                <i class="fa-solid fa-file-invoice-dollar"></i>Đơn hàng
            </a>
        </li>
        <li>
            <a href="index.php?action=quanlykhuyenmai&query=them" 
            class="item_menu <?= (isset($_GET['action']) && $_GET['action'] == 'quanlykhuyenmai') ? 'active' : '' ?>">
                <i class="fa-solid fa-dumpster-fire"></i>Khuyến mãi
            </a>
        </li>
</nav>




