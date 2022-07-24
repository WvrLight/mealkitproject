<?php include ('db.php')?>
<?php
    session_start();

    if (!isset($_SESSION['isadmin'])) {
        echo "<script>window.location.href='login.php'</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta content='text/html;charset=utf-8'/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking</title>
    <link rel="stylesheet" type="text/css" href="assets/css/payment_style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
</head>
<body>
    <div class="nav">
        <img class="logo" src="assets/img/logo.png" id="Meal Kit Logo" alt="Meal Kit Logo">
        <ul class="home">
            <li><a href="index.php">Home</a></li>
            <li><a href="inventory.php">Meal Kits</a></li>
            <li><a href="contact.php">Contact Us</a></li>
        </ul>
        <ul class="login">
            <?php
                if (isset($_SESSION['isadmin'])) {
                    echo "<li><a href='coupon.php'><i class='fa fa-shopping-cart' aria-hidden='true'></i>&nbspCoupon List</a></li>";
                }
                if (isset($_SESSION['id'])) {
                    echo "<li><a href='orderlist.php'>&nbspOrders</a></li>";
                    echo "<li><a href='payment.php'><i class='fa fa-shopping-cart' aria-hidden='true'></i>&nbspCart</a></li>
                    <li><a href='profile.php'>View Profile</a></li>
                    <li><a href='logout.php'>Logout</a></li>";
                }
                else {
                    echo "<li><a href='login.php'>Log In</a></li>
                    <li><a href='register.php'>Sign Up</a></li>";
                }
            ?>
        </ul>
    </div>
    <div class="cart-wrapper">
        <?php
            $sql = "SELECT * FROM Coupon";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='cart_payment'>";
                echo "<h4 class='tracking_receiver'>Coupon Code</h4>
                    <p class='tracking_name'>" . $row['code'] . "</p><br>";
                echo "<h4 class='tracking_receiver'>Discount</h4>
                    <p class='tracking_name'>" . $row['discountpercent'] * 100 . "%</p><br>";

                if ($row['isexpired'] == "false") {
                    echo "<h4 class='tracking_receiver'>Expiry</h4>
                    <p class='tracking_name'>Expires on " . $row['expirydate']. "</p><br>";
                }
                else {
                    echo "<h4 class='tracking_receiver'>Expiry</h4>
                    <p class='tracking_name' style='color: red'>Expired on" . $row['expirydate'] . "</p><br>";
                }
            }
        ?>
    </div>
    <br><br><br><br>
    <div id="footer">
        Copyright &copy; 2022 <a href="index.php">Filipino Meal Kits.</a> Rights Reserved. <br>
        <a href="mailto:fmk@filipinomealkits.com">fmk@filipinomealkits.com</a>
        <p> <a href="termsandconditions.html">Terms and Conditions.</a>&nbsp&nbsp&nbsp&nbsp<a href="termsandconditions.html">Privacy Policy.</a></p>
    </div>
</body>
</html>

<?php
	if (isset($_POST['submitDeliver'])) {
		$sql = "UPDATE Order
				SET orderStatus = 1
				WHERE id = " . $_POST['orderId'];
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

		header("Refresh:2; url=orderlist.php");
	}

    if (isset($_POST['submitDelivered'])) {
		$sql = "UPDATE Order
				SET orderStatus = 2
				WHERE id = " . $_POST['orderId'];
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

		header("Refresh:2; url=orderlist.php");
	}
?>