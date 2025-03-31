<div class="page_list_blog">
    <?php
    $sql_list_blog="SELECT * FROM tbl_baiviet ORDER BY id_baiviet DESC";
    $query_blog=mysqli_query($mysqli,$sql_list_blog);
    ?>
    <div class="container">
            <div class="top">
                <a href="index.php?action=quanlybaiviet&query=them" class="btn add_blog">
                    <i class="fa-solid fa-plus"></i> Thêm Bài Viết
                </a>
            </div>
        <table class="blog-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>hinh anh</th>
                    <th>Tiêu Đề</th>
                    <th>Ngày đăng</th>
                    <th>Quản lý</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($row=mysqli_fetch_array($query_blog)){
                ?>
                <tr>
                    <td><?php echo $row['id_baiviet']; ?></td>
                    <td><img src="modules/blog/image_blog/<?php echo $row['hinhanh']; ?>" alt="Blog Image" width="100"></td>
                    <td><?php echo $row['tieude']; ?></td>
                    <td><?php echo $row['ngaydang']; ?></td>
                    <td>
                        <a href="?action=quanlybaiviet&&query=sua&id=<?php echo $row['id_baiviet']; ?>"><i class="fa-regular fa-pen-to-square"></i></a>
                        <a name="edit" href="modules/blog/handle.php?id=<?php echo $row['id_baiviet']; ?>"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

