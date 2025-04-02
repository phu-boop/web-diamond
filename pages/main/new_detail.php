<div class="new_detail">
  <div class="page_new">
        <div class="news-page">

            <!-- Banner Image -->
            <div class="news-banner">
                <img src="https://www.pnj.com.vn/blog/wp-content/uploads/2020/09/1200x450-1.jpg" alt="Banner Image">
            </div>
            <!-- Header Section -->
            <div class="news-header">
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
            
                <div class="news-meta">
                    <span class="category">Blog > Mix & Match</span>
                    <span class="date">21/03/2025</span>
                    <span class="read-time">Thời gian đọc: 7 Phút</span>
                </div>
            </div>
            <!-- News List -->
            <div class="container_new_list">
                <div class="main">
                    <?php
                    if(isset($_GET['id'])) {
                        $sql_detail_new = "SELECT * FROM tbl_baiviet WHERE id_baiviet='" . mysqli_real_escape_string($mysqli, $_GET['id']) . "'";
                        $query_sql_detail_new = mysqli_query($mysqli, $sql_detail_new);
                        while ($row_new_detail = mysqli_fetch_array($query_sql_detail_new)) {
                            echo $row_new_detail['tieude']; ?>
                            <div class="news-image">
                                <img src="admincp/modules/blog/image_blog/<?php echo $row_new_detail['hinhanh']; ?>">
                            </div>
                            <?php
                            echo $row_new_detail['noidung'];
                        }
                    } else {
                        echo "không có bài viết";
                    }
                    ?>

                </div>
                <div class="jewelry-news">
                    <?php
                    $sql = "SELECT * FROM tbl_baiviet WHERE id_baiviet!='" . mysqli_real_escape_string($mysqli, $_GET['id']) . "' ORDER BY id_baiviet DESC";
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
            </div>
        </div>
    </div>
</div>