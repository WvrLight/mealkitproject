<?php include ('db.php')?>
<?php
    session_start();

    if (isset($_SESSION['id'])) {
        echo "<script>window.location.href='profile.php'</script>";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta content='text/html;charset=utf-8'/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Page</title>
        <link href="assets/css/styles_responsive.css" type="text/css" rel="stylesheet">
		<link href="assets/css/styles.css" type="text/css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body style="background-image: url('assets/img/background.png'); background-size: 100% 100%; background-repeat: no-repeat; object-fill: cover;">
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
		<br><br><br><br><br><br><br><br>
        <form method="post" name="login-form">
			<fieldset class="login-form">
                <div>
                    <h1 align="center"> Login Form </h1>
                        <i class="fa fa-user icon"></i>
                            <input type="text" class="username" name="username" placeholder="Enter Username" required><br><br>
                        <i class="fa fa-key icon"></i>
                            <input type="password" class="password" name="password" placeholder="Enter Password" required><br><br>
                        <p><a href="register.php" class="signuplink">Don't have an account?</a> 
                        <br>
                        <div align="right">
                            <input type='submit' class="loginbtn" name='submitBtn' value='Login' />
                            <input type='reset' class="clearbtn" name='resetBtn' value='Reset'/>
                        </div>
                </div>
			</fieldset>
        </form>
        <br><br><br><br><br>
        <div id="footer">
            Copyright &copy; 2022 <a href="index.php">Filipino Meal Kits.</a> Rights Reserved. <br>
            <a href="mailto:fmk@filipinomealkits.com">fmk@filipinomealkits.com</a>
            <p> <a href="termsandconditions.php">Terms and Conditions.</a>&nbsp&nbsp&nbsp&nbsp<a href="termsandconditions.php">Privacy Policy.</a></p>
        </div>
    </body>
</html>

<?php
    if (isset($_POST['username'], $_POST['password'])) {
		$sqluser = "SELECT * FROM Customer WHERE custUsername = '" . $_POST['username'] . "'";
		$stmt = $pdo->prepare($sqluser);
		$stmt->execute();
        $loginResult = false;
		
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($_POST['password'], $row['custpassword'])) {
                $loginResult = true;
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['cart'] = array();

                if ($_POST['username'] == "admin") {
                    $_SESSION['isadmin'] = true;
                }
                
                echo "<script>alert('Login successful!');</script>";
                echo "<script>window.location.href='inventory.php'</script>";
		    }
        }

        if (!$loginResult) {
            echo "<script>alert('Incorrect login details.');</script>";
            echo "<script>window.location.href='login.php'</script>";		
        }
	}
?>