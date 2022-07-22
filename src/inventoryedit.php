<?php include ('db.php')?>
<?php
    $id = $_GET['id'];

    $sql = "SELECT * FROM Product WHERE id = " . $id;
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "
        <div class='popupEdit'>
            <h2>Editing MEAL-KIT</h2>
            <input type='button' class='close' name='close' value='×' onclick='" . "closeView('formEdit')" . "'>
            <div class='content'>
                <label>Product Name:</label>
                    <input type='text' name='productName' class='prodContent' value='" . $row['productname'] . "'/><br>
                <label>Product Description:</label>'
                    <textarea name='productDesc' class='textareaDesc' rows='4' value='" . $row['productdesc'] . "'> </textarea><br>
                <label>Product Image URL:</label>
                    <input type='text' name='productImg' class='prodContent' value='" . $row['productimgurl'] . "'/><br>
                <label>Product Price:</label>
                    <input type='text' name='productPrice' class='prodContent' value='" . $row['productprice'] . "'/><br>
                <label>Product Sale Price:</label>
                    <input type='text' name='productSale' class='prodContent' value='" . $row['productsaleprice'] . "'/><br>
                <label>Product Sale Date:</label>
                    <input type='date' name='saleDate' class='prodContent' value='" . $row['productsaleend'] . "'><br><br><br>
                <div align='right' style='margin-right: 30px'>
                    <input type='submit' name='submit' value='Update' class='loginbtn'>
                </div>
            </div>
        </div>";
    }
?>