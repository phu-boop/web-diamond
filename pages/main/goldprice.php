<?php
// URL API lấy giá vàng
$api_url = "https://apiforlearning.zendvn.com/api/get-gold";

// Tạo context để bỏ qua SSL nếu gặp lỗi
$context = stream_context_create([
    "ssl" => [
        "verify_peer" => false,
        "verify_peer_name" => false,
    ],
]);

// Gọi API
$data = file_get_contents($api_url, false, $context);

// Kiểm tra nếu không lấy được dữ liệu
if ($data === false) {
    die("<h2 style='color:red; text-align:center;'>⚠️ Không thể lấy dữ liệu từ API. Vui lòng thử lại sau!</h2>");
}

// Chuyển dữ liệu JSON thành mảng PHP
$gold_prices = json_decode($data, true);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng Giá Vàng Hôm Nay</title>
    <style>
        /* Reset mặc định */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f4f4;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
        }

        h1 {
            color: #444;
            margin-bottom: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        thead {
            background-color: #ffcc00;
            color: black;
            font-weight: bold;
        }

        .text-right {
            text-align: right;
            font-weight: bold;
            color: #28a745;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📈 Bảng Giá Vàng Hôm Nay</h1>
        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Loại Vàng</th>
                        <th>Giá Mua (VND)</th>
                        <th>Giá Bán (VND)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($gold_prices as $gold) { ?>
                        <tr>
                            <td><?= htmlspecialchars($gold['type']) ?></td>
                            <td class="text-right"><?= number_format(str_replace('.', '', $gold['buy']), 0, ',', '.') ?> VND</td>
                            <td class="text-right"><?= number_format(str_replace('.', '', $gold['sell']), 0, ',', '.') ?> VND</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
