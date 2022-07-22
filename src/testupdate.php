<?php
    $sql = "UPDATE Product
            SET productName = 'test',
                productDesc = 'abcd',
                productImgUrl = 'assets/img/adobo.jpg',
                productPrice = 250,
                productSalePrice = 150,
                productSaleEnd = null
            WHERE id = 3";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
?>