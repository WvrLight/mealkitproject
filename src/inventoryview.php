<?php include ('db.php')?>
<?php
    $id = $_GET['id'];

    $sql = "SELECT * FROM Product WHERE id = " . $id;
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($row['productsaleprice'] == null) {
            echo "
            <div class='popupView'>
                <input type='button' class='close' name='close' value='×' onclick=" . "closeView('formView')" . ">
                <div class='viewProduct'>
                    <img id='viewProductUrl' src='" . $row['productimgurl'] . "' class='viewPic'/>
                    <div class='viewDesc'>
                        <h2 id='viewProductName'>" . $row['productname'] ."</h2>
                        <h5 id='viewProductSaleDate'>Sale until " . $row['productsaleend'] . "</h5>
                        <div class='prices'>
                            <p id='viewProductPrice' class='price'>Php " . $row['productprice'] . "</p>
                        </div>
                        <h3> Description: </h3>
                        <p id='viewProductDesc' class='paraTxt'>" . $row['productdesc'] ."</p>
                    </div>
                </div>
            </div>
            ";
        }
        else {
            echo "
            <div class='popupView'>
                <input type='button' class='close' name='close' value='×' onclick=" . "closeView('formView')" . ">
                <div class='viewProduct'>
                    <img id='viewProductUrl' src='" . $row['productimgurl'] . "' class='viewPic'/>
                    <div class='viewDesc'>
                        <h2 id='viewProductName'>" . $row['productname'] ."</h2>
                        <h5 id='viewProductSaleDate'>Sale until " . $row['productsaleend'] . "</h5>
                        <div class='prices'>
                            <p id='viewProductOldPrice'class='old-price'>Php " . $row['productprice'] . "</p>
                            <p id='viewProductPrice' class='price'>Php " . $row['productsaleprice'] . "</p>
                        </div>
                        <h3> Description: </h3>
                        <p id='viewProductDesc' class='paraTxt'>" . $row['productdesc'] ."</p>
                    </div>
                </div>
            </div>
            ";
        }
    }
?>