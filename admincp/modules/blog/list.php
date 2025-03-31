<div class="page_list_blog">
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
</div>

