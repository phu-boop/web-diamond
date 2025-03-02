<?php

$sql_lietke_danhmucsp = "SELECT * FROM tbl_danhmuc WHERE id_danhmuc='$_GET[id_danhmuc]' LIMIT 1";
$query_lietke_danhmucsp = mysqli_query($mysqli, $sql_lietke_danhmucsp);

?>
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


    <h2>Sửa Danh Mục Sản Phẩm</h2>
    <?php
    while ($row = mysqli_fetch_array($query_lietke_danhmucsp)) {
        ?>
        <form method="POST" action="modules/productMNG/handle.php?id_danhmuc=<?php echo $row['id_danhmuc']; ?>">
            <table>
                <tr>
                    <td><label for="namecategory">Tên danh mục</label></td>
                    <td><input type="text"  name="namecategory" value="<?php echo $row['tendanhmuc']; ?>" required></td>
                </tr>
                <tr>
                    <td><label for="order">Thứ tự</label></td>
                    <td><input type="text"  name="order" value="<?php echo $row['thutu']; ?>" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="editcategory" value="ok">
                    </td>
                </tr>
            </table>
        </form>
        <?php
    }
