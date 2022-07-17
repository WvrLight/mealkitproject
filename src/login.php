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
            <img class="logo" src="assets/img/logo.png" id="Logo" alt="Meal Kit Logo">
            <ul class="home">
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="inventory.html">Subscriptions</a></li>
                <li><a href="contact.html">Contact Us</a></li>
            </ul>
            <ul class="login">
				<li><a href="paymentpage.html"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbspCart</a></li>
                <li><a href="login.html">Log In </a></li>
                <li><a href="signup.html">Sign Up </a></li>
            </ul>
        </div>
		<br><br><br><br><br><br><br><br>
        <form method="post" name="login-form">
			<fieldset class="login-form">
                <div>
                    <h1 align="center"> Login Form </h1>
                        <i class="fa fa-user icon"></i>
                            <input type="text" class="username-login" name="username" placeholder="Enter Username" required><br><br>
                        <i class="fa fa-key icon"></i>
                            <input type="password" class="pass-login" name="password" placeholder="Enter Password" required><br><br>
                        <p><a href="signup.html" class="signuplink">Don't have an account?</a> 
                        <br>
                        <div align="right">
                            <input type='submit' class="loginbtn" name='submitBtn' value='Login' />
                            <input type='reset' class="clearbtn" name='resetBtn' value='Reset'/>
                        </div>
                </div>
			</fieldset>
        </form>
        <div id="footer">
            Copyright &copy; 2022 <a href="index.html">Filipino Meal Kits.</a> Rights Reserved. <br>
            <a href="mailto:fmk@filipinomealkits.com">fmk@filipinomealkits.com</a>
            <p> <a href="termsandconditions.html">Terms and Conditions.</a>&nbsp&nbsp&nbsp&nbsp<a href="privacypolicy.html">Privacy Policy.</a></p>
        </div>
    </body>
</html>

<?php
    if (isset($_POST['username'], $_POST['password'])) {
		$sql = "SELECT * FROM Customer WHERE custUsername = '" . $_POST['username'] . "' AND custPassword = '" . $_POST['password'] . "'";
		$stmt = $pdo->prepare($sqluser);
		$stmt->execute();
		$check = stmt->rowCount();
        echo ("<script>console.log('" . $check . "');</script>");

		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if ($check == 1)
		{
            session_start();
			$_SESSION['id'] = $check['id'];
			$_SESSION['username']= $_POST['username'];
            $_SESSION['cart'] = array();
			echo "<script>alert('Login successful!');</script>";
			echo "<script>window.location.href='inventory.php'</script>";

			if ($data['isadmin'] == true) {
				$_SESSION['isadmin'] = true;
			}
		}
		else {
			echo "<script>alert('Incorrect login details.');</script>";
			echo "<script>window.location.href='login.php'</script>";		
		}
	}
?>