<?php include ('db.php')?>

<!DOCTYPE html>
<html>
    <head>
        <meta content='text/html;charset=utf-8'/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up Page</title>
        <link href="assets/css/styles_responsive.css" type="text/css" rel="stylesheet">
		<link href="assets/css/styles.css" type="text/css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body style="background-color: gray;">
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
                        echo "<li><a href='orderlist.php'><i class='fa fa-shopping-cart' aria-hidden='true'></i>&nbspOrders</a></li>";
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
        <div style="background-size: cover; background-image: url('assets/img/background.png'); background-repeat: no-repeat;">
		<br><br><br><br><br><br><br><br>
            <fieldset class="signup-form">
            <form method="post" onsubmit="fnCheck(event)" name="signup-form">
                    <div>
                        <h1 align="center"> Signup Form </h1>
                    <p>Please fill in this form to create an account.</p><br>
                    
                    
                    <label for="fname"><b>Full Name:</b></label> <br>
                    <input type="text" placeholder="Enter Full Name" name="fname" class="signupbox" required> <br>
    
                    <label for="username"><b>Username:</b></label> <br>
                    <input type="text" placeholder="Enter Username" name="uname" class="signupbox" required> <br>
    
                    <label for="email"><b>Email:</b></label> <br>
                    <input type="text" placeholder="Enter Email" class="signupbox" name="email" required> <br>
    
                    <label for="cnum"><b>Contact Number:</b></label> <br>
                    <input type="tel" placeholder="Enter Contact Number" name="cnum" class="signupbox" required> <br>
    
                    <label for="address"><b>Delivery Address:</b></label> <br>
                    <input type="text" placeholder="Enter Delivery Address" class="signupbox" name="address" required> <br>
                
                    <label for="psw"><b>Password:</b></label> <br>
                    <input type="password" placeholder="Enter Password" name="psw" class="signupbox" required> <br>
                
                    <label for="psw-repeat"><b>Repeat Password:</b></label> <br>
                    <input type="password" placeholder="Repeat Password" name="psw-repeat" class="signupbox" required> <br>
                
                    <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p><br>
                
                            <div align="right">
                                <input type='submit' class="loginbtn" name='register' value='Register'/>
                                <input type='reset' class="clearbtn" name='resetBtn' value='Reset'/>
                            </div>
                    </div>	
            </form>
            </fieldset>
            <div id="footer">
                Copyright &copy; 2022 <a href="index.php">Filipino Meal Kits.</a> Rights Reserved. <br>
                <a href="mailto:fmk@filipinomealkits.com">fmk@filipinomealkits.com</a>
                <p> <a href="termsandconditions.php">Terms and Conditions.</a>&nbsp&nbsp&nbsp&nbsp<a href="termsandconditions.php">Privacy Policy.</a></p>
            </div>
        </div>
    </body>
</html>

<?php
    if (isset($_POST['register'])) {
        echo "<script>console.log(" . strcmp($_POST['psw'], $_POST['psw-repeat']) . ")</script>";
        if (!strcmp($_POST['psw'], $_POST['psw-repeat'])) {
            $encrytedPass = password_hash($_POST['psw'], PASSWORD_DEFAULT);

            $sql = "INSERT INTO Customer(custFullName, custUsername, custPassword, custEmail, custAddress, custNumber)
				VALUES('" . $_POST['fname'] . "', '" . $_POST['uname'] . "', '" . $encrytedPass . "', '" . $_POST['email'] . "', '" . $_POST['address'] . "', '" . $_POST['cnum'] . "')";
            $stmt = $pdo->prepare($sql);
            try {
                $stmt->execute();
                echo "<script>alert('Successfully registered. You may now log in.');</script>";
                echo "<script>window.location.href='login.php'</script>";	
            } catch (PDOException $pde) {
                echo "<script>alert('Username already exists.');</script>";
                echo "<script>console.log('" . $pde->getMessage() . "')</script>";
            } catch (Exception $e) {
                echo "<script>alert('Error');</script>";
            }
        }
        else {
            echo "<script>alert('Please enter the correct details.');</script>";
        }
	}
?>