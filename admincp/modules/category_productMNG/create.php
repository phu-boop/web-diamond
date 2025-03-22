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
            <div class="search-bar">
                <input type="text" placeholder="Search here">
            </div>
        </div>
    </div>
    <form class="form_add_category" method="POST" action="modules/category_productMNG/handle.php" enctype="multipart/form-data">
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
            <tr>
                <td colspan="2">
                    <input type="submit" name="addcategory" value="Thêm danh mục sản phẩm">
                </td>
            </tr>
        </table>
    </form>
</div>
