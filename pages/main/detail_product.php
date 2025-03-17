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
            <div class="product-image">
                <img src="admincp/modules/productMNG/image_product/<?php echo $row['hinhanh'] ; ?>" alt="Product Image"> 
            </div>
            <div class="describe_left_details">
                <div class="details_top">
                    <div class="menu">
                            <strong>Chính sách hậu mãi</strong></p>
                            <p><strong>Mô tả sản phẩm</strong></p>
                            <p><strong>Câu hỏi thường gặp</strong></p>
                        </div>
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
                            <p>Không phải ngẫu nhiên mà trang sức vàng 14K được nhiều người ưa chuộng. Chiếc dây cổ vàng được chế tác từ vàng 14K và ghi điểm với sự kết hợp hoàn hảo giữa đá Synthetic, PNJ ❤️ HELLO KITTY sẽ mang lại hành trình đeo sáng tạo và thú vị. Với thiết kế đơn giản nhưng, nhấn mạnh vào sự tinh tế, BST It's Sakura Time nhắc nhở người luôn cảm nhận vẻ đẹp của thiên nhiên trong từng khoảnh khắc. Chiếc dây cổ này không chỉ là một món trang sức mà còn là một tác phẩm nghệ thuật, thể hiện cá tính và phong cách riêng của bạn. Hãy để chiếc dây cổ này trở thành biểu tượng cho những khoảnh khắc đáng nhớ trong cuộc sống của bạn, mang đến cho bạn sự tự tin và niềm vui mỗi khi đeo nó.</p>
                        </div>
                    </div>
                    <div class="content_3">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="product-details">
            <h1 class="product-title">Nhẫn Vàng trắng 10K đính đá ECZ PNJ XMXMW062087</h1>
            <div class="product-title-detail">
                <p class="product-code">Mã: GNXMXMW062087</p>
                <p class="rating"><i class="fa-solid fa-star"></i>(0)  còn hàng <?php echo $row['soluong'] ?></p>
            </div>
            <div class="price">
                <p class="product-price"><?php echo number_format($row['giasp'], 0, ',', '.') . ' VNĐ'; ?></p>
                <p class="Installment">chỉ cần trả <?php echo number_format($row['giasp']/12, 0, ',', '.') . ' VNĐ'; ?>/tháng <img src="assets/images/pngegg.png" alt=""></p>
            </div>
            <div class="product-size">
                <div>
                    <p>Giá sản phẩm thay đổi tùy trọng lượng vàng và đá</p>
                    <label for="size">Chọn kích cỡ:</label>
                    <select id="size">
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                    <p>Còn hàng - cell-phone Nhấn <img src="assets/images/zalo.svg" alt=""> để được tư vấn và nhận ưu đãi</p>
                </div>
                <div>
                    Cách do size lắc
                </div>
            </div>
            <div class="offer-box">
                <div class="offer-title">Ưu đãi:</div>
                <div class="offer-content">
                    <span class="icon">✔</span>
                    <span>Ưu đãi thêm 200K cho hóa đơn từ 2.5 triệu bằng thẻ tín dụng Muadee by HDBank 
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
                    Mua ngay <br>
                    <small>Giao hàng miễn phí tận nhà hoặc nhận tại cửa hàng</small>
                </a>
            </div>
                        <div class="btn-secondary-container">
                <a href="#" class="btn btn-secondary">
                    Thêm vào giỏ hàng
                </a>
                <a href="#" class="btn btn-secondary">
                    Gọi ngay (miễn phí) <br>
                    <small>Nhận ngay ưu đãi</small>
                </a>
            </div>
            <div class="product-buttons">
            </div>
        </div>
    </div>
</div>




