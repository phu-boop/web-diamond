<div class="create_container">
    <h2>Thêm Danh Mục Sản Phẩm</h2>
    <form method="POST" action="modules/category_productMNG/handle.php" enctype="multipart/form-data">
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
