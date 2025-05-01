<div class="page_new">
    <div class="news-page">
        <!-- Header Section -->
        <div class="news-header">
            <h1>Khẳng định phong cách phái mạnh với 6 thiết kế nhẫn đình đám ECZ từ MANCODE by PNJ</h1>
            <div class="news-meta">
                <span class="category">Blog > Mix & Match</span>
                <span class="date">21/03/2025</span>
                <span class="read-time">Thời gian đọc: 7 Phút</span>
            </div>
            <div class="news-share">
                <span>Chia sẻ:</span>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-pinterest"></i></a>
                <a href="#"><i class="fab fa-telegram"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fas fa-plus"></i></a>
            </div>
        </div>

        <!-- Banner Image -->
        <div class="news-banner">
            <img src="https://www.pnj.com.vn/blog/wp-content/uploads/2020/09/1200x450-1.jpg" alt="Banner Image">
        </div>

        <!-- Intro Text -->
        <div class="news-intro">
            <p>Nhẫn nam, món phụ kiện tưởng chừng đơn giản, lại là điểm nhấn tinh tế giúp phái mạnh khẳng định phong cách riêng. MANCODE by PNJ giới thiệu 6 mẫu nhẫn độc đáo, lấy cảm hứng từ linh vật rắn năm Ất Tỵ để quyến rũ, những viên đá quý vững chãi tượng trưng cho niềm tin, sự chân thành và nguồn lực đam mê bất diệt.</p>
            <p>Phái mạnh có thể cân nhắc lựa chọn cho mình mẫu nhẫn ứng ý nhất, để mỗi khoảnh khắc đều là sự tỏa sáng của bản lĩnh và cá tính riêng biệt. Hoặc phái đẹp nếu đang có ý định tặng trang sức cho nam giới thì cũng có thể tham khảo nhé!</p>
        </div>

        <!-- News List -->
         <div class="container_new_list">
            <div class="jewelry-news">
                <?php
                $sql = "SELECT * FROM tbl_baiviet ORDER BY id_baiviet DESC LIMIT 0,3";
                $query_sql = mysqli_query($mysqli, $sql);
                while ($row = mysqli_fetch_array($query_sql)) {
                ?>
                        <div class="news-item">
                            <div class="news-image">
                                <img src="admincp/modules/blog/image_blog/<?php echo $row['hinhanh']; ?>">
                            </div>
                            <div class="news-content">
                                <h3><?php echo strip_tags($row['tieude'],); ?></h3>
                                <p class="date"><?php echo $row['ngaydang']; ?></p>
                                <p><?php echo strip_tags($row['noidung'], '<strong><em>'); ?></p>
                                <a href="?quanly=tintuc&id=<?php echo $row['id_baiviet']; ?>" class="read-more">xem ngay</a>
                            </div>
                        </div>
                <?php
                }
                ?>
            </div>
            <div class="img">
                <img src="assets/images/phong-thuy-april-368x500-1.jpg" alt="">
            </div>
        </div>
    </div>
</div>