<div class="create_page_blog">
    <div class="container">
        <h2>Tạo bài viết mới</h2>
        <form action="modules/blog/handle.php" method="POST" enctype="multipart/form-data">
            <label for="title">Tiêu đề bài viết:</label>
            <textarea id="title" name="title" class="mytextarea" ></textarea>

            <label for="content">Nội dung:</label>
            <textarea id="content" name="content" class="mytextarea" ></textarea>
            <div class="bottom">
                <div>
                    <label for="hinhanh">Hình ảnh:</label>
                    <input type="file" id="hinhanh" name="image">
                </div>
                <div>
                    <button class="btn create_blog" type="submit" name="submit">Đăng bài</button>
                </div>
            </div>
        </form>
    </div>
</div>
