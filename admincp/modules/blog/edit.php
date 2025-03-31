<div class="create_page_blog">
    <div class="container">
    <?php
    $id=$_GET['id'];
    $sql="SELECT * FROM tbl_baiviet WHERE id_baiviet=$id LIMIT 1";
    $query_sql=mysqli_query($mysqli,$sql);
    while($row=mysqli_fetch_array($query_sql)){
    ?>
        <h2>Sửa bài viết</h2>
        <form action="modules/blog/handle.php?id=<?php echo $row['id_baiviet'] ;?>" method="POST" enctype="multipart/form-data">
            <label for="title">Tiêu đề bài viết:</label>
            <textarea id="title" name="title" class="mytextarea" ><?php echo $row['tieude']; ?></textarea>

            <label for="content">Nội dung:</label>
            <textarea id="content" name="content" class="mytextarea" ><?php echo $row['noidung']; ?></textarea>
            <div class="bottom">
                <div>
                    <label for="hinhanh">Hình ảnh:</label>
                    <input type="file" id="hinhanh" name="image">
                </div>
                <div>
                    <button class="btn create_blog" type="submit" name="submit">Sửa bài</button>
                </div>
            </div>
        </form>
    <?php
    }
    ?>
    </div>
</div>

