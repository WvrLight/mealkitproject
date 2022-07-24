<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta content='text/html;charset=utf-8'/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
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
            <h1>Contact us at:</h1>
            <br><br>
            <h4 class="tracking_receiver"><i class="fa fa-envelope-o" aria-hidden="true"></i>   Email</h4>
            <p class="tracking_name"> fmk@filipinomealkits.com</p>
            <br>
            <h4 class="tracking_receiver"><i class="fa fa-facebook-official" aria-hidden="true"></i>   Facebook</h4>
            <p class="tracking_name"> Filipino Meal Kits</p>
            <br>
            <h4 class="tracking_receiver"><i class="fa fa-instagram" aria-hidden="true"></i>   Instagram</h4>
            <p class="tracking_name"> @filipinomealkits</p>
            <br>
            <h4 class="tracking_receiver"><i class="fa fa-twitter" aria-hidden="true"></i>   Twitter</h4>
            <p class="tracking_name"> @filipinomealkits</p>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <div id="footer">
        Copyright &copy; 2022 <a href="index.php">Filipino Meal Kits.</a> Rights Reserved. <br>
        <a href="mailto:fmk@filipinomealkits.com">fmk@filipinomealkits.com</a>
        <p> <a href="termsandconditions.php">Terms and Conditions.</a>&nbsp&nbsp&nbsp&nbsp<a href="termsandconditions.php">Privacy Policy.</a></p>
    </div>
</body>
</html>