<?php include ('db.php')?>
<?php
    $code = $_GET['code'];

    $sql = "SELECT * FROM Coupon WHERE code = " . $code;
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "
        <form method='post'>
        <div class='popupRemove'>
            <h2>Removing COUPON</h2>
            <input type='hidden' class='couponCode' name='couponCode' value='" . $code . "'>
            <input type='button' class='close' name='close' value='×' onclick=' . 'closeView('formRemove')' . '>
            <div class='content'>
                <label>Please confirm manual expiration of the coupon: <b>" . $row['code'] . "</b></label>
                <div align='right' style='margin-right: 30px'>
                    <input type='submit' name='submitExpire' value='Confirm' class='loginbtn'>
                </div>
            </div>
        </div>
        </form>";
    }
?>