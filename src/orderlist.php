<?php include ('db.php')?>
<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        echo "<script>window.location.href='login.php'</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta content='text/html;charset=utf-8'/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking</title>
    <link rel="stylesheet" type="text/css" href="assets/css/payment_style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">

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
                    echo "<li><a href='coupon.php'><i class='fa fa-shopping-cart' aria-hidden='true'></i>&nbspCoupon List</a></li>";
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
    <div class="cart-wrapper">
        <?php
            $sql = "SELECT * FROM Orders";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='cart_payment'>
                    <h4 class='tracking_receiver'><i class='fa fa-address-card-o' aria-hidden='true'></i> Receiver</h4>";

                $sqluser = "SELECT * FROM Customer WHERE id = " . $row['custid'];
                $stmtuser = $pdo->prepare($sqluser);
                $stmtuser->execute();

                while ($rowuser = $stmtuser->fetch(PDO::FETCH_ASSOC)) {
                    echo "<p class='tracking_name'>" . $rowuser['custfullname'] . "</p>";
                    echo "<p class='tracking_address'>" . $rowuser['custaddress'] . "</p>";
                    echo "<p class='tracking_address'>" . $rowuser['custnumber'] . "</p>";
                }

                $sqlcart = "SELECT * FROM OrderCart WHERE orderId = " . $row['id'];
                $stmtcart = $pdo->prepare($sqlcart);
                $stmtcart->execute();

                while ($rowcart = $stmtcart->fetch(PDO::FETCH_ASSOC)) {
                    $sqlproduct = "SELECT * FROM Product WHERE id = " . $rowcart['productid'];
                    $stmtproduct = $pdo->prepare($sqlproduct);
                    $stmtproduct->execute();

                    while ($rowproduct = $stmtproduct->fetch(PDO::FETCH_ASSOC)) {
                        echo "
                            <div class='mealkit_cart'>
                                <img src='" . $rowproduct['productimgurl'] . "' class='meal_pic'>
                                <p class='mealkit_title'>" . $rowproduct['productname'] . "</p>";
                        if ($rowproduct['productsaleprice'] == null) {
                            echo "<p class='mealkit_price'>" . $rowproduct['productprice'] . "</p>";
                        }
                        else {
                            echo "<p class='mealkit_price'>" . $rowproduct['productsaleprice'] . "</p>";
                        }
                        echo "</div>";
                    }
                }

                echo "<div id='tracking_section" . $row['id'] . "'>";
                switch ($row['orderStatus']) {
                    case 0:
                        echo "<p class='tracking_prepared'><i class='fa fa-tasks' aria-hidden='true'></i>&nbsp&nbspThe parcel is being prepared. </p>";
                        break;
                    case 1:
                        echo "<p class='tracking_out'><i class='fa fa-tasks' aria-hidden='true'></i>&nbsp&nbspThe parcel is out for delivery. </p>";
                        break;
                    case 2:
                        echo "<p class='tracking_delievered'><i class='fa fa-tasks' aria-hidden='true'></i>&nbsp&nbspThe parcel is delivered. </p>";
                        break;
                }
                echo "</div>
                </div>";
            }
        ?>
        <div class='cart_payment'>;
            <h1>Tracking Page</h1>
            <h4 class="tracking_receiver"><i class="fa fa-address-card-o" aria-hidden="true"></i> Receiver</h4>
            <p class="tracking_name"> Juan Dela Cruz</p>
            <p class="tracking_address"> 35 Masagana St. Quezon City</p>

            <h4 class="tracking_items">Item list</h4>
            <div class="mealkit_cart">
                <img src="assets/img/pinakbet.jpg" alt="Pinakbet"  class="meal_pic">
                <p class="mealkit_title"> Pinakbet Meal-kit</p>
                <p class="mealkit_price"> ₱190.00</p>  
            </div>
            <div class="mealkit_cart">
                <img src="assets/img/tinola.jpg" alt="Tinola"  class="meal_pic">
                <p class="mealkit_title"> Tinola Meal-kit</p>
                <p class="mealkit_price"> ₱260.00</p>  
            </div>
            <div class="mealkit_cart">
                <img src="assets/img/adobo.jpg" alt="Adobo" class="meal_pic">
                <p class="mealkit_title"> Chicken Adobo Meal-kit</p>
                <p class="mealkit_price"> ₱200.00</p>  
            </div>
            <p class="mealkit_total">Total:</p>
            <p class="mealkit_totalprice"> ₱650.00</p>
            <h3 class="tracking_status">Status: </h3>
            <div id="tracking_section">
                <p class="tracking_prepared"><i class="fa fa-tasks" aria-hidden="true"></i>&nbsp&nbspThe parcel is being prepared. </p>
                <p class="tracking_out"><i class="fa fa-truck" aria-hidden="true"></i>&nbsp&nbspThe parcel is out for delivery. </p>
                <p class="tracking_delivered"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp&nbspThe parcel is delivered. </p>
            </div>
    </div>
    <div id="footer">
        Copyright &copy; 2022 <a href="index.html">Filipino Meal Kits.</a> Rights Reserved. <br>
        <a href="mailto:fmk@filipinomealkits.com">fmk@filipinomealkits.com</a>
        <p> <a href="termsandconditions.html">Terms and Conditions.</a>&nbsp&nbsp&nbsp&nbsp<a href="privacypolicy.html">Privacy Policy.</a></p>
        
    </div>	


</body>


</html>