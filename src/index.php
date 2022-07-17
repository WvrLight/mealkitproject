<?php include ('db.php')?>

<?php
    $sql = 'SELECT * FROM Customer';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $rowCount = $stmt->rowCount();
    $details = $stmt->fetch();

    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
    // This will loop through each row, now use your loop here
        print("<p>" . $row->custusername . "</p>\n");
    }
?>