<?php include ('db.php')?>

<?php
    $sql = "INSERT INTO Product(productName, productImgUrl, productPrice)
            VALUES ('test', 'assets\img\adobo.jpg', 150)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
?>