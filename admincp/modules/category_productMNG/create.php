
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
            text-align: left;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>


    <h2>Thêm Danh Mục Sản Phẩm</h2>
    <form method="POST" action="modules/category_productMNG/handle.php" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label for="namecategory">Tên danh mục</label></td>
                <td><input type="text"  name="namecategory" required></td>
            </tr>
            <tr>
                <td><label for="hinhanh">Hình ảnh</label></td>
                <td><input type="file" id="hinhanh" name="image"></td>
            </tr>
            <tr>
                <td><label for="order">Thứ tự</label></td>
                <td><input type="text"  name="order" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="addcategory" value="Thêm danh mục sản phẩm">
                </td>
            </tr>
        </table>
    </form>

