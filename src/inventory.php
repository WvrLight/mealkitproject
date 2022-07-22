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
		<script>
			function viewProduct(id) {
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						var view = document.getElementById('formView');
						view.innerHTML = this.responseText;
						view.style.visibility = 'visible';
						view.style.opacity = 1;
					}
				};
				xmlhttp.open("GET", "inventoryview.php?id=" + id, true);
				xmlhttp.send();
			}

			function editProduct(id) {
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						var view = document.getElementById('formEdit');
						view.innerHTML = this.responseText;
						view.style.visibility = 'visible';
						view.style.opacity = 1;
					}
				};
				xmlhttp.open("GET", "inventoryedit.php?id=" + id, true);
				xmlhttp.send();
			}

			function closeView(elementId) {
				var element = document.getElementById(elementId);
				element.style.visibility = 'hidden';
				element.style.opacity = 0;
			}
		</script>
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
									echo("<input type='hidden' class='productID' name='productId' value='" . $row['id'] . "'>");
									echo("<h2 class='product-brand'>" . $row['productname'] . "</h2>");
									if ($row['productsaleprice'] == null) {
										echo("<p class='price'>₱" . $row['productprice'] . "</p>");	
									}
									else {
										echo("<p class='old-price'>₱" . $row['productprice'] . "</p>");
										echo("<p class='price'>₱" . $row['productsaleprice'] . "</p>");
									}
									echo "</div>";
									echo "<div class='view'>
									<input type='button' class='button' name='view' value='View' onclick='viewProduct(" . $row['id'] . ")'>
									<input type='submit' class='button' name='addtocart' value='Add to Cart'>";
									if (isset($_SESSION['isadmin'])) {
										echo "<input type='button' class='button' name='edit' value='Edit' onclick='editProduct(" . $row['id'] . ")'>
										<input type='submit' class='button' name='remove' value='Remove'>";
									}
								echo "</div>";
							echo "</fieldset>
						</form>";
					}
				?>
			</div>
			<div id="formEdit" class="overlayEdit">
			<form method="post">
				<div class="popupEdit">
					  <h2>Editing MEAL-KIT</h2>
						<input type='button' class='close' name='close' value='×' onclick="close('formEdit')">>
					  <div class="content">
						<input type='hidden' class='productID' name='productId' value=''>
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
							<input type="submit" name="submitEdit" value="Update" class="loginbtn">
						</div>
					  </div>
				</div>
			</form>
			</div>
			<div id="formAdd" class="overlayAdd">
				<form method='post'>
				<div class="popupAdd">
					  <h2>Add new MEAL-KIT</h2>
						<a class="close" href="#">×</a>
					  <div class="content">
						<label>Product Name:</label>
							<input type="text" name="productName" placeholder="--Enter New Product Name--" class="prodContent" required/><br>
						<label>Product Description:</label>
							<textarea name="productDesc" class="textareaDesc" rows="4" required> </textarea><br>
						<label>Product Image URL:</label>
							<input type="text" name="productImg" placeholder="--Enter Url--" class="prodContent" required/><br>
						<label>Product Price:</label>
							<input type="text" name="productPrice" placeholder="--Enter Original Price--" class="prodContent" required/><br>
						<label>Product Sale Price:</label>
							<input type="text" name="productSale" placeholder="--Enter Discounted Price--" class="prodContent"/><br>
						<label>Product Sale Date:</label>
							<input type="date" name="saleDate" class="prodContent"><br><br><br>
						<div align="right" style="margin-right: 30px">
							<input type="submit" name="submitAdd" value="Add" class="loginbtn">
							<input type='reset' class="clearbtn" name='resetBtn' value='Clear'/>
						</div>
					  </div>
				</div>
				</form>
			</div>
			<div id="formView" class="overlayView">
				<div class="popupView">
					<input type='button' class='close' name='close' value='×' onclick="close('formView')">
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

<?php
	echo ("<script>
			var count = document.getElementById('cart-num');
			count.innerText = '" . count($_SESSION['cart']) . "';
		</script>");
?>

<?php
	if (isset($_POST['addtocart'])) {
		if (isset($_SESSION['id'])) {
			array_push($_SESSION['cart'], $_POST['productId']);

			echo ("<script>
				var count = document.getElementById('cart-num');
				count.innerText = '" . count($_SESSION['cart']) . "';
			</script>");
		}
		else {
			echo "<script>window.location.href='login.php'</script>";
		}
	};

	if (isset($_POST['submitEdit'])) {
		if (isset($_POST['productSale'])) {
			$salePrice = $_POST['productSale'];
		}
		else {
			$salePrice = "NULL";
		}

		$pattern = "^[0-9]{4}-(((0[13578]|(10|12))-(0[1-9]|[1-2][0-9]|3[0-1]))|(02-(0[1-9]|[1-2][0-9]))|((0[469]|11)-(0[1-9]|[1-2][0-9]|30)))$";
		$date = $_POST['saleDate'];

		if (!preg_match($pattern, $date)) {
			$saleEndDate = "'" . $date . "'";
		}
		else {
			$saleEndDate = "NULL";
		}

		echo "<script>console.log(" . $_POST['saleDate'] . ")</script>";
		echo "<script>console.log(" . $saleEndDate . ")</script>";
		$sql = "UPDATE Product
				SET productName = '" . $_POST['productName'] . "',
					productDesc = '" . $_POST['productDesc'] . "',
					productImgUrl = '" . $_POST['productImg'] . "',
					productPrice = " . $_POST['productPrice'] . ",
					productSalePrice = " . $salePrice . ",
					productSaleEnd = " . $saleEndDate . "
				WHERE id = " . $_POST['productId'];
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

		header("Refresh:0");
	}

	if (isset($_POST['submitAdd'])) {
		if (isset($_POST['productSale'])) {
			$salePrice = $_POST['productSale'];
		}
		else {
			$salePrice = "NULL";
		}

		$pattern = "^[0-9]{4}-(((0[13578]|(10|12))-(0[1-9]|[1-2][0-9]|3[0-1]))|(02-(0[1-9]|[1-2][0-9]))|((0[469]|11)-(0[1-9]|[1-2][0-9]|30)))$";
		$date = $_POST['saleDate'];

		if (preg_match($pattern, $date)) {
			$saleEndDate = "'" . $date . "'";
		}
		else {
			$saleEndDate = "NULL";
		}

		echo "<script>console.log($saleEndDate)</script>";
		$sql = "INSERT INTO Product(productName, productDesc, productImgUrl, productPrice, productSalePrice, productSaleEnd)
				VALUES('" . $_POST['productName'] . "', '" . $_POST['productDesc'] . "', '" . $_POST['productImg'] . "', " . $_POST['productPrice'] . ", " . $salePrice . ", " .  $saleEndDate . ")";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

		header("Refresh:0");
		echo "<script>console.log('b')</script>";
	}
?>