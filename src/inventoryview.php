<?php
    $id = $_GET['id'];

    $sql = "SELECT * FROM Product WHERE id = " . $id;
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
?>