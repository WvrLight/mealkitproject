<?php
    $sql = "UPDATE Product
            SET productName = 'test'
            WHERE id = 3";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
?>