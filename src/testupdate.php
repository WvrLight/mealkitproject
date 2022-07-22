<?php
    $sql = "INSERT INTO Products(productName, productImgUrl, productPrice)
            VALUES ('test', 'assets\img\adobo.jpg', 150)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
?>