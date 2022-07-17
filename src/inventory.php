<?php include ('db.php')?>

<!DOCTYPE html>
<html>
    <head>
        <meta content='text/html;charset=utf-8'/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Meal-kit Shop</title>
        <link href="assets/css/styles_responsive.css" type="text/css" rel="stylesheet">
		<link href="assets/css/styles.css" type="text/css" rel="stylesheet">
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
                <li><a href="login.html">Log In </a></li>
                <li><a href="signup.html">Sign Up </a></li>
            </ul>
        </div>
	
		<div class="wholecontainer">
			<br><br><br><br><br><br><br><b>
			<div> <h1> Subscription Package 1 = Php 1099</h1>
			</div>
			<
			<div class="product-container">
				<form method="post" onsubmit="fnCheck(event)">
				<?php
					$sql = 'SELECT * FROM Product';
					$stmt = $pdo->prepare($sql);
					$stmt->execute();
					$rowCount = $stmt->rowCount();

					while($row = pg_fetch_array($stmt)) {
					// This will loop through each row, now use your loop here
						echo "<p>" . $row['productName'];
					}
				?>
				<fieldset class="product-card">
						<img src="assets/img/pinakbet.jpg" class="product-thumb" alt="">
					<div class="product-info">
						<input type="hidden" class="productID" value="Product ID here">
						<h2 class="product-brand">Pinakbet Meal-kit</h2>
						<p class="price">Php 190.00 </p>
						<p class="old-price">Php 210.00 </p>
					</div>
					<div class="view">
						<a href="subscribing.html" class="button">View</a>
					</div>
				</fieldset>
				</form>
			</div>
		</div>
		
		<div id="footer">
            Copyright &copy; 2022 <a href="index.html">Filipino Meal Kits.</a> Rights Reserved. <br>
            <a href="mailto:fmk@filipinomealkits.com">fmk@filipinomealkits.com</a>
            <p> <a href="termsandconditions.html">Terms and Conditions.</a>&nbsp&nbsp&nbsp&nbsp<a href="privacypolicy.html">Privacy Policy.</a></p>
            
        </div>	
		
    </body>
</html>