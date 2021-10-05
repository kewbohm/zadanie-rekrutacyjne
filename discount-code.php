<?php
    require_once('require.php');

    use Smartbees\{
        Database,
        Discount
    };

    $dbConnection = new Database();
    $discount = new Discount($dbConnection->getConnection());
    $discountCodes = $discount->getActiveDiscountCodes();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $discountValue = 0;

        foreach ($discountCodes as $discountCode) {
            if ($discountCode['code'] == $_POST['discountCode']) {
                $discountValue = $discountCode['discount'];
            }
        }

        if ($discountValue > 0) {
            echo $discountValue;
        } else {
            die(header("HTTP/1.0 404 Not Found"));
        }
    }
    