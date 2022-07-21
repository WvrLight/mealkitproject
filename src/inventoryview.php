<?php
    $id = $_REQUEST['id'];

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
?>