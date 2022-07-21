<?php include ('db.php')?>
<?php 
	session_start();
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
                <li><a href="index.php">Home</a></li>
                <li><a href="inventory.php">Meal Kits</a></li>
                <li><a href="about.html">About Us</a></li>
            </ul>
            <ul class="login">
            	<?php
                    if (isset($_SESSION['id'])) {
                        echo "<li><a href='payment.php'><i class='fa fa-shopping-cart' aria-hidden='true'></i>&nbspCart</a></li>
                        <li><a href='profile.php'>View Profile</a></li>
                        <li><a href='logout.php'>Logout</a></li>";
                    }
                    else {
                        echo "<li><a href='login.php'>Log In</a></li>
                        <li><a href='signup.php'>Sign Up</a></li>";
                    }
                ?>
            </ul>
        </div>
		<div class="wholecontainer">
			<div class="product-header">
				<?php
					if (isset($_SESSION['isadmin'])) {
						echo "<a href='#formAdd' class='button1'>+</a>";
					}
				?>
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
									if ($row['productsaleprice'] == null) {
										echo("<p class='price'>₱" . $row['productprice'] . "</p>");	
									}
									else {
										echo("<p class='price'>₱" . $row['productsaleprice'] . "</p>");
										echo("<p class='old-price'>₱" . $row['productprice'] . "</p>");
									}
									echo "</div>";
									echo "<div class='view'>
									<input type='button' class='button' name='view' value='View' onclick='view(" . $row['id'] . ")'>
									<input type='submit' class='button' name='addtocart' value='Add to Cart'>";
									if (isset($_SESSION['isadmin'])) {
										echo "<input type='submit' class='button' name='edit' value='Edit'>
										<input type='submit' class='button' name='remove' value='Remove'>";
									}
								echo "</div>";
							echo "</fieldset>
						</form>";
					}
				?>
			</div>
			<div id="formEdit" class="overlayEdit">
				<div class="popupEdit">
					  <h2>Editing MEAL-KIT</h2>
						<a class="close" href="#">×</a>
					  <div class="content">
						<label>Product Name:</label>
							<input type="text" name="productName" class="prodContent"/><br>
						<label>Product Description:</label>
							<textarea name="productDesc" class="textareaDesc" rows="4"> </textarea><br>
						<label>Product Image URL:</label>
							<input type="text" name="productImg" class="prodContent"/><br>
						<label>Product Price:</label>
							<input type="text" name="productPrice" class="prodContent"/><br>
						<label>Product Sale Price:</label>
							<input type="text" name="productSale" class="prodContent"/><br>
						<label>Product Sale Date:</label>
							<input type="date" name="saleDate" class="prodContent"><br><br><br>
						<div align="right" style="margin-right: 30px">
							<input type="submit" name="submit" value="Update" class="loginbtn">
						</div>
					  </div>
				</div>
			</div>
			<div id="formAdd" class="overlayAdd">
				<div class="popupAdd">
					  <h2>Add new MEAL-KIT</h2>
						<a class="close" href="#">×</a>
					  <div class="content">
						<label>Product Name:</label>
							<input type="text" name="productName" placeholder="--Enter New Product Name--" class="prodContent"/><br>
						<label>Product Description:</label>
							<textarea name="productDesc" class="textareaDesc" rows="4"> </textarea><br>
						<label>Product Image URL:</label>
							<input type="text" name="productImg" placeholder="--Enter Url--" class="prodContent"/><br>
						<label>Product Price:</label>
							<input type="text" name="productPrice" placeholder="--Enter Original Price--" class="prodContent"/><br>
						<label>Product Sale Price:</label>
							<input type="text" name="productSale" placeholder="--Enter Discounted Price--" class="prodContent"/><br>
						<label>Product Sale Date:</label>
							<input type="date" name="saleDate" class="prodContent"><br><br><br>
						<div align="right" style="margin-right: 30px">
							<input type="submit" name="submit" value="Add" class="loginbtn">
							<input type='reset' class="clearbtn" name='resetBtn' value='Clear'/>
						</div>
					  </div>
				</div>
			</div>
			<div id="formView" class="overlayView">
				<div class="popupView">
					<a class="close" href="#">×</a>
					  <div class="viewProduct">
						<img id="viewProductUrl" src="assets/img/pinakbet.jpg" class="viewPic"/>
						<div class="viewDesc">
							<h2 id="viewProductName">Pinakbet Meal-kit</h2>
							<h5 id="viewProductSaleDate">Sale until 07/25/22</h5>
							<div class="prices">
								<p id="viewProductOldPrice"class="old-price">Php 210.00 </p>
								<p id="viewProductPrice" class="price">Php 190.00 </p>
							</div>
							<h3> Description: </h3>
							<p id="viewProductDesc" class="paraTxt"> </p>
						</div>
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

<script>
	function ViewProduct(id) {
		
	}

<?php
	echo ("<script>
			var count = document.getElementById('cart-num');
			count.innerText = '" . count($_SESSION['cart']) . "';
		</script>");
?>

<?php
	if (isset($_POST['addtocart'])) {
		array_push($_SESSION['cart'], $_POST['productId']);

		echo ("<script>
			var count = document.getElementById('cart-num');
			count.innerText = '" . count($_SESSION['cart']) . "';
		</script>");
	};

	function view($id) {
		echo "<script>console.log('a')</script>";
		echo "<script>console.log('" . $id . "')</script>";
		$sql = "SELECT * FROM Product WHERE productId = " . $id;
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			echo "<script>document.getElementById('viewProductName').innerHTML = '" . $row['productname'] . "'</script>";
			echo "<script>document.getElementById('viewProductDesc').innerHTML = '" . $row['productdesc'] . "'</script>";
			echo "<script>document.getElementById('viewProductUrl').innerHTML = '" . $row['productimgurl'] . "'</script>";
			echo "<script>document.getElementById('viewProductSaleDate').innerHTML = '" . $row['productsaleend'] . "'</script>";

			if ($row['productsaleprice'] == null) {
				echo "<script>document.getElementById('viewProductOldPrice').innerHTML = ''</script>";
				echo "<script>document.getElementById('viewProductPrice').innerHTML = '" . $row['productprice'] . "'</script>";
			}
			else {
				echo "<script>document.getElementById('viewProductOldPrice').innerHTML = '" . $row['productprice'] . "'</script>";
				echo "<script>document.getElementById('viewProductPrice').innerHTML = '" . $row['productsaleprice'] . "'</script>";
			}
		}

		echo "<script>
			var view = document.getElementById('formView');
			view.focus();
		</script>";
	}
?>