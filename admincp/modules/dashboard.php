<h2 style="text-align: center;">Biểu đồ thống kê doanh thu</h2>

<!-- Dropdown chọn loại thống kê -->
<label for="dataType">Xem theo:</label>
<select id="dataType" onchange="updateChart()">
    <option value="daily">Theo ngày</option>
    <option value="monthly" selected>Theo tháng</option>
    <option value="yearly">Theo năm</option>
</select>

<!-- Biểu đồ doanh thu -->
<canvas id="revenueChart"></canvas>
<script>
    let revenueData = {}; // Lưu dữ liệu JSON
    const ctx = document.getElementById("revenueChart").getContext("2d");

    // Khởi tạo biểu đồ rỗng
    let revenueChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: "Doanh thu (VNĐ)",
                data: [],
                borderColor: 'blue',
                backgroundColor: 'rgba(0, 0, 255, 0.1)',
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

    // Hàm lấy dữ liệu JSON từ get_chart_data.php
    function fetchData() {
        fetch("get_chart_data.php")
            .then(response => response.json())
            .then(data => {
                revenueData = data;
                updateChart(); // Cập nhật biểu đồ ngay khi có dữ liệu
            })
            .catch(error => console.error("Lỗi khi lấy dữ liệu:", error));
    }

    // Hàm cập nhật biểu đồ theo lựa chọn
    function updateChart() {
        let type = document.getElementById("dataType").value;
        if (revenueData[type]) {
            revenueChart.data.labels = revenueData[type].labels;
            revenueChart.data.datasets[0].data = revenueData[type].values;
            revenueChart.update();
        }
    }

    fetchData(); // Tải dữ liệu ngay khi trang tải xong
</script>
<h2 style="text-align: center;">Biểu đồ số lượng khách hàng</h2>

<!-- Dropdown chọn loại thống kê -->
<select id="customerFilter" onchange="updateCustomerChart(this.value)">
    <option value="daily">Theo ngày</option>
    <option value="monthly" selected>Theo tháng</option>
    <option value="yearly">Theo năm</option>
</select>

<!-- Vùng hiển thị biểu đồ -->
<canvas id="customerChart"></canvas>

<script>
    const ctxCustomer = document.getElementById('customerChart').getContext('2d');

    // Khởi tạo biểu đồ khách hàng
    let customerChart = new Chart(ctxCustomer, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Số lượng khách hàng',
                data: [],
                borderColor: 'green',
                backgroundColor: 'rgba(0, 128, 0, 0.1)',
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

    // Hàm lấy dữ liệu từ API và cập nhật biểu đồ
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

    // Gọi dữ liệu mặc định theo tháng
    fetchCustomerData('monthly');

    // Hàm đổi loại thống kê
    function updateCustomerChart(type) {
        fetchCustomerData(type);
    }
</script>

