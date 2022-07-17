<?php include ('db.php')?>
<?php 
	session_start(); 
	$cart = array();
	$_SESSION['cart'] = $cart;

	if (isset($_POST['productId'])) {
		echo ("<script>console.log('id -');</script>");
		echo ("<script>console.log('" . $_POST['productId'] . "');</script>");
		$cart[] = $_POST['productId'];
		$_SESSION['cart'] = $cart;
		unset($_POST['productId']);

		echo ("<script>
			document.getElementbyId('cart-num'>.innerText = '" . count($_SESSION['cart']) . "';
		</script>");
	};
?>

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
			<div class="product-header">
				<a href="" class="product-cart"><img src="assets/img/cart.png"></a>
				<p id="cart-num" class="cart-count">0</p>
				<h1>Products</h1>
			</div>
			<div class="card-container">
				<?php
					$sql = 'SELECT * FROM Product';
					$stmt = $pdo->prepare($sql);
					$stmt->execute();

					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
						echo "<form method='post'>
							<fieldset class='product-card'>";
								echo("<img src=" . $row['productimgurl'] . " class='product-thumb' alt=''>");
								echo "<div class='product-info'>";
									echo("<input type='hidden' class='productID' name='productId' value='" . $row['id'] . "'");
									echo("<h2 class='product-brand'>" . $row['productname'] . "</h2>");
									echo("<p class='price'>Php " . $row['productprice'] . "</p>");
									echo "</div>";
									echo "<div class='view'>
									<input type='submit' class='button' value='Add to Cart'>
								</div>";
							echo "</fieldset>
						</form>";
					}
				?>
			</div>
		</div>
		
		<div id="footer">
            Copyright &copy; 2022 <a href="index.html">Filipino Meal Kits.</a> Rights Reserved. <br>
            <a href="mailto:fmk@filipinomealkits.com">fmk@filipinomealkits.com</a>
            <p> <a href="termsandconditions.html">Terms and Conditions.</a>&nbsp&nbsp&nbsp&nbsp<a href="privacypolicy.html">Privacy Policy.</a></p>
        </div>	
		
    </body>
</html>