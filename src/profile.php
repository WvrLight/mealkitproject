<?php include ('db.php')?>
<?php 
	session_start();

    if (!isset($_SESSION['id'])) {
        echo "<script>window.location.href='login.php'</script>";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta content='text/html;charset=utf-8'/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile Page</title>
        <link href="assets/css/styles_responsive.css" type="text/css" rel="stylesheet">
		<link href="assets/css/styles.css" type="text/css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script>
			function editProfile(id) {
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						var view = document.getElementById('profileEdit');
						view.innerHTML = this.responseText;
						view.style.visibility = 'visible';
						view.style.opacity = 1;
					}
				};
				xmlhttp.open("GET", "profileedit.php?id=" + id, true);
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
		<br><br><br><br><br><br>
		<div id="profile" class="profile">
			<?php
				$id = $_SESSION['id'];

				$sql = "SELECT * FROM Customer WHERE id = " . $id;
				$stmt = $pdo->prepare($sql);
				$stmt->execute();

				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					echo "
						<h2>" . $row['custfullname'] . "</h2><br>
						<p>Delivery Address: " . $row['custaddress'] . "</p>
						<p>Contact Number: " . $row['custnumber'] . "</p>
						<div align='right'>
							<input type='button' class='button' name='edit' value='Edit' onclick='editProfile(" . $row['id'] . ")'>
						</div>
					";
				}
			?>
		</div>
		
		<div id="profileEdit" class="overlayEdit">
		</div>
		<br><br><br><br><br><br><br><br><br><br>
        <div id="footer">
            Copyright &copy; 2022 <a href="index.php">Filipino Meal Kits.</a> Rights Reserved. <br>
            <a href="mailto:fmk@filipinomealkits.com">fmk@filipinomealkits.com</a>
            <p> <a href="termsandconditions.php">Terms and Conditions.</a>&nbsp&nbsp&nbsp&nbsp<a href="termsandconditions.php">Privacy Policy.</a></p>
        </div>
    </body>
</html>

<?php
	if (isset($_POST['submit'])) {
		$sql = "UPDATE Customer
				SET custFullName = '" . $_POST['fullName'] . "',
					custAddress = '" . $_POST['Address'] . "',
					custNumber = '" . $_POST['Contact'] . "'
				WHERE id = " . $_POST['custId'];
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

		echo "<script>window.location.href='profile.php'</script>";
	}
?>