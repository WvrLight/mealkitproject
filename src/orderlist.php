<?php include ('db.php')?>
<?php
    session_start();

    if (!isset($_SESSION['id'])) {
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
                    echo "<li><a href='couponlist.php'>&nbspCoupon List</a></li>";
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
            if (!isset($_SESSION['isadmin'])) {
                $sql = "SELECT * FROM Orders WHERE custId = " . $_SESSION['id'];
            }
            else {
                $sql = "SELECT * FROM Orders";
            }
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='cart_payment'>
                    <h4 class='tracking_receiver'><i class='fa fa-address-card-o' aria-hidden='true'></i> Receiver</h4>";

                $sqluser = "SELECT * FROM Customer WHERE id = " . $row['custid'];
                $stmtuser = $pdo->prepare($sqluser);
                $stmtuser->execute();

                while ($rowuser = $stmtuser->fetch(PDO::FETCH_ASSOC)) {
                    echo "<p class='tracking_name'>" . $rowuser['custfullname'] . "</p>";

                    echo "<br><h4 class='tracking_receiver'>Address</h4>";
                    echo "<p class='tracking_address'>" . $rowuser['custaddress'] . "</p>";

                    echo "<br><h4 class='tracking_receiver'>Contact Number</h4>";
                    echo "<p class='tracking_address'>" . $rowuser['custnumber'] . "</p>";
                }

                $sqlcart = "SELECT * FROM OrderCart WHERE orderId = " . $row['id'];
                $stmtcart = $pdo->prepare($sqlcart);
                $stmtcart->execute();

                while ($rowcart = $stmtcart->fetch(PDO::FETCH_ASSOC)) {
                    $sqlproduct = "SELECT * FROM Product WHERE id = " . $rowcart['productid'];
                    $stmtproduct = $pdo->prepare($sqlproduct);
                    $stmtproduct->execute();

                    while ($rowproduct = $stmtproduct->fetch(PDO::FETCH_ASSOC)) {
                        echo "
                            <div class='mealkit_cart'>
                                <img src='" . $rowproduct['productimgurl'] . "' class='meal_pic'>
                                <p class='mealkit_title'>" . $rowproduct['productname'] . "</p>";
                        if ($rowproduct['productsaleprice'] == null) {
                            echo "<p class='mealkit_price'>₱" . $rowproduct['productprice'] . "</p>";
                        }
                        else {
                            echo "<p class='mealkit_price'>₱" . $rowproduct['productsaleprice'] . "</p>";
                        }
                        echo "</div>";
                    }
                }

                echo "<br><br><form method='post'>
                <input type='hidden' class='orderID' name='orderId' value='" . $row['id'] . "'>
                <div id='tracking_section'>";
                switch ($row['orderstatus']) {
                    case 0:
                        echo "<p class='tracking_prepared'><i class='fa fa-tasks' aria-hidden='true'></i>&nbsp&nbspThe parcel is being prepared. </p>";

                        if (isset($_SESSION['isadmin'])) {
                            echo "<form method='post'>
                            <input type='hidden' name='orderId' value='" . $row['id'] . "'>
                            <div align='right' style='margin-right: 30px width: 20%;'>
                                <input type='submit' name='submitDeliver' value='Mark as Delivering' class='button'>
                            </div>
                            </form>";
                        }
                        break;
                    case 1:
                        echo "<p class='tracking_out'><i class='fa fa-tasks' aria-hidden='true'></i>&nbsp&nbspThe parcel is out for delivery. </p>";

                        if (!isset($_SESSION['isadmin'])) {
                            echo "<form method='post'>
                            <input type='hidden' name='orderId' value='" . $row['id'] . "'>
                            <div align='right' style='margin-right: 30px width: 20%;'>
                                <input type='submit' name='submitDelivered' value='Mark as Delivered' class='button'>
                            </div>
                            </form>";
                        }
                        break;
                    case 2:
                        echo "<p class='tracking_delievered'><i class='fa fa-tasks' aria-hidden='true'></i>&nbsp&nbspThe parcel is delivered. </p>";
                        break;
                }
                echo "</div>
                </div>";
            }
        ?>
    </div>
    <br><br><br><br>
    <div id="footer">
        Copyright &copy; 2022 <a href="index.php">Filipino Meal Kits.</a> Rights Reserved. <br>
        <a href="mailto:fmk@filipinomealkits.com">fmk@filipinomealkits.com</a>
        <p> <a href="termsandconditions.php">Terms and Conditions.</a>&nbsp&nbsp&nbsp&nbsp<a href="termsandconditions.php">Privacy Policy.</a></p>
    </div>
</body>
</html>

<?php
	if (isset($_POST['submitDeliver'])) {
		$sql = "UPDATE Orders
				SET orderStatus = 1
				WHERE id = " . $_POST['orderId'];
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

		header("Refresh:2; url=orderlist.php");
	}

    if (isset($_POST['submitDelivered'])) {
		$sql = "UPDATE Orders
				SET orderStatus = 2
				WHERE id = " . $_POST['orderId'];
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

		header("Refresh:2; url=orderlist.php");
	}
?>