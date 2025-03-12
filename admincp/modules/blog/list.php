<style>
.container {
    max-width: 900px;
    margin: 20px auto;
    padding: 10px;
}

.post {
    display: flex;
    align-items: center;
    background: white;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    overflow: hidden;
    padding: 15px;
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.post:hover {
    transform: scale(1.02);
    box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.2);
}

.post img {
    width: 180px;
    height: 120px;
    object-fit: cover;
    border-radius: 8px;
    margin-right: 15px;
}

.post-content {
    flex-grow: 1;
}

h2 {
    margin: 0;
    font-size: 22px;
    color: #333;
}

h4 {
    margin: 0;
    font-size: 18px;
    color: #666;
}

.date {
    color: #ff6600;
    font-size: 14px;
    font-weight: bold;
    margin: 8px 0;
    display: flex;
    align-items: center;
}

.date::before {
    content: "📅";
    margin-right: 5px;
}

p {
    margin: 5px 0 0;
    font-size: 16px;
    color: #555;
    line-height: 1.5;
}

a {
    display: inline-block;
    margin-right: 10px;
    padding: 5px 12px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 14px;
    font-weight: bold;
    transition: background 0.3s, color 0.3s;
}

a[href*="sua"] {
    background: #007bff;
    color: white;
}

a[href*="xoa"] {
    background: #dc3545;
    color: white;
}

a:hover {
    opacity: 0.8;
}

@media (max-width: 768px) {
    .post {
        flex-direction: column;
        text-align: center;
    }

    .post img {
        width: 100%;
        height: auto;
        margin-bottom: 10px;
    }

    .post-content {
        padding: 10px;
    }
}
</style>



<?php
$sql_list_blog="SELECT * FROM tbl_baiviet ORDER BY id_baiviet DESC";
$query_blog=mysqli_query($mysqli,$sql_list_blog);
?>
<div class="container">
    <?php
    while($row=mysqli_fetch_array($query_blog)){
    ?>
    <div class="post">
        <h4><?php echo $row['id_baiviet']; ?></h4>
        <img src="modules/blog/image_blog/<?php echo $row['hinhanh']; ?>" alt="MUA VÀNG RƯỚC VÍA">
        <div class="post-content">
            <h2><?php echo $row['tieude']; ?></h2>
            <p class="date">📅 <?php echo $row['ngaydang']; ?></p>
            <p><?php echo $row['noidung']; ?></p>
            <a href="?action=quanlybaiviet&&query=sua&id=<?php echo $row['id_baiviet']; ?>">sửa</a>
            <a name="edit" href="modules/blog/handle.php?id=<?php echo $row['id_baiviet']; ?>">xóa</a>
        </div>
    </div>
    <?php
    }
    ?>
</div>

