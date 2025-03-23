<div class="create_container">
    <div class="top">
        <div>
            <p><h2>Danh sách danh mục</h2></p>
        </div>
        <div class="search">
            <button class="btn add_category">
                <i class="fa-solid fa-plus"></i>
                Thêm Danh Mục
            </button>
            <form method="GET" action="index.php">
                <input type="hidden" name="action" value="quanlydanhmucsanpham">
                <input type="hidden" name="query" value="them">
                <input type="hidden" name="trang" value="0">
                
                <div class="search-bar">
                    <input type="text" name="search" placeholder="Search here" 
                        value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                </div>
            </form>
        </div>
    </div>
    <div class="form_container">
        <div class="form_add_category">
            <div class="top">
                <h2>Thêm danh mục</h2>
                <i class="fa-solid fa-xmark remove_create"></i>
            </div>
            <form class="" method="POST" action="modules/category_productMNG/handle.php" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td><label for="namecategory">Tên danh mục</label></td>
                        <td><input type="text"  name="namecategory" required></td>
                    </tr>
                    <tr>
                        <td><label for="order">Thứ tự</label></td>
                        <td><input type="text"  name="order" required></td>
                    </tr>
                    <tr>
                        <td><label for="hinhanh">Hình ảnh</label></td>
                        <td><input type="file" id="hinhanh" name="image"></td>
                    </tr>
                </table>
                
                <input type="submit" name="addcategory" value="Add">
                <button class="btn remove_create">Discard</button>
            </form>
        </div>
    </div>
</div>
