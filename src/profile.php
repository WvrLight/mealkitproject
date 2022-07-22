<?php include ('db.php')?>

<!DOCTYPE html>
<html>
    <head>
        <meta content='text/html;charset=utf-8'/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile Page</title>
        <link href="assets/css/styles_responsive.css" type="text/css" rel="stylesheet">
		<link href="assets/css/styles.css" type="text/css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
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
		<br><br><br><br><br><br>
		
		<div class="profile">
			<h2> Juan Dela Cruz</h2><br>
			<p>Delivery Address: 26 Katarungan Street, Santolan, Pasig City</p>
			<p>Contact Number: 09932341238</p>
			<div>
				<a href="#profileEdit" class="button">Edit</a><br>	
			</div>
		</div>
		
		<div id="profileEdit" class="overlayEdit">
				<div class="popupEdit">
					  <h2>Editing my profile</h2>
						<a class="close" href="#">×</a>
					  <div class="content">
						<label> Name:</label>
							<input type="text" name="userName" class="prodContent"/><br>
						<label> Delivery address:</label>
							<textarea name="userAddr" class="textareaDesc" rows="4"> </textarea><br>
						<label> Contact number:</label>
							<input type="text" name="userNum" class="prodContent"/><br><br><br>
						<div align="right" style="margin-right: 30px">
							<input type="submit" name="submit" value="Update" class="loginbtn">
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