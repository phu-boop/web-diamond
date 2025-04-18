<?php
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Không tìm thấy sản phẩm!");
}
$id = (int)$_GET['id'];
$sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham = $id";
$result = mysqli_query($mysqli, $sql);
if (mysqli_num_rows($result) == 0) {
    die("Sản phẩm không tồn tại!");
}
$row = mysqli_fetch_assoc($result);
$sql_similar = "SELECT * FROM tbl_sanpham WHERE id_danhmuc = " . (int)$row['id_danhmuc'] . " AND id_sanpham != " . (int)$row['id_sanpham'] . " LIMIT 4";
$sql_query_similar = mysqli_query($mysqli, $sql_similar);
?>
<div class="click_img">
    <img src="admincp/modules/productMNG/image_product/<?php echo $row['hinhanh']; ?>" alt="">
</div>
<div class="product-container">
    <div class="describe">
        <div class="describe_left">
            <div class="product-image image_detail" >
                <img src="admincp/modules/productMNG/image_product/<?php echo $row['hinhanh']; ?>" alt="Product Image">
            </div>
            <div class="describe_left_details">
                <div class="details_top">
                    <div class="menu">
                        <p class="menu_detail active" index="1"><strong>Chính sách hậu mãi</strong></p>
                        <p class="menu_detail" index="2"><strong>Mô tả sản phẩm</strong></p>
                        <p class="menu_detail" index="3"><strong>Câu hỏi thường gặp</strong></p>
                    </div>
                </div>
                <div class="details_bottom">
                    <div class="content_1 menu_detail_bottom active" index="1">
                        <div class="details">
                            <p><strong>Miễn phí bảo hành 6 tháng:</strong></p>
                            <ul>
                                <li>Bảo hành 6 tháng lỗi kỹ thuật, nước xi.</li>
                            </ul>
                            <p><strong>Miễn phí siêu âm và đánh bóng bằng máy chuyên dụng trọn đời:</strong></p>
                            <ul>
                                <li>Đối với sản phẩm bị oxy hóa, xỉn màu, LuxuryStore sẽ hỗ trợ siêu âm và đánh bóng miễn phí trọn đời.</li>
                            </ul>
                            <p><strong>Miễn phí thay đá ECZ, CZ và đá tổng hợp:</strong></p>
                            <ul>
                                <li>Miễn phí thay đá ECZ, CZ và đá tổng hợp trong suốt thời gian sử dụng.</li>
                            </ul>
                            <p><strong>Không áp dụng bảo hành cho các trường hợp sau:</strong></p>
                            <ul>
                                <li>Dây chuyền, lắc tay bị đứt.</li>
                                <li>Sản phẩm bị biến dạng do ngoại lực tác động hoặc do người dùng tự ý sửa chữa.</li>
                                <li>Khách hàng yêu cầu thay đổi mẫu mã sản phẩm.</li>
                                <li>Sản phẩm có gắn kim cương nhân tạo 22K, 24K; đá quý thiên nhiên; ngọc trai; vàng trắng; vàng hồng không được bảo hành nước xi.</li>
                                <li>Các sản phẩm trang sức bạc không được bảo hành nước xi.</li>
                            </ul>
                            <p><strong>Lưu ý về chính sách bảo hành:</strong></p>
                            <ol>
                                <li>LuxuryStore chỉ áp dụng chính sách này cho các sản phẩm thuộc hệ thống cửa hàng kênh lẻ và online của LuxuryStore.</li>
                                <li>Khách hàng vui lòng xuất trình hóa đơn mua hàng hoặc thẻ khách hàng của LuxuryStore để đối chiếu khi cần thiết.</li>
                                <li>Chính sách này có thể thay đổi mà không cần báo trước.</li>
                                <li>Quý khách vui lòng tham khảo chi tiết chính sách bảo hành vui lòng truy cập tại đây.</li>
                            </ol>
                        </div>
                    </div>
                    <div class="content_2 menu_detail_bottom" index="2">
                        <p><strong>Trọng lượng tham khảo:</strong> 11.92562 phân</p>
                        <p><strong>Loại đá chính:</strong> Synthetic</p>
                        <p><strong>Loại đá phụ:</strong> Xoàn mỹ</p>
                        <p><strong>Số viên đá chính:</strong> 1</p>
                        <p><strong>Bộ sưu tập:</strong> It's Sakura Time</p>
                        <p><strong>Thương hiệu:</strong> <?php echo $row['tensanpham'] ;?></p>
                        <p><strong>Số lượng còn: </strong><?php echo $row['soluong'] ;?></p><br>
                        <span><?php echo $row['noidung'] ;?></span>
                    </div>
                    <div class="content_3 menu_detail_bottom" index="3">
                        <div class="faq-container">
                            <div class="faq-item">
                                <div class="faq-question">Mua Online có ưu đãi gì đặc biệt cho tôi?<i class="fa-solid fa-angle-down"></i>
                                    <div class="faq-answer">
                                        LuxuryStore mang đến nhiều trải nghiệm mua sắm hiện đại khi mua Online:
                                        <ul>
                                            <li>Ưu đãi độc quyền Online với hình thức thanh toán đa dạng.</li>
                                            <li>Đặt giữ hàng Online, nhận tại cửa hàng.</li>
                                            <li>Miễn phí giao hàng 1-7 ngày trên toàn quốc và giao hàng trong 3 giờ tại một số khu vực trung tâm.</li>
                                            <li>Trả góp 0% lãi suất với đơn hàng từ 3 triệu.</li>
                                            <li>Làm sạch trang sức trọn đời, khắc tên miễn phí theo yêu cầu.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question">LuxuryStore có thu mua lại trang sức không?<i class="fa-solid fa-angle-down"></i>
                                    <div class="faq-answer">
                                        LuxuryStore có dịch vụ thu đổi trang sức LuxuryStore tại hệ thống cửa hàng trên toàn quốc. Chi tiết xem tại: 
                                        <a href="https://www.LuxuryStore.com.vn/chinh-sach-bao-hanh-va-thu-doi.html">Chính sách bảo hành và thu đổi</a>.
                                    </div>
                                </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question">Nếu đặt mua Online mà sản phẩm không vừa thì có được đổi không?<i class="fa-solid fa-angle-down"></i>
                                    <div class="faq-answer">
                                        LuxuryStore có chính sách thu đổi trang sức vàng trong vòng 48 giờ, đối ni/size trang sức bạc trong vòng 72 giờ.
                                        Quý khách có thể đổi tại hệ thống LuxuryStore trên toàn quốc.
                                    </div>
                                </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question">Sản phẩm đeo lâu có xỉn màu không, bảo hành như thế nào?<i class="fa-solid fa-angle-down"></i>
                                    <div class="faq-answer">
                                        Do tính chất hóa học, sản phẩm có khả năng oxy hóa, xuống màu. LuxuryStore có chính sách bảo hành miễn phí về lỗi kỹ thuật:
                                        <ul>
                                            <li>Trang sức vàng: 6 tháng.</li>
                                            <li>Trang sức bạc: 3 tháng.</li>
                                        </ul>
                                        LuxuryStore cũng cung cấp dịch vụ làm sạch miễn phí trọn đời tại hệ thống cửa hàng.
                                    </div>
                                </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question">Tôi muốn xem trực tiếp, cửa hàng nào còn hàng?<i class="fa-solid fa-angle-down"></i>
                                    <div class="faq-answer">
                                        Với hệ thống cửa hàng trải rộng khắp toàn quốc, quý khách vui lòng liên hệ Hotline 1800 5454 57 (08:00-21:00, miễn phí cước gọi) để kiểm tra cửa hàng còn hàng và tư vấn chương trình khuyến mãi trước khi đến cửa hàng.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-details">
            <h1 class="product-title"><?php echo $row['tensanpham'] ?></h1>
            <div class="product-title-detail">
                <p class="product-code">Mã: <?php echo $row['id_sanpham'] ?></p>
                <p class="rating"><i class="fa-solid fa-star"></i>(<?php echo $row['soluong'] ?>) còn hàng <?php echo $row['soluong']; ?></p>
            </div>
            <div class="price">
                <p class="product-price"><?php echo number_format($row['giasp'], 0, ',', '.') . ' VNĐ'; ?></p>
                <p class="Installment">chỉ cần trả <?php echo number_format($row['giasp'] / 12, 0, ',', '.') . ' VNĐ'; ?>/tháng <img src="assets/images/pngegg.png" alt=""></p>
            </div>
            <div class="product-size">
                <div class="left">
                    <p>(Giá sản phẩm thay đổi tùy trọng lượng vàng và đá)</p>
                    <label for="size">Chọn kích cỡ:</label>
                    <select id="size">
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                    <p class="zalo">Còn hàng -<img src="assets/images/zalo.svg" alt="">- để được tư vấn và nhận ưu đãi</p>
                </div>
                <div class="right" id="size">
                    Cách đo size
                </div>
                <div class="img_size">
                    <img src="assets/images/img_size.png" alt="">
                    <div class="remove"></div>
                </div>
            </div>
            <div class="offer-box">
                <div class="offer-title">Ưu đãi:</div>
                <div class="offer-content">
                    <span><i class="fa-solid fa-gifts"></i> Ưu đãi thêm 200K cho hóa đơn từ 2.5 triệu bằng thẻ tín dụng Muadee by HDBank
                        <a id="closs" href="#">Xem chi tiết</a>
                    </span>
                </div>
            </div>
            <div class="policy-container">
                <div class="policy-item">
                    <img src="assets/images/shopping_1.svg" alt="Giao hàng">
                    <span>Miễn phí giao hàng</span>
                </div>
                <div class="policy-item">
                    <img src="assets/images/shopping_2.svg" alt="Dịch vụ">
                    <span>Phục vụ 24/7</span>
                </div>
                <div class="policy-item">
                    <img src="assets/images/shopping_3.svg" alt="Thu đổi">
                    <span>Thu đổi 48h</span>
                </div>
            </div>
            <div >
                <form action="pages/main/add_cart.php?id=<?php echo $row['id_sanpham']; ?>" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id_sanpham']; ?>">
                        <button type="submit" name="muangay" class="btn btn-main">
                            Mua ngay
                            <div class="small">(Giao hàng miễn phí tận nhà hoặc nhận tại cửa hàng)</div>
                        </button>
                </form>
            </div>
            <div class="btn-secondary-container">
                <div class="left">
                    <form action="pages/main/add_cart.php?id=<?php echo $row['id_sanpham']; ?>" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id_sanpham']; ?>">
                        <button type="submit" name="themgiohang" class="btn btn-secondary">
                            Thêm vào giỏ hàng
                        </button>
                    </form>
                </div>
                <div class="right">
                    <a href="#" class="btn btn-secondary">
                        <div>Gọi ngay <small>(miễn phí)</samll> </div>
                        <small class="samll">Nhận ngay ưu đãi</small>
                    </a>
                </div>
            </div>
            <div class="product-buttons">
            </div>
            <div class="container_bottom">
                <div class="header">
                    <span>Xem Cửa Hàng Còn Hàng</span>
                    <button class="btn">Ưu đãi mua hàng Online<br>Nhận tại cửa hàng</button>
                </div>

                <div class="dropdowns">
                    <select id="city">
                        <option value="">Tỉnh/Thành phố</option>
                        <option value="HCM">Hồ Chí Minh</option>
                        <option value="HN">Hà Nội</option>
                        <option value="DN">Đà Nẵng</option>
                    </select>

                    <select id="district">
                        <option value="">Quận/Huyện</option>
                    </select>
                </div>

                <div class="store-info" id="store-info">
                    Hiện có 0 cửa hàng theo size và khu vực đã chọn
                </div>
            </div>
        </div>
    </div>
    <div class="product_similar">
        <p class="title">Sản phẩm tương tự</p> 
        <div class="content-1">
            <?php
                while ($row_similar = mysqli_fetch_array($sql_query_similar)) { ?>
                    <div class="product" >
                        <a href="index.php?quanly=chitietsanpham&id=<?php echo $row_similar['id_sanpham']; ?>">
                            <img src="admincp/modules/productMNG/image_product/<?php echo $row_similar['hinhanh']; ?>" alt="ảnh sản phẩm">
                            <h4><?php echo $row_similar['tensanpham']; ?></h4>
                            <p class="price"><?php echo number_format($row_similar['giasp'], 0, ',', '.'); ?>đ</p>
                            <p class="quantity">chỉ còn <?php echo $row_similar['soluong']; ?></p>
                        </a>
                    </div>
            <?php } ?>
        </div>
    </div>
</div>




