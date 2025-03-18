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
?>
<div class="product-container">
    <div class="describe">
        <div class="describe_left">
            <div class="product-image" >
                <img src="admincp/modules/productMNG/image_product/<?php echo $row['hinhanh']; ?>" alt="Product Image">
            </div>
            <div class="describe_left_details">
                <div class="details_top">
                    <div class="menu">
                        <strong>Chính sách hậu mãi</strong>
                        <p><strong>Mô tả sản phẩm</strong></p>
                        <p><strong>Câu hỏi thường gặp</strong></p>
                    </div>
                </div>
                <div class="details_bottom">
                    <div class="content_1">
                        <div class="details">
                            <p><strong>Miễn phí bảo hành 6 tháng:</strong></p>
                            <ul>
                                <li>Bảo hành 6 tháng lỗi kỹ thuật, nước xi.</li>
                            </ul>
                            <p><strong>Miễn phí siêu âm và đánh bóng bằng máy chuyên dụng trọn đời:</strong></p>
                            <ul>
                                <li>Đối với sản phẩm bị oxy hóa, xỉn màu, PNJ sẽ hỗ trợ siêu âm và đánh bóng miễn phí trọn đời.</li>
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
                                <li>PNJ chỉ áp dụng chính sách này cho các sản phẩm thuộc hệ thống cửa hàng kênh lẻ và online của PNJ.</li>
                                <li>Khách hàng vui lòng xuất trình hóa đơn mua hàng hoặc thẻ khách hàng của PNJ để đối chiếu khi cần thiết.</li>
                                <li>Chính sách này có thể thay đổi mà không cần báo trước.</li>
                                <li>Quý khách vui lòng tham khảo chi tiết chính sách bảo hành vui lòng truy cập tại đây.</li>
                            </ol>
                        </div>
                    </div>
                    <div class="content_2">
                        <h1 class="title">Trang Sức Vàng 14K</h1>
                        <p><strong>Trọng lượng tham khảo:</strong> 11.92562 phân</p>
                        <p><strong>Loại đá chính:</strong> Synthetic</p>
                        <p><strong>Loại đá phụ:</strong> Xoàn mỹ</p>
                        <p><strong>Số viên đá chính:</strong> 1</p>
                        <p><strong>Giới tính:</strong> Nữ</p>
                        <p><strong>Bộ sưu tập:</strong> It's Sakura Time</p>
                        <p><strong>Thương hiệu:</strong> SANRIO</p>
                        <p>Không phải ngẫu nhiên mà trang sức vàng 14K được nhiều người ưa chuộng. Chiếc dây cổ vàng được chế tác từ vàng 14K và ghi điểm với sự kết hợp hoàn hảo giữa đá Synthetic, PNJ ❤️ HELLO KITTY sẽ mang lại hành trình đeo sáng tạo và thú vị. Với thiết kế đơn giản nhưng nhấn mạnh vào sự tinh tế, BST It's Sakura Time nhắc nhở người luôn cảm nhận vẻ đẹp của thiên nhiên trong từng khoảnh khắc. Chiếc dây cổ này không chỉ là một món trang sức mà còn là một tác phẩm nghệ thuật, thể hiện cá tính và phong cách riêng của bạn. Hãy để chiếc dây cổ này trở thành biểu tượng cho những khoảnh khắc đáng nhớ trong cuộc sống của bạn, mang đến cho bạn sự tự tin và niềm vui mỗi khi đeo nó.</p>
                    </div>
                    <div class="content_3">
                        <div class="faq-container">
                            <div class="faq-item">
                                <div class="faq-question">Mua Online có ưu đãi gì đặc biệt cho tôi?</div>
                                <div class="faq-answer">
                                    PNJ mang đến nhiều trải nghiệm mua sắm hiện đại khi mua Online:
                                    <ul>
                                        <li>Ưu đãi độc quyền Online với hình thức thanh toán đa dạng.</li>
                                        <li>Đặt giữ hàng Online, nhận tại cửa hàng.</li>
                                        <li>Miễn phí giao hàng 1-7 ngày trên toàn quốc và giao hàng trong 3 giờ tại một số khu vực trung tâm.</li>
                                        <li>Trả góp 0% lãi suất với đơn hàng từ 3 triệu.</li>
                                        <li>Làm sạch trang sức trọn đời, khắc tên miễn phí theo yêu cầu.</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question">PNJ có thu mua lại trang sức không?</div>
                                <div class="faq-answer">
                                    PNJ có dịch vụ thu đổi trang sức PNJ tại hệ thống cửa hàng trên toàn quốc. Chi tiết xem tại: 
                                    <a href="https://www.pnj.com.vn/chinh-sach-bao-hanh-va-thu-doi.html">Chính sách bảo hành và thu đổi</a>.
                                </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question">Nếu đặt mua Online mà sản phẩm không vừa thì có được đổi không?</div>
                                <div class="faq-answer">
                                    PNJ có chính sách thu đổi trang sức vàng trong vòng 48 giờ, đối ni/size trang sức bạc trong vòng 72 giờ.
                                    Quý khách có thể đổi tại hệ thống PNJ trên toàn quốc.
                                </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question">Sản phẩm đeo lâu có xỉn màu không, bảo hành như thế nào?</div>
                                <div class="faq-answer">
                                    Do tính chất hóa học, sản phẩm có khả năng oxy hóa, xuống màu. PNJ có chính sách bảo hành miễn phí về lỗi kỹ thuật:
                                    <ul>
                                        <li>Trang sức vàng: 6 tháng.</li>
                                        <li>Trang sức bạc: 3 tháng.</li>
                                    </ul>
                                    PNJ cũng cung cấp dịch vụ làm sạch miễn phí trọn đời tại hệ thống cửa hàng.
                                </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question">Tôi muốn xem trực tiếp, cửa hàng nào còn hàng?</div>
                                <div class="faq-answer">
                                    Với hệ thống cửa hàng trải rộng khắp toàn quốc, quý khách vui lòng liên hệ Hotline 1800 5454 57 (08:00-21:00, miễn phí cước gọi) để kiểm tra cửa hàng còn hàng và tư vấn chương trình khuyến mãi trước khi đến cửa hàng.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-details">
            <h1 class="product-title">Nhẫn Vàng trắng 10K đính đá ECZ PNJ XMXMW062087</h1>
            <div class="product-title-detail">
                <p class="product-code">Mã: GNXMXMW062087</p>
                <p class="rating"><i class="fa-solid fa-star"></i>(0) còn hàng <?php echo $row['soluong']; ?></p>
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
                <div class="right">
                    Cách đo size
                </div>
            </div>
            <div class="offer-box">
                <div class="offer-title">Ưu đãi:</div>
                <div class="offer-content">
                    <span><i class="fa-solid fa-gifts"></i> Ưu đãi thêm 200K cho hóa đơn từ 2.5 triệu bằng thẻ tín dụng Muadee by HDBank
                        <a href="#">Xem chi tiết</a>
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
            <div>
                <a href="#" class="btn btn-main">
                    <div>Mua ngay </div>
                    <div class="small">(Giao hàng miễn phí tận nhà hoặc nhận tại cửa hàng)</div>
                </a>
            </div>
            <div class="btn-secondary-container">
                <div class="left">
                    <a href="#" class="btn btn-secondary">
                        Thêm vào giỏ hàng
                    </a>
                </div>
                <div class="right">
                    <a href="#" class="btn btn-secondary">
                        <div>Gọi ngay (miễn phí) </div>
                        <div class="samll">Nhận ngay ưu đãi</div>
                    </a>
                </div>
            </div>
            <div class="product-buttons">
            </div>
        </div>
    </div>
</div>




