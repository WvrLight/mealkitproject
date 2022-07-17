<?php include ('db.php')?>
<?php 
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta content='text/html;charset=utf-8'/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" type="text/css" href="assets/css/payment_style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">

</head>
<body>
    <div class="nav">
        <img class="logo" src="assets/css/logo.png" id="MealKitLogo" alt="Meal Kit Logo">
        <ul class="home">
            <li><a href="index.php">Home</a></li>
            <li><a href="inventory.php">Meal Kits</a></li>
            <li><a href="contact.html">Contact Us</a></li>
            <li><a href="about.html">About Us</a></li>
        </ul>
        <ul class="login">
            <li><a href="payment.html"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbspCart</a></li>
            <li><a href="login.html">Log In </a></li>
            <li><a href="signup.html">Sign Up </a></li>
        </ul>
    </div>
    <div class="cart-wrapper">
        <div class="cart_payment">
            <h1>Shopping cart</h1>
            <?php
                $totalPrice = 0.0;

                foreach($_SESSION['cart'] as $ITEM) {
                    $sql = "SELECT * FROM Product WHERE id = " . $ITEM;
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<div class='mealkit_cart'>";
                        echo        "<img src='" . $row['productimgurl'] . "' class='meal_pic'>";
                        echo        "<p class='mealkit_title'>" . $row['productname'] . "</p>";
                        echo        "<p class='mealkit_price'>₱" . $row['productprice'] . "</p>";
                        echo "</div>";

                        $totalPrice += $row['productprice'];
                    }
                }
                
            ?>
            <p class="mealkit_total">Total:</p>
            <p class="mealkit_totalprice">₱
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
        </div>
    </div>
    <div class="wrapper">
        <div class="payment">
            <h2>Payment Information</h2>
            <div class="form">
                <div class="card space icon-relative">
                    <label class="label">Card holder:</label>
                    <input type="text" class="input" name="card_holder" placeholder="Juan Dela Cruz">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
                <div class="card space icon-relative">
                    <label class="label">Card number:</label>
                    <input type="text" class="input" name="card_number" placeholder="Card Number">
                    <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                </div>
                <div class="card_info space">
                    <div class="card_data icon-relative">
                        <label class="label">Expiration Date:</label>
                        <input type="text" class="input" name="expiry_date" placeholder="00 / 00">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                    </div>
                    <div class="card_data icon-relative">
                        <label class="label">CVV:</label>
                        <input type="text" class="input" name="cvc" placeholder="00 / 00">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="button_pay">
                    <input type="submit" value="Pay">
                </div>
            </div>
        </div>
    </div>


    <div id="footer">
        Copyright &copy; 2022 <a href="index.html">Filipino Meal Kits.</a> Rights Reserved. <br>
        <a href="mailto:fmk@filipinomealkits.com">fmk@filipinomealkits.com</a>
        <p> <a href="termsandconditions.html">Terms and Conditions.</a>&nbsp&nbsp&nbsp&nbsp<a href="privacypolicy.html">Privacy Policy.</a></p>
        
    </div>	


</body>


</html>