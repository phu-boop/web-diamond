<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            background: white;
            padding: 20px;
            margin: 0 auto;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        textarea {
            height: 100px;
        }

        button {
            display: block;
            width: 100%;
            background-color: #ff6600;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 15px;
        }

        button:hover {
            background-color: #e65c00;
        }
    </style>


<div class="container">
    <h2>Tạo bài viết mới</h2>
    <form action="modules/blog/handle.php" method="POST" enctype="multipart/form-data">
        <label for="title">Tiêu đề bài viết:</label>
        <input type="text" id="title" name="title" required>

        <label for="content">Nội dung:</label>
        <textarea id="content" name="content" required></textarea>

        <label for="hinhanh">Hình ảnh:</label>
        <input type="file" id="hinhanh" name="image">

        <button type="submit" name="submit">Đăng bài</button>
    </form>
</div>

