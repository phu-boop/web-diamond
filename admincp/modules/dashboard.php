
<div class="dashboard_container">
    <?php
    include "config/config.php"; // Kết nối CSDL

    // Tháng hiện tại và tháng trước
    $current_month = date('Y-m');
    $previous_month = date('Y-m', strtotime('-1 month')); 

    // Truy vấn tổng khách hàng tháng hiện tại
    $sql_customers_current = "SELECT COUNT(*) as total 
    FROM tbl_dangky 
    WHERE DATE_FORMAT(ngay_dangky, '%Y-%m') = '$current_month'";
    $result_customers_current = mysqli_query($mysqli, $sql_customers_current);
    $total_customers_current = 0;
    if ($result_customers_current && mysqli_num_rows($result_customers_current) > 0) {
    $row_customers_current = mysqli_fetch_assoc($result_customers_current);
    $total_customers_current = $row_customers_current['total'];
    }

    // Truy vấn tổng tất cả sản phẩm
    $sql_products = "SELECT COUNT(*) as total 
    FROM tbl_sanpham";
    $result_products = mysqli_query($mysqli, $sql_products);
    $total_product = 0;
    if ($result_products && mysqli_num_rows($result_products) > 0) {
    $row_products = mysqli_fetch_assoc($result_products);
    $total_product = $row_products['total'];
    }

    // Tổng đơn hàng 
    $sql_total_orders_current = "SELECT COUNT(*) as total 
                                FROM tbl_giohang 
                                WHERE DATE_FORMAT(ngay_mua, '%Y-%m') = '$current_month' 
                                AND trangthai_giohang = 1";
    $result_total_orders_current = mysqli_query($mysqli, $sql_total_orders_current);
    if (!$result_total_orders_current) {
        echo json_encode(['error' => 'Lỗi truy vấn Tổng Đơn Hàng (tháng hiện tại): ' . mysqli_error($mysqli)]);
        exit;
    }
    $row_total_orders_current = mysqli_fetch_assoc($result_total_orders_current);
    $total_orders_current = $row_total_orders_current['total'];

    $sql_total_orders_prev = "SELECT COUNT(*) as total 
                            FROM tbl_giohang 
                            WHERE DATE_FORMAT(ngay_mua, '%Y-%m') = '$previous_month' 
                            AND trangthai_giohang = 1";
    $result_total_orders_prev = mysqli_query($mysqli, $sql_total_orders_prev);
    if (!$result_total_orders_prev) {
        echo json_encode(['error' => 'Lỗi truy vấn Tổng Đơn Hàng (tháng trước): ' . mysqli_error($mysqli)]);
        exit;
    }
    $row_total_orders_prev = mysqli_fetch_assoc($result_total_orders_prev);
    $total_orders_prev = $row_total_orders_prev['total'];
    $order_growth = $total_orders_prev > 0 ? (($total_orders_current - $total_orders_prev) / $total_orders_prev) * 100 : 0;

    // Tổng doanh thu (giữ nguyên)
    $sql_total_revenue_current = "SELECT SUM(COALESCE(tongtien, 0)) as total 
                                FROM tbl_giohang 
                                WHERE DATE_FORMAT(ngay_mua, '%Y-%m') = '$current_month' 
                                AND trangthai_giohang = 1";
    $result_total_revenue_current = mysqli_query($mysqli, $sql_total_revenue_current);
    if (!$result_total_revenue_current) {
        echo json_encode(['error' => 'Lỗi truy vấn Tổng Doanh Thu (tháng hiện tại): ' . mysqli_error($mysqli)]);
        exit;
    }
    $row_total_revenue_current = mysqli_fetch_assoc($result_total_revenue_current);
    $total_revenue_current = $row_total_revenue_current['total'] ?? 0;

    $sql_total_revenue_prev = "SELECT SUM(COALESCE(tongtien, 0)) as total 
                            FROM tbl_giohang 
                            WHERE DATE_FORMAT(ngay_mua, '%Y-%m') = '$previous_month' 
                            AND trangthai_giohang = 1";
    $result_total_revenue_prev = mysqli_query($mysqli, $sql_total_revenue_prev);
    if (!$result_total_revenue_prev) {
        echo json_encode(['error' => 'Lỗi truy vấn Tổng Doanh Thu (tháng trước): ' . mysqli_error($mysqli)]);
        exit;
    }
    $row_total_revenue_prev = mysqli_fetch_assoc($result_total_revenue_prev);
    $total_revenue_prev = $row_total_revenue_prev['total'] ?? 0;

    $revenue_growth = $total_revenue_prev > 0 ? (($total_revenue_current - $total_revenue_prev) / $total_revenue_prev) * 100 : 0;

    ?>

    <!-- Biểu đồ -->
    <div class="charts">
        <!-- Biểu đồ doanh thu -->
        <div class="chart">
            <h2>Biểu Đồ Thống Kê Doanh Thu</h2>
            <label for="dataType">Xem theo:</label>
            <select id="dataType" onchange="updateChart()">
                <option value="daily">Theo ngày</option>
                <option value="monthly" selected>Theo tháng</option>
                <option value="yearly">Theo năm</option>
            </select>
            <canvas id="revenueChart"></canvas>
            <script>
                let revenueData = {};
                const ctx = document.getElementById("revenueChart").getContext("2d");
                let revenueChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [],
                        datasets: [{
                            label: "Doanh thu (VNĐ)",
                            data: [],
                            borderColor: '#6c63ff',
                            backgroundColor: 'rgba(108, 99, 255, 0.1)',
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: { legend: { display: true, position: 'top' } },
                        scales: {
                            x: { title: { display: true, text: "Thời gian" } },
                            y: { title: { display: true, text: "Doanh thu (VNĐ)" }, beginAtZero: true }
                        }
                    }
                });

                function fetchData() {
                    fetch("get_chart_data.php")
                        .then(response => response.json())
                        .then(data => {
                            revenueData = data;
                            updateChart();
                        })
                        .catch(error => console.error("Lỗi khi lấy dữ liệu:", error));
                }

                function updateChart() {
                    let type = document.getElementById("dataType").value;
                    if (revenueData[type]) {
                        revenueChart.data.labels = revenueData[type].labels;
                        revenueChart.data.datasets[0].data = revenueData[type].values;
                        revenueChart.update();
                    }
                }

                fetchData();
            </script>
        </div>
        <div class="card_and_char">
            <div class="card_and_char_top">
                <div class="card">
                    <img src="../assets/images/profit.png" alt="">
                    <h3>Đơn Hàng</h3>
                    <p><?php echo $total_orders_current; ?></p>
                    <p class="change <?php echo $order_growth >= 0 ? 'up' : 'down'; ?>">
                        <?php echo $order_growth >= 0 ? '<i class="fa-solid fa-arrow-up"></i>' : '<i class="fa-solid fa-arrow-down"></i>'; ?><?php echo number_format($order_growth, 2); ?>%
                    </p>
                </div>
                <div class="card">
                    <img src="../assets/images/sell.png" alt="">
                    <h3>Doanh Thu</h3>
                    <p><?php echo number_format($total_revenue_current, 0, ',', '.'); ?> VNĐ</p>
                    <p class="change <?php echo $revenue_growth >= 0 ? 'up' : 'down'; ?>">
                        <?php echo $revenue_growth >= 0 ? '<i class="fa-solid fa-arrow-up"></i>' : '<i class="fa-solid fa-arrow-down"></i>'; ?><?php echo number_format($revenue_growth, 2); ?>%
                    </p>
                </div>
            </div>
            <div>
                <!-- Biểu đồ trạng thái đơn hàng -->
                <div class="chart small">
                    <h2>Trạng Thái Đơn Hàng</h2>
                    <canvas id="orderStatusChart"></canvas>
                    <?php
                    $status_counts = [0 => 0, 1 => 0]; // 0: Chưa xử lý, 1: Đã xử lý
                    $sql_status = "SELECT trangthai_giohang, COUNT(*) as count 
                                FROM tbl_giohang 
                                GROUP BY trangthai_giohang";
                    $result_status = mysqli_query($mysqli, $sql_status);
                    if (!$result_status) {
                        die("Lỗi truy vấn Trạng Thái Đơn Hàng: " . mysqli_error($mysqli));
                    }
                    while ($row = mysqli_fetch_assoc($result_status)) {
                        $status_counts[$row['trangthai_giohang']] = $row['count'];
                    }
                    ?>
                    <script>
                        const orderStatusChart = new Chart(document.getElementById('orderStatusChart'), {
                            type: 'doughnut',
                            data: {
                                labels: ['Chưa xử lý', 'Đã xử lý'],
                                datasets: [{
                                    data: [<?php echo $status_counts[0]; ?>, <?php echo $status_counts[1]; ?>],
                                    backgroundColor: ['#40c4ff', '#6c63ff']
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: { position: 'bottom' }
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>

    <div class="charts">
        <!-- Biểu đồ số lượng khách hàng -->
        <div class="chart">
            <h2>Biểu Đồ Số Lượng Khách Hàng Mua hàng</h2>
            <select id="customerFilter" onchange="updateCustomerChart(this.value)">
                <option value="daily">Theo ngày</option>
                <option value="monthly" selected>Theo tháng</option>
                <option value="yearly">Theo năm</option>
            </select>
            <canvas id="customerChart"></canvas>
            <script>
                const ctxCustomer = document.getElementById('customerChart').getContext('2d');
                let customerChart = new Chart(ctxCustomer, {
                    type: 'line',
                    data: {
                        labels: [],
                        datasets: [{
                            label: 'Số lượng khách hàng',
                            data: [],
                            borderColor: '#28a745',
                            backgroundColor: 'rgba(40, 167, 69, 0.1)',
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: true, position: 'top' }
                        },
                        scales: {
                            x: { title: { display: true, text: 'Thời gian' } },
                            y: { title: { display: true, text: 'Số lượng khách hàng' }, beginAtZero: true }
                        }
                    }
                });

                function fetchCustomerData(type = 'monthly') {
                    fetch('get_customer_data.php')
                        .then(response => response.json())
                        .then(data => {
                            if (data[type]) {
                                customerChart.data.labels = data[type].labels;
                                customerChart.data.datasets[0].data = data[type].values;
                                customerChart.update();
                            }
                        })
                        .catch(error => console.error("Lỗi khi lấy dữ liệu khách hàng:", error));
                }

                fetchCustomerData('monthly');

                function updateCustomerChart(type) {
                    fetchCustomerData(type);
                }
            </script>
        </div>
        <div class="card_and_char">
            <div class="card_and_char_top">
                <div class="card">
                    <img src="../assets/images/customer.png" alt="">
                    <h3>Tổng Khách Hàng</h3>
                    <p><?php echo $total_customers_current; ?></p>
                </div>
                <div class="card">
                    <img src="../assets/images/product.png" alt="">
                    <h3>Sản Phẩm</h3>
                    <p><?php echo $total_product; ?></p>
                </div>
            </div>
            <!-- Biểu đồ sản phẩm theo danh mục -->
            <div class="chart small">
                <h2>Sản Phẩm Theo Danh Mục</h2>
                <canvas id="categoryChart"></canvas>
                <?php
                $category_data = [];
                $sql_category = "SELECT d.tendanhmuc, COUNT(s.id_sanpham) as count 
                                FROM tbl_danhmuc d 
                                LEFT JOIN tbl_sanpham s ON d.id_danhmuc = s.id_danhmuc 
                                GROUP BY d.id_danhmuc, d.tendanhmuc";
                $result_category = mysqli_query($mysqli, $sql_category);
                if (!$result_category) {
                    die("Lỗi truy vấn Sản Phẩm Theo Danh Mục: " . mysqli_error($mysqli));
                }
                $labels = [];
                $data = [];
                while ($row = mysqli_fetch_assoc($result_category)) {
                    $labels[] = $row['tendanhmuc'];
                    $data[] = $row['count'];
                }
                ?>
                <script>
                    const categoryChart = new Chart(document.getElementById('categoryChart'), {
                        type: 'doughnut',
                        data: {
                            labels: [<?php echo "'" . implode("','", $labels) . "'"; ?>],
                            datasets: [{
                                data: [<?php echo implode(',', $data); ?>],
                                backgroundColor: ['#40c4ff', '#6c63ff', '#ffca28', '#ff7043']
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: { position: 'bottom' }
                            }
                        }
                    });
                </script>
            </div>
        </div>
    </div>

    <!-- Tìm kiếm khách hàng -->
    <div class="search">
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Tìm kiếm khách hàng theo tên..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button type="submit"><i class="fa fa-search"></i> Tìm kiếm</button>
        </form>
    </div>

    <!-- Danh sách khách hàng -->
    <div class="recent-orders">
        <h3>Danh Sách Khách Hàng</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Khách Hàng</th>
                    <th>Email</th>
                    <th>Địa Chỉ</th>
                    <th>Điện Thoại</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $search = isset($_GET['search']) ? mysqli_real_escape_string($mysqli, $_GET['search']) : '';
                $sql_customers = "SELECT * FROM tbl_dangky";
                if ($search) {
                    $sql_customers .= " WHERE tenkhachhang LIKE '%$search%'";
                }
                $result_customers = mysqli_query($mysqli, $sql_customers);
                if (!$result_customers) {
                    die("Lỗi truy vấn Danh Sách Khách Hàng: " . mysqli_error($mysqli));
                }
                while ($row = mysqli_fetch_assoc($result_customers)) {
                ?>
                <tr>
                    <td><?php echo $row['id_dangky']; ?></td>
                    <td><?php echo $row['tenkhachhang']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['diachi']; ?></td>
                    <td><?php echo $row['dienthoai']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Đơn hàng gần đây -->
    <div class="recent-orders">
        <h3>Đơn Hàng Gần Đây</h3>
        <table>
            <thead>
                <tr>
                    <th>Mã Đơn Hàng</th>
                    <th>Khách Hàng</th>
                    <th>Ngày Mua</th>
                    <th>Tổng Tiền</th>
                    <th>Trạng Thái</th>
                    <th>Phương Thức Thanh Toán</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_orders = "SELECT g.*, d.tenkhachhang 
                               FROM tbl_giohang g 
                               JOIN tbl_dangky d ON g.id_khachhang = d.id_dangky 
                               ORDER BY g.ngay_mua DESC LIMIT 5";
                $result_orders = mysqli_query($mysqli, $sql_orders);
                if (!$result_orders) {
                    die("Lỗi truy vấn Đơn Hàng Gần Đây: " . mysqli_error($mysqli));
                }
                while ($row = mysqli_fetch_assoc($result_orders)) {
                ?>
                <tr>
                    <td><?php echo $row['ma_giohang']; ?></td>
                    <td><?php echo $row['tenkhachhang']; ?></td>
                    <td><?php echo $row['ngay_mua']; ?></td>
                    <td><?php echo number_format($row['tongtien'], 0, ',', '.'); ?> VNĐ</td>
                    <td><?php echo $row['trangthai_giohang'] == 1 ? 'Đã xử lý' : 'Chưa xử lý'; ?></td>
                    <td><?php echo $row['pt_thanhtoan']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


</div>