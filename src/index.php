<?php include ('db.php')?>

<?php
    $sql = 'SELECT * FROM Customer';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // This will loop through each row, now use your loop here
        print $row["custusername"];
        print $row["id"];
        print $row["custfullname"];
    }
?>