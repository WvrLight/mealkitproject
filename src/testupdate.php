<?php
    $sql = "UPDATE Product
            SET productName = 'test'l
            WHERE id = 3";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
?>