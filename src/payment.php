<?php include ('db.php')?>
<?php 
	session_start();
    $totalPrice = 0.0;

    if (!isset($_SESSION['id'])) {
        echo "<script>window.location.href='login.php'</script>";
    }
    else if (count($_SESSION['cart']) == 0) {
        echo "<script>alert('Add items to cart first!');</script>";
        echo "<script>window.location.href='inventory.php'</script>";
    }
    else {
        $sql = 'SELECT * FROM Orders';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $orderId = $stmt->rowCount();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta content='text/html;charset=utf-8'/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" type="text/css" href="assets/css/payment_style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    <script>
        function checkCoupon(code, price) {
            if (code.length == 0) {
                document.getElementById("couponValidity").innerText = "";
                document.getElementById("totalPrice").innerText = "₱ " + price;
                return;
            } else {
                console.log("<?php echo $totalPrice; ?>");
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        if (this.responseText == "Invalid") {
                            document.getElementById("totalPrice").innerText = "₱ " +  price;
                            document.getElementById("couponValidity").innerText = this.responseText;
                        }
                        else {
                            var discount = this.responseText;

                            document.getElementById("totalPrice").innerText = "₱ " + (price - (price * discount));
                            document.getElementById("couponValidity").innerText = (discount * 100) + "% off";
                        }
                    }
                };
                xmlhttp.open("GET", "checkcoupon.php?code=" + code, true);
                xmlhttp.send();
            }
        }

        function checkCard(number) {
            var visa = /^(?:4[0-9]{12}(?:[0-9]{3})?)$/;
            var mastercard = /^(?:5[1-5][0-9]{14})$/;
            if (number.length == 0) {
                document.getElementById("cardValidity").innerText = "";
            }
            if (number.value.match(visa)) {
                document.getElementById("cardValidity").innerText = "Valid (VISA)";
            }
            else if (number.value.match(mastercard)) {
                document.getElementById("cardValidity").innerText = "Valid (MasterCard)";
            }
            else {
                document.getElementById("cardValidity").innerText = "Invalid";
            }
        }

        var cod = document.getElementById("radio_cod");
        cod.onclick => {
             document.getElementById("card_holder").required = false;
             document.getElementById("card_holder").innerText = "";
             document.getElementById("card_holder").setAttribute('disabled', '');

             document.getElementById("card_number").required = false;
             document.getElementById("card_number").innerText = "";
             document.getElementById("card_number").setAttribute('disabled', '');

             document.getElementById("expiry_date").required = false;
             document.getElementById("expiry_date").innerText = "";
             document.getElementById("expiry_date").setAttribute('disabled', '');

             document.getElementById("cvc").required = false;
             document.getElementById("cvc").innerText = "";
             document.getElementById("cvc").setAttribute('disabled', '');
        }

        var card = document.getElementById("radio_card");
        card.onclick => {
             document.getElementById("card_holder").required = true;
             document.getElementById("card_holder").removeAttribute('disabled');

             document.getElementById("card_number").required = true;
             document.getElementById("card_number").removeAttribute('disabled');

             document.getElementById("expiry_date").required = true;
             document.getElementById("expiry_date").removeAttribute('disabled');

             document.getElementById("cvc").required = true;
             document.getElementById("cvc").removeAttribute('disabled');
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
        <div class="cart_payment">
            <h1>Shopping cart</h1>
            <?php
                $i = -1;
                foreach($_SESSION['cart'] as $ITEM) {
                    $i++;

                    $sql = "SELECT * FROM Product WHERE id = " . $ITEM;
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<div class='mealkit_cart'>";
                        echo        "<img src='" . $row['productimgurl'] . "' class='meal_pic'>";
                        echo        "<p class='mealkit_title'>" . $row['productname'] . "</p>";
                        echo        "<p class='mealkit_price'>₱" . $row['productprice'] . "</p>";
                        echo        "<form method='post'>";
                        echo        "<div class='button_remove'>";
                        echo            "<input type='hidden' name='cartIndex' value='" . $i . "'>";
                        echo            "<input type='submit' name='submitRemove' value='Remove'>";
                        echo        "</div>";
                        echo        "</form>";
                        echo "</div>";

                        $totalPrice += $row['productprice'];
                    }
                }
            ?>
            <p class="mealkit_total">Total:</p>
            <p id="totalPrice" class="mealkit_totalprice">₱
                <?php
                    echo $totalPrice;
                ?>
            </p>
            <h3>Payment method</h3>
            <label class="method_radio" for="method_cod">
                <input type="radio" class="radio_input" name="method_cod" id="radio_cod">
                &nbspCash on Delivery
            </label>
            <label class="method_radio" for="method_card">
                <input type="radio" class="radio_input" name="method_card" id="radio_card">
                &nbspDebit / Credit Card
            </label>
            <br><br>
            <label class="label">Coupon Code:</label>
            <?php
                echo "<input type='text' class='input' name='coupon' onkeyup='checkCoupon(this.value, $totalPrice)'>";
            ?>
            <p id="couponValidity" style="position: relative; float: right; margin-right: 12%;"></p>
        </div>
    </div>
    <div class="wrapper">
        <div class="payment">
            <h2>Payment Information</h2>
            <form method="post">
                <div class="form">
                    <div class="card space icon-relative">
                        <label class="label">Card holder:</label>
                        <input type="text" class="input" id="card_holder" placeholder="Name">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </div>
                    <div class="card space icon-relative">
                        <label class="label">Card number:</label>
                        <input type="text" class="input" id="card_number" onkeyup="checkCard(this.value)" placeholder="Card Number">
                        <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                    </div>
                    <label style="text-align: center" id="cardValidity" class="label"></label>
                    <div class="card_info space">
                        <div class="card_data icon-relative">
                            <label class="label">Expiration Date:</label>
                            <input type="text" class="input" id="expiry_date" placeholder="00 / 00">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                        </div>
                        <div class="card_data icon-relative">
                            <label class="label">CVV:</label>
                            <input type="text" class="input" id="cvc" placeholder="00 / 00">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="button_pay">
                        <input type="submit" name="pay" value="Pay">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="footer">
        Copyright &copy; 2022 <a href="index.php">Filipino Meal Kits.</a> Rights Reserved. <br>
        <a href="mailto:fmk@filipinomealkits.com">fmk@filipinomealkits.com</a>
        <p> <a href="termsandconditions.php">Terms and Conditions.</a>&nbsp&nbsp&nbsp&nbsp<a href="termsandconditions.php">Privacy Policy.</a></p>
    </div>
</body>
</html>

<?php
    if (isset($_POST['submitRemove'])) { 
        echo "<script>console.log('a');</script>";

        unset($_SESSION['cart'][$_POST['cartIndex']]);
        echo "<script>window.location.href='payment.php'</script>";
    }

    if (isset($_POST['pay'])) {
        date_default_timezone_set('Asia/Manila');
        $orderId += 1;

        $sql = "INSERT INTO Orders(custId, orderDate, orderStatus)
                VALUES (" . $_SESSION['id'] . ", '" . date("Y-m-d") . "', 0)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        foreach($_SESSION['cart'] as $ITEM) {
            $sql = "INSERT INTO OrderCart(productId, orderId)
                    VALUES (" . $ITEM . ", " . $orderId . ")";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        }

        echo "<script>alert('Order successful!');</script>";
        echo "<script>window.location.href='inventory.php'</script>";
    }
?>