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
    <link rel="stylesheet" type="text/css" href="assets/css/styles_responsive.css">
    <script>
        function expireCoupon(id) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var view = document.getElementById('formRemove');
                    view.innerHTML = this.responseText;
                    view.style.visibility = 'visible';
                    view.style.opacity = 1;
                }
            };
            xmlhttp.open("GET", "inventoryremove.php?id=" + id, true);
            xmlhttp.send();
        }

        function closeView(elementId) {
            var element = document.getElementById(elementId);
            element.style.visibility = 'hidden';
            element.style.opacity = 0;
        }
    </script>
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
    <div class="wholecontainer">
        <div class="product-header">
            <br><a href='#formAdd' class='button1'>+</a>
            <h1>Coupons</h1>
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

                    echo "echo <h4 class='tracking_receiver'>Expiry</h4>";
                    if (!$row['isexpired']) {
                        echo "<p class='tracking_name'>Expires on " . $row['couponexpiry']. "</p><br>";
                        echo "<input type='button' class='button' name='expire' value='Set as Expired' onclick='expireCoupon(" . $row['code'] . ")'>";
                    }
                    else {
                        echo "<p class='tracking_name' style='color: red'>Expired on " . $row['couponexpiry'] . "</p><br>";
                    }
                    echo "</div>";
                }
            ?>
        </div>
    </div>
    <br><br><br><br><br><br><br><br>
    <div id="footer">
        Copyright &copy; 2022 <a href="index.php">Filipino Meal Kits.</a> Rights Reserved. <br>
        <a href="mailto:fmk@filipinomealkits.com">fmk@filipinomealkits.com</a>
        <p> <a href="termsandconditions.html">Terms and Conditions.</a>&nbsp&nbsp&nbsp&nbsp<a href="termsandconditions.html">Privacy Policy.</a></p>
    </div>
    <div id="formAdd" class="overlayAdd">
        <form method="post">
            <div class="popupAdd">
                <h2>Add new COUPON</h2>
                    <a class="close" href="#">×</a>
                <div class="content">
                    <label>Coupon Code:</label>
                        <input type="text" name="couponCode" placeholder="--Enter New Code--" class="prodContent" required/><br>
                    <label>Coupon Discount:</label>
                        <input type="text" name="couponDiscount" placeholder="--Enter Discount IN DECIMAL FORM (i.e. 0.10, 0.50)--" class="prodContent" required/><br>
                    <label>Coupon End Date:</label>
                        <input type="date" name="couponDate" class="prodContent" required><br><br><br>
                    <div align="right" style="margin-right: 30px">
                        <input type="submit" name="submitAdd" value="Add" class="loginbtn">
                        <input type='reset' class="clearbtn" name='resetBtn' value='Clear'/>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="formRemove" class="overlayRemove">
	</div>
</body>
</html>

<?php
	if (isset($_POST['submitAdd'])) {
		$sql = "INSERT INTO Coupon(code, discountPercent, isOneTimeUse, couponExpiry, isExpired)
				VALUES('" . $_POST['couponCode'] . "', " . $_POST['couponDiscount'] . ", false, '" . $_POST['couponDate'] . "', false)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

		header("Refresh:2; url=couponlist.php");
	}

    if (isset($_POST['submitExpire'])) {
		$sql = "UPDATE Coupon
				SET isExpired = true
				WHERE code = " . $_POST['couponCode'];
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

		header("Refresh:2; url=couponlist.php");
	}
?>