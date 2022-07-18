<?php 
	session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta content='text/html;charset=utf-8'/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Filipino Meal Kits</title>
        <link href="assets/css/styles.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <div class="nav">
            <img class="logo" src="assets/img/logo.png" id="Meal Kit Logo" alt="Meal Kit Logo">
            <ul class="home">
                <li><a href="index.php">Home</a></li>
                <li><a href="inventory.php">Meal Kits</a></li>
                <li><a href="contact.html">Contact Us</a></li>
                <li><a href="about.html">About Us</a></li>
            </ul>
            <ul class="login">
                <li><a href="payment.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbspCart</a></li>
                <?php
                    if (isset($_SESSION['id'])) {
                        echo "<li><a href='profile.php'>View Profile</a></li>
                        <li><a href='logout.php'>Logout</a></li>";
                    }
                    else {
                        echo "<li><a href='login.php'>Log In</a></li>
                        <li><a href='signup.php'>Sign Up</a></li>";
                    }
                ?>
            </ul>
        </div>
        <div class="header">
            <div class="headertext">
                <h1>Filipino <br> Meal Kits</h1>
                <p><i>Hassle-free meal planning <br> right at your doorstep.</i></p>
                <a href="login.php" class="btn">GET STARTED! &#8594;</a>
            </div>
            
        </div>
        <div class="content">
           About Us
        </div>
        <div id="footer">
            Copyright &copy; 2022 <a href="index.html">Filipino Meal Kits.</a> Rights Reserved. <br>
            <a href="mailto:fmk@filipinomealkits.com">fmk@filipinomealkits.com</a>
            <p> <a href="termsandconditions.html">Terms and Conditions.</a>&nbsp&nbsp&nbsp&nbsp<a href="privacypolicy.html">Privacy Policy.</a></p>
            
        </div>
    </body>