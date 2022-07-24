<?php include ('db.php')?>
<?php
    $code = $_GET['code'];

    $sql = "SELECT * FROM Coupon WHERE code = '" . $code . "'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $couponResult = false;
		
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if (!strcmp($_GET['code'], $row['code'])) {
            $couponResult = true;
            echo $row['discountpercent'];
        }
    }

    if (!$couponResult) {
        echo "Invalid";
    }
?>