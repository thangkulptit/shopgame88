<html>
    <head>
        <title>Card charging</title>
        <meta charset="utf-8">
    </head>
    <body>
        <?php
        include 'config.php';
        include 'card_charging_api.php';

        // Call lib
        try {
            $api = new Card_charging_api($config);
        } catch (Card_charging_Exception $e) {
            exit($e->getMessage());
        }
        
        // Lay danh sach cac loai the dang hoat dong
        $telcos = $api->get_card_keys();
        $telcos = is_array($telcos) ? $telcos : array();
        ?>
        <form class="form_action" action="check_card.php" style="width:500px;margin:20px auto" accept-charset="UTF-8" method="post">
            <p>
                <select name="telco">
                    <option>Chọn loại thẻ</option>
                    <?php foreach ($telcos as $telco): ?>
                        <option value="<?php echo $telco->type; ?>"><?php echo $telco->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
            <p>
                <input type="text" name="code" placeholder="Mã thẻ:" >
            </p>
            <p>
                <input type="text" name="serial" placeholder="Serial:">
            </p>
            <select name="card_amount">
                <option>Mệnh giá thẻ</option>
                <?php foreach (array(10000, 20000, 30000, 50000, 100000, 200000, 300000, 500000, 1000000) as $p) :?>
                <option value="<?php echo $p; ?>"><?php echo number_format($p); ?>đ</option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Đổi thẻ cào</button>
        </form>
    </body>
</html>