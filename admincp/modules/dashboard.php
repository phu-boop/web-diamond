<h2 style="text-align: center;">Biểu đồ thống kê doanh thu</h2>
<canvas id="revenueChart"></canvas>

<script>
    fetch('get_chart_data.php')
    .then(response => response.json())
    .then(data => {
        const ctx = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Doanh thu (VNĐ)',
                    data: data.values,
                    borderColor: 'blue',
                    backgroundColor: 'rgba(0, 0, 255, 0.1)',
                    fill: true
                }]
            }
        });
    });
</script>

