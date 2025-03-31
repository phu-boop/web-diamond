<?php
    $api_url = "https://apiforlearning.zendvn.com/api/get-gold";
    $context = stream_context_create([
        "ssl" => [
            "verify_peer" => false,
            "verify_peer_name" => false,
        ],
    ]);
    $data = file_get_contents($api_url, false, $context);

    if ($data === false) {
        die("<h2 style='color:red; text-align:center;'>⚠️ API đang bảo trì xin vui lòng truy cập lại sao!</h2>");
    }

    $gold_prices = json_decode($data, true);
?>
<div class="page_goldprice">
    <div class="container">
        <h2>📈 Bảng Giá Vàng Hôm Nay</h2>
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
            <a href="#" class="btn-refresh">Làm mới</a>
        </div>
    </div>
</div>