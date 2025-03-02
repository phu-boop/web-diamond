<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: auto;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
        }
        input, textarea, select {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Thêm sản phẩm</h2>
        <form method="POST" action="modules/productMNG/handle.php" enctype="multipart/form-data">
            <label for="tensanpham">Tên sản phẩm</label>
            <input type="text" id="tensanpham" name="nameproduct">

            <label for="masp">Mã sản phẩm</label>
            <input type="text" id="masp" name="codeproduct">

            <label for="giasp">Giá sản phẩm</label>
            <input type="text" id="giasp" name="priceproduct">

            <label for="soluong">Số lượng</label>
            <input type="number" id="soluong" name="quantity">

            <label for="hinhanh">Hình ảnh</label>
            <input type="file" id="hinhanh" name="image">

            <label for="tomtat">Tóm tắt</label>
            <textarea id="tomtat" name="summary" rows="3"></textarea>

            <label for="noidung">Nội dung</label>
            <textarea id="noidung" name="content" rows="5"></textarea>

            <label for="tinhtrang">Tình trạng</label>
            <select id="tinhtrang" name="status">
                <option value="1">Kích hoạt</option>
                <option value="0">Ẩn</option>
            </select>

            <button type="submit" name="addproduct">Thêm sản phẩm</button>
        </form>
    </div>
</body>
</html>
