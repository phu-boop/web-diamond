<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách bài viết</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 10px;
        }

        .post {
            display: flex;
            background: white;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            overflow: hidden;
            transition: transform 0.2s ease-in-out;
        }

        .post:hover {
            transform: scale(1.02);
        }

        .post img {
            width: 250px;
            height: 170px;
            object-fit: cover;
            border-right: 5px solid #f8f8f8;
        }

        .post-content {
            padding: 15px;
            flex-grow: 1;
        }

        .post h2 {
            margin-bottom: 5px;
            font-size: 18px;
            color: #222;
        }

        .date {
            color: #ff6600;
            font-size: 14px;
            margin: 5px 0;
            display: flex;
            align-items: center;
        }

        .date::before {
            content: "📅";
            margin-right: 5px;
        }

        .post p {
            font-size: 14px;
            color: #555;
            margin-top: 5px;
            line-height: 1.5;
        }

    </style>
</head>
<body>

<div class="container">
    <?php
    $sql="SELECT * FROM tbl_baiviet ORDER BY id_baiviet DESC";
    $query_sql=mysqli_query($mysqli,$sql);
    while($row=mysqli_fetch_array($query_sql)){
    ?>
    <div class="post">
        <img src="/admincp/modules/blog/image_blog/<?php echo $row['hinhanh'] ?>;" alt="MUA VÀNG RƯỚC VÍA">
        <div class="post-content">
            <h2><?php echo $row['tieude'];?></h2>
            <p class="date"><?php echo $row['ngaydang'];?></p>
            <p><?php echo $row['noidung'];?></p>
        </div>
    </div>
    <?php
    }
    ?>
</div>

</body>
</html>
