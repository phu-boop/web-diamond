<div class="page_edit_blog">
    <div class="container">
    <?php
    $id=$_GET['id'];
    $sql="SELECT * FROM tbl_baiviet WHERE id_baiviet=$id LIMIT 1";
    $query_sql=mysqli_query($mysqli,$sql);
    while($row=mysqli_fetch_array($query_sql)){
    ?>
        <h2>Sửa bài viết</h2>
        <form action="modules/blog/handle.php?id=<?php echo $row['id_baiviet'] ;?>" method="POST" enctype="multipart/form-data">
            <label for="title">Tiêu đề</label>
            <input type="text" value="<?php echo $row['tieude']; ?>" id="title" name="title" required>

            <label for="content">Nội dung:</label>
            <textarea id="content"  name="content" required><?php echo $row['noidung']; ?></textarea>

            <label for="hinhanh">Hình ảnh:</label>
            <input type="file" id="hinhanh" name="image">

            <button type="submit" name="edit">Sửa bài</button>
        </form>
    <?php
    }
    ?>
    </div>
</div>

